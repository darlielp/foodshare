<div class="card-box">

    <!-- HEADER -->
    <div class="card-header">
        <div>
            <h3>Categorias</h3>
            <p>Distribuição de doações por tipo</p>
        </div>
    </div>

    <!-- LISTA -->
    <div class="lista-categorias">

        <?php if (!empty($categorias)): ?>

            <?php foreach ($categorias as $cat): 
                $percentual = max(0, min(100, (int)$cat['percentual']));
            ?>
                <div class="categoria-item">

                    <!-- TEXTO -->
                    <div class="categoria-info">
                        <span><?= htmlspecialchars($cat['nome']) ?></span>
                        <strong><?= $percentual ?>%</strong>
                    </div>

                    <!-- BARRA -->
                    <div class="barra">
                        <div 
                            class="progresso" 
                            style="width: <?= $percentual ?>%">
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>

        <?php else: ?>

            <p class="empty">Nenhuma categoria disponível.</p>

        <?php endif; ?>

    </div>

</div>