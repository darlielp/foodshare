
<?php 
    $pagina = basename($_SERVER['PHP_SELF']); 
?>
<input type="checkbox" id="menu-toggle" class="menu-toggle-checkbox">
<label for="menu-toggle" class="menu-toggle-label">
    <i class="fa-solid fa-bars"></i>
</label>

<aside class="sidebar">

    <!-- LOGO -->
    <div class="sidebar-logo">
        <div class="logo">
            <img src="../img/logo.png" alt="">
        </div>
    </div>

    <!-- MENU -->
    <nav class="menu">

        <?php 
        // Lê quem é o usuário atual
        $tipoSidebar = $_SESSION['user']['tipo'] ?? ''; 
        ?>

        <?php if ($tipoSidebar === 'admin'): ?>
            <a href="dashboard.php" class="menu-item <?= $pagina == 'dashboard.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        <?php endif; ?>

        <a href="doacoes.php" class="menu-item <?= $pagina == 'doacoes.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-box"></i>
            <span>Doações</span>
        </a>

        <a href="mapa.php" class="menu-item <?= $pagina == 'mapa.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-map"></i>
            <span>Mapa</span>
        </a>

        <?php if ($tipoSidebar === 'admin'): ?>
            <a href="usuarios.php" class="menu-item <?= $pagina == 'usuarios.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-users"></i>
                <span>Usuários</span>
            </a>
        <?php endif; ?>

        <a href="perfil.php" class="menu-item <?= $pagina == 'perfil.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-user"></i>
            <span>Perfil</span>
        </a>

    </nav>

    <!-- FOOTER -->
    <div class="sidebar-footer">
        <div class="user-info">
            <i class="fa-solid fa-user-circle"></i>
            <div>
                <strong>
                    <?= htmlspecialchars(mb_strimwidth($_SESSION['user']['nome'] ?? 'Usuário', 0, 18, '...')); ?>
                </strong>
                
                <p>
                    <?= ucfirst(htmlspecialchars($_SESSION['user']['tipo'] ?? 'Visitante')); ?>
                </p>
            </div>
        </div>

        <a href="../Controller/LogoutController.php" class="btn-logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            Sair
        </a>
    </div>

</aside>