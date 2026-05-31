<?php
$tipoUsuario = strtolower($_SESSION['user']['tipo'] ?? '');
$meuId = $_SESSION['user']['id'] ?? 0;

$isAdmin = ($tipoUsuario === 'admin');
$isDoador = ($tipoUsuario === 'doador');
$isReceptor = ($tipoUsuario === 'instituicao');

$podeEditarExcluir = ($isAdmin || $isDoador) && $doacao['status'] === 'disponivel';
$podeSolicitar = $isReceptor && $doacao['status'] === 'disponivel';

$podeConfirmar = $isReceptor && $doacao['status'] === 'solicitado' && $doacao['receptor_id'] == $meuId;
?>

<div 
    class="card-doacao"
    data-titulo="<?= htmlspecialchars(strtolower($doacao['titulo'])) ?>"
    data-origem="<?= htmlspecialchars(strtolower($doacao['origem'])) ?>"
    data-status="<?= $doacao['status'] ?>"
    data-categoria="<?= $doacao['categoria'] ?? '' ?>"
>

    <span class="status <?= $doacao['status'] ?>">
        <?= ucfirst($doacao['status']) ?>
    </span>

    <div class="card-top">
        <i class="fa-solid fa-box"></i>
        <div>
            <strong><?= htmlspecialchars($doacao['titulo']) ?></strong>
            <p><?= htmlspecialchars($doacao['origem']) ?></p>
        </div>
    </div>

    <div class="card-info">
        <p><i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($doacao['endereco']) ?></p>
        <p><i class="fa-solid fa-calendar"></i> Validade: <?= htmlspecialchars($doacao['validade']) ?></p>
        <p><i class="fa-solid fa-weight-hanging"></i> <?= htmlspecialchars($doacao['peso']) ?></p>
        <p class="descricao"><?= htmlspecialchars($doacao['descricao']) ?></p>
    </div>

    <div class="card-actions">
        
        <?php if ($podeEditarExcluir): ?>
            
            <button 
                type="button" 
                class="btn-edit" 
                data-id="<?= $doacao['id'] ?>"
                data-titulo="<?= htmlspecialchars($doacao['titulo']) ?>"
                data-descricao="<?= htmlspecialchars($doacao['descricao']) ?>"
                data-peso="<?= htmlspecialchars($doacao['peso']) ?>"
                data-validade="<?= htmlspecialchars($doacao['validade']) ?>"
            >
                <i class="fa-solid fa-pen"></i> Editar
            </button>

            <a 
                href="../Controller/ExcluirDoacaoController.php?id=<?= $doacao['id'] ?>" 
                class="btn-delete" 
                onclick="return confirm('Tem certeza que deseja excluir esta doação?')"
                style="text-decoration: none;"
            >
                <i class="fa-solid fa-trash"></i> Excluir
            </a>

        <?php elseif ($podeSolicitar): ?>
            
            <form action="../Controller/SolicitarDoacaoController.php" method="POST" style="margin: 0;">
                <input type="hidden" name="doacao_id" value="<?= $doacao['id'] ?>">
                <button type="submit" class="btn-submit" style="width: auto; padding: 6px 12px; margin: 0; font-size: 12px; background-color: #fbc02d; color: #000; cursor: pointer;">
                    <i class="fa-solid fa-hand-holding-heart"></i> Solicitar
                </button>
            </form>

        <?php elseif ($podeConfirmar): ?>
            
            <form action="../Controller/ConfirmarEntregaController.php" method="POST" style="margin: 0;">
                <input type="hidden" name="doacao_id" value="<?= $doacao['id'] ?>">
                <button type="submit" class="btn-submit" style="width: auto; padding: 6px 12px; margin: 0; font-size: 12px; background-color: #28a745; border: none; border-radius: 4px; color: #fff; cursor: pointer;">
                    <i class="fa-solid fa-check"></i> Confirmar Entrega
                </button>
            </form>

        <?php else: ?>
            
            <span style="font-size: 12px; color: #999;">
                <i class="fa-solid fa-lock"></i> Ação indisponível
            </span>

        <?php endif; ?>

    </div>
</div>