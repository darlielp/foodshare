<?php
$editavel = $doacao['status'] === 'disponivel';
?>

<div 
    class="card-doacao"
    data-titulo="<?= strtolower($doacao['titulo']) ?>"
    data-origem="<?= strtolower($doacao['origem']) ?>"
    data-status="<?= $doacao['status'] ?>"
    data-categoria="<?= $doacao['categoria'] ?? '' ?>"
>

    <!-- STATUS -->
    <span class="status <?= $doacao['status'] ?>">
        <?= ucfirst($doacao['status']) ?>
    </span>

    <!-- HEADER -->
    <div class="card-top">

        <i class="fa-solid fa-box"></i>

        <div>
            <strong><?= $doacao['titulo'] ?></strong>
            <p><?= $doacao['origem'] ?></p>
        </div>

    </div>

    <!-- INFOS -->
    <div class="card-info">

        <p>
            <i class="fa-solid fa-location-dot"></i>
            <?= $doacao['endereco'] ?>
        </p>

        <p>
            <i class="fa-solid fa-calendar"></i>
            Validade: <?= $doacao['validade'] ?>
        </p>

        <p>
            <i class="fa-solid fa-weight-hanging"></i>
            <?= $doacao['peso'] ?>
        </p>

        <p class="descricao">
            <?= $doacao['descricao'] ?>
        </p>

    </div>

    <!-- ACTIONS -->
    <div class="card-actions">

    <!-- EDITAR -->
    <button 
        type="button"

        class="btn-edit <?= !$editavel ? 'disabled' : '' ?>"

        <?= !$editavel ? 'disabled' : '' ?>

        data-id="<?= $doacao['id'] ?>"
        data-titulo="<?= htmlspecialchars($doacao['titulo']) ?>"
        data-descricao="<?= htmlspecialchars($doacao['descricao']) ?>"
        data-peso="<?= htmlspecialchars($doacao['peso']) ?>"
        data-validade="<?= htmlspecialchars($doacao['validade']) ?>"

    >
        <i class="fa-solid fa-pen"></i>
        Editar
    </button>

    <!-- EXCLUIR -->
    <button type="button" class="btn-delete">
        <i class="fa-solid fa-trash"></i>
        Excluir
    </button>

</div>

</div>