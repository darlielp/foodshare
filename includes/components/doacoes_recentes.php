<div class="card-box">

    <!-- HEADER -->
    <div class="card-header">
        <div>
            <h3>Doações Recentes</h3>
            <p>Últimas doações de alimentos na plataforma</p>
        </div>

        <a href="doacoes.php" class="link">Ver Todos →</a>
    </div>

    <!-- LISTA -->
    <div class="lista-doacoes">

        <?php if (!empty($doacoesRecentes)): ?>
            
            <?php foreach ($doacoesRecentes as $doacao): ?>
                <div class="item-doacao">

                    <div class="info">
                        <i class="fa-solid fa-box"></i>

                        <div>
                            <strong><?= htmlspecialchars($doacao['titulo']) ?></strong>
                            <p><?= htmlspecialchars($doacao['origem']) ?></p>
                        </div>
                    </div>

                    <!-- STATUS -->
                    <span class="status <?= htmlspecialchars($doacao['status']) ?>">
                        <?= ucfirst(htmlspecialchars($doacao['status'])) ?>
                    </span>

                </div>
            <?php endforeach; ?>

        <?php else: ?>

            <p class="empty">Nenhuma doação encontrada.</p>

        <?php endif; ?>

    </div>

</div>