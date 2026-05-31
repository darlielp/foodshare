<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require '../Model/Doacao.php';

$model = new Doacao();
$doacoesBanco = $model->listarDoacoes();

$doacoes = [];
foreach ($doacoesBanco as $d) {
    
    $dataValidade = !empty($d['data_disponivel']) ? date('d/m/Y', strtotime($d['data_disponivel'])) : 'Não informada';
    
    $textoCompleto = $d['descricao'] ?? '';
    $partes = explode(' - ', $textoCompleto, 2); 
    
    if (count($partes) > 1) {
        $tituloCard = trim($partes[0]); 
        $descricaoCard = trim($partes[1]); 
    } else {
        $tituloCard = ucfirst($d['tipo_alimento'] ?? 'Alimento'); 
        $descricaoCard = $textoCompleto;
    }

    $doacoes[] = [
        'id'        => $d['id'],
        'titulo'    => $tituloCard,
        'origem'    => $d['origem'] ?? 'Desconhecido',
        'status'    => $d['status'] ?? 'disponivel',
        'categoria' => strtolower($d['tipo_alimento'] ?? ''),
        'endereco'  => $d['endereco'] ?? 'Não informado',
        'validade'  => $dataValidade,
        'peso'      => $d['peso'] ?? $d['quantidade'] . 'kg',
        'descricao' => $descricaoCard,
        'receptor_id' => $d['receptor_id'] ?? null
    ];
}

$busca = $_GET['busca'] ?? '';
$status = $_GET['status'] ?? '';
$categoria = $_GET['categoria'] ?? '';

$doacoesFiltradas = array_filter($doacoes, function($d) use ($busca, $status, $categoria) {
    $matchBusca = empty($busca) || stripos($d['titulo'], $busca) !== false || stripos($d['origem'], $busca) !== false;
    $matchStatus = empty($status) || $d['status'] === $status;
    $matchCategoria = empty($categoria) || $d['categoria'] === $categoria;
    return $matchBusca && $matchStatus && $matchCategoria;
});

$porPagina = 9;
$total = count($doacoesFiltradas);
$paginaAtual = $_GET['page'] ?? 1;
$inicio = ($paginaAtual - 1) * $porPagina;

$doacoesPaginadas = array_slice($doacoesFiltradas, $inicio, $porPagina);
$totalPaginas = ceil($total / $porPagina);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doações</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php require_once '../includes/sidebar.php'; ?>

<main class="dashboard">

    <div class="top-bar">
        <div>
            <h1>Doações</h1>
            <p class="subtitle">Visualize e gerencie as doações de alimentos</p>
        </div>
        
        <?php if ($_SESSION['user']['tipo'] !== 'instituicao'): ?>
            <a href="nova_doacao.php" class="btn btn-register">Adicionar Doação</a>
        <?php endif; ?>
    </div>

    <?php include '../includes/components/filtros_doacoes.php'; ?>

    <div class="grid-doacoes">
        <?php if (!empty($doacoesPaginadas)): ?>
            <?php foreach ($doacoesPaginadas as $doacao): ?>
                
                <?php require '../includes/components/cards_doacao.php'; ?>

            <?php endforeach; ?>
        <?php else: ?>
            <p class="empty">Nenhuma doação encontrada.</p>
        <?php endif; ?>
    </div>

    <?php if ($totalPaginas > 1): ?>
        <div class="paginacao">
            <?php 
            $parametrosURL = $_GET; 
            
            for ($i = 1; $i <= $totalPaginas; $i++): 
                $parametrosURL['page'] = $i; 
                $urlPaginacao = '?' . http_build_query($parametrosURL); 
            ?>
                <a href="<?= $urlPaginacao ?>" class="<?= $i == $paginaAtual ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

</main>
<div id="modalEdit" class="modal">
    <div class="modal-content">
        <span class="close" onclick="fecharModal()">&times;</span>
        <h2>Editar Doação</h2>

        <form id="formEdit" action="../Controller/EditarDoacaoController.php" method="POST">
            
            <input type="hidden" id="edit-id" name="id">

            <label>Título</label>
            <input type="text" id="edit-titulo" name="titulo" required>

            <label>Descrição</label>
            <textarea id="edit-descricao" name="descricao" required></textarea>

            <label>Peso</label>
            <input type="text" id="edit-peso" name="peso" required>

            <label>Validade</label>
            <input type="date" id="edit-validade" name="validade" required>

            <button type="submit" class="btn-submit">Salvar</button>
        </form>
    </div>
</div>

<script src="../js/doacoes.js"></script>
</body>
</html>