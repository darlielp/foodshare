<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require '../Model/ConexaoBD.php';

$conexao = new ConexaoBD();
$pdo = $conexao->conectar();

$stmt = $pdo->query("SELECT * FROM doacoes");
$doacoes = $stmt->fetchAll();

$totalDoacoes = count($doacoes);
$doacoesDisponiveis = 0;
$doacoesSolicitadas = 0;
$doacoesConcluidas = 0;
$doacoesCanceladas = 0;
$totalKg = 0;

foreach ($doacoes as $doacao) {
    $status = strtolower($doacao['status'] ?? '');
    switch ($status) {
        case 'disponivel':
            $doacoesDisponiveis++;
            break;
        case 'solicitado':
            $doacoesSolicitadas++;
            break;
        case 'concluido':
            $doacoesConcluidas++;
            break;
        case 'cancelado':
            $doacoesCanceladas++;
            break;
    }
    $totalKg += (float)($doacao['quantidade'] ?? 0);
}

$stmtUsuarios = $pdo->query("SELECT COUNT(*) as total FROM usuarios");
$usuarios = $stmtUsuarios->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

$stmtLocais = $pdo->query("SELECT COUNT(DISTINCT endereco) as total FROM doacoes");
$locais = $stmtLocais->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

$stmtRecentes = $pdo->query("
    SELECT descricao, tipo_alimento, origem, status 
    FROM doacoes 
    ORDER BY id DESC 
    LIMIT 5
");
$recentesBD = $stmtRecentes->fetchAll(PDO::FETCH_ASSOC);

$doacoesRecentes = [];
foreach ($recentesBD as $d) {
    $textoCompleto = $d['descricao'] ?? '';
    $partes = explode(' - ', $textoCompleto, 2);
    
    if (count($partes) > 1) {
        $titulo = trim($partes[0]);
    } else {
        $titulo = ucfirst($d['tipo_alimento'] ?? 'Alimento');
    }

    $doacoesRecentes[] = [
        'titulo' => $titulo,
        'origem' => $d['origem'] ?? 'Desconhecido',
        'status' => $d['status'] ?? 'disponivel'
    ];
}

$categorias = [];
if ($totalDoacoes > 0) {
    $stmtCat = $pdo->query("
        SELECT tipo_alimento as nome, COUNT(*) as qtd 
        FROM doacoes 
        GROUP BY tipo_alimento
    ");
    $catsBD = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($catsBD as $c) {
        $nomeCat = !empty($c['nome']) ? ucfirst($c['nome']) : 'Outros';
        $percent = round(($c['qtd'] / $totalDoacoes) * 100);
        $categorias[] = [
            'nome' => $nomeCat,
            'percentual' => $percent
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <?php require_once '../includes/sidebar.php'; ?>

    <main class="dashboard">

        <h1>
            Bem-vindo de volta, <?= htmlspecialchars($_SESSION['user']['nome']); ?>!
        </h1>

        <p class="subtitle">
            Gerencie a plataforma e monitore as atividades.
        </p>

        <?php require_once '../includes/components/cards.php'; ?>

        <div class="dashboard-grid">
            <?php require_once '../includes/components/doacoes_recentes.php'; ?>
            <?php require_once '../includes/components/categorias.php'; ?>
        </div>

    </main>

</body>
</html>