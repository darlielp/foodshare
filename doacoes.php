<?php
// MOCK (depois vem do banco)
$doacoes = [
    [
        'id' => 1,
        'titulo' => 'Mix de Vegetais Frescos',
        'origem' => 'Alimentos Frescos Ltda.',
        'status' => 'disponivel',
        'categoria' => 'vegetais',
        'endereco' => 'Av. Paulista, 1000 – São Paulo - SP',
        'validade' => '19/04/2026',
        'peso' => '50kg',
        'descricao' => 'Mix de vegetais frescos, incluindo cenoura, brócolis e pimentão'
    ],
    [
        'id' => 2,
        'titulo' => 'Alimentos Enlatados',
        'origem' => 'Mercado Verde',
        'status' => 'disponivel',
        'categoria' => 'enlatados',
        'endereco' => 'Rua das Flores, 789 – Curitiba - PR',
        'validade' => '14/05/2027',
        'peso' => '200 unidades',
        'descricao' => 'Feijão, milho e tomate enlatado'
    ],
    [
        'id' => 3,
        'titulo' => 'Itens de Padaria',
        'origem' => 'Padaria da Esquina',
        'status' => 'solicitado',
        'categoria' => 'padaria',
        'endereco' => 'Rua Augusta, 456 – São Paulo - SP',
        'validade' => '14/04/2026',
        'peso' => '30 itens',
        'descricao' => 'Pães, doces e produtos frescos'
    ]
];

// Filtros
$busca = $_GET['busca'] ?? '';
$status = $_GET['status'] ?? '';
$categoria = $_GET['categoria'] ?? '';

$doacoesFiltradas = array_filter($doacoes, function($d) use ($busca, $status, $categoria) {

    $matchBusca =
        empty($busca) ||
        stripos($d['titulo'], $busca) !== false ||
        stripos($d['origem'], $busca) !== false;

    $matchStatus =
        empty($status) ||
        $d['status'] === $status;

    $matchCategoria =
        empty($categoria) ||
        $d['categoria'] === $categoria;

    return $matchBusca && $matchStatus && $matchCategoria;
});

// Paginação
$porPagina = 9;

$total = count($doacoesFiltradas);

$paginaAtual = $_GET['page'] ?? 1;

$inicio = ($paginaAtual - 1) * $porPagina;

$doacoesPaginadas = array_slice(
    $doacoesFiltradas,
    $inicio,
    $porPagina
);

$totalPaginas = ceil($total / $porPagina);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doações</title>

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<?php require_once 'includes/sidebar.php'; ?>

<main class="dashboard">

    <!-- TOPO -->
    <div class="top-bar">

        <div>
            <h1>Doações</h1>
            <p class="subtitle">
                Visualize e gerencie as doações de alimentos
            </p>
        </div>

        <a href="nova_doacao.php" class="btn btn-register">
            Adicionar Doação
        </a>

    </div>

    <!-- FILTROS -->
    <?php include 'includes/components/filtros_doacoes.php'; ?>

    <!-- GRID -->
    <div class="grid-doacoes">

        <?php if (!empty($doacoesPaginadas)): ?>

            <?php foreach ($doacoesPaginadas as $doacao): ?>

                <?php require __DIR__ . '/includes/components/cards_doacao.php'; ?>

            <?php endforeach; ?>

        <?php else: ?>

            <p class="empty">Nenhuma doação encontrada.</p>

        <?php endif; ?>

    </div>

    <!-- PAGINAÇÃO -->
    <?php if ($totalPaginas > 1): ?>

        <div class="paginacao">

            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>

                <a
                    href="?page=<?= $i ?>"
                    class="<?= $i == $paginaAtual ? 'active' : '' ?>"
                >
                    <?= $i ?>
                </a>

            <?php endfor; ?>

        </div>

    <?php endif; ?>

</main>

<!-- =========================
     MODAL EDIÇÃO
========================= -->

<div id="modalEdit" class="modal">

    <div class="modal-content">

        <span class="close" onclick="fecharModal()">
            &times;
        </span>

        <h2>Editar Doação</h2>

        <form id="formEdit">

            <input type="hidden" id="edit-id">

            <label>Título</label>
            <input type="text" id="edit-titulo">

            <label>Descrição</label>
            <textarea id="edit-descricao"></textarea>

            <label>Peso</label>
            <input type="text" id="edit-peso">

            <label>Validade</label>
            <input type="date" id="edit-validade">

            <button type="submit" class="btn-submit">
                Salvar
            </button>

        </form>

    </div>

</div>

<!-- =========================
     SCRIPTS
========================= -->

<script src="js/filtros.js"></script>

<script>

function abrirModalEdicao(botao) {
    const modal = document.getElementById("modalEdit");

    modal.style.display = "flex";

    document.getElementById("edit-id").value =
        botao.dataset.id;

    document.getElementById("edit-titulo").value =
        botao.dataset.titulo;

    document.getElementById("edit-descricao").value =
        botao.dataset.descricao;

    document.getElementById("edit-peso").value =
        botao.dataset.peso;

    document.getElementById("edit-validade").value =
        formatarData(botao.dataset.validade);
}

function fecharModal() {

    document.getElementById("modalEdit").style.display = "none";
}

function formatarData(data) {

    if (!data) return '';

    const partes = data.split('/');

    if (partes.length !== 3) return data;

    return `${partes[2]}-${partes[1]}-${partes[0]}`;
}

// Associa clique dos botões de editar sem depender de onclick inline
document.querySelectorAll(".btn-edit").forEach(function(botao) {
    if (botao.disabled) return;
    botao.addEventListener("click", function() {
        abrirModalEdicao(botao);
    });
});

// Mock submit
document.getElementById("formEdit")
.addEventListener("submit", function(e) {

    e.preventDefault();

    alert("Doação atualizada com sucesso!");

    fecharModal();
});

</script>

</body>
</html>