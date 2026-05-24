<?php

session_start();

if (!isset($_SESSION['user'])) {

    header('Location: login.php');
    exit;
}

require '../Model/ConexaoBD.php';

$conexao = new ConexaoBD();

$pdo = $conexao->conectar();

$stmt = $pdo->query("
    SELECT *
    FROM doacoes
");

$doacoes = $stmt->fetchAll();

$totalDoacoes = count($doacoes);

$doacoesDisponiveis = 0;
$doacoesSolicitadas = 0;
$doacoesConcluidas = 0;
$doacoesCanceladas = 0;

$totalKg = 0;

foreach ($doacoes as $doacao) {

    $status = strtolower(
        $doacao['status'] ?? ''
    );

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

   $totalKg += (float)($doacao['quantidade_kg'] ?? 0);
}

/* TOTAL DE USUÁRIOS */

$stmtUsuarios = $pdo->query("
    SELECT COUNT(*) as total
    FROM usuarios
");

$usuarios = $stmtUsuarios
    ->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

/* TOTAL DE LOCAIS */

$stmtLocais = $pdo->query("
    SELECT COUNT(DISTINCT endereco)
    as total
    FROM doacoes
");

$locais = $stmtLocais
    ->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>Dashboard</title>

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

    <?php require_once('../includes/sidebar.php'); ?>

    <main class="dashboard">

        <h1>
            Bem vindo de volta,
            <?= htmlspecialchars($_SESSION['user']['nome']) ?>!
        </h1>

        <p class="subtitle">
            Gerencie a plataforma e monitore as atividades.
        </p>

        <!-- CARDS -->
        <?php require_once('../includes/components/cards.php'); ?>

        <div class="dashboard-grid">

            <?php require_once('../includes/components/doacoes_recentes.php'); ?>

            <?php require_once('../includes/components/categorias.php'); ?>

        </div>

    </main>

</body>

</html>