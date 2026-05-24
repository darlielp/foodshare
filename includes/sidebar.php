
<?php 
    $pagina = basename($_SERVER['PHP_SELF']); 
?>
<aside class="sidebar">

    <!-- LOGO -->
    <div class="sidebar-logo">
        <i class="fa-solid fa-seedling"></i>
        <span>FoodShare</span>
    </div>

    <!-- MENU -->
    <nav class="menu">

    <a href="dashboard.php" class="menu-item <?= $pagina == 'dashboard.php' ? 'active' : '' ?>">
        <i class="fa-solid fa-chart-line"></i>
        <span>Dashboard</span>
    </a>

    <a href="doacoes.php" class="menu-item <?= $pagina == 'doacoes.php' ? 'active' : '' ?>">
        <i class="fa-solid fa-box"></i>
        <span>Doações</span>
    </a>

    <a href="mapa.php" class="menu-item <?= $pagina == 'mapa.php' ? 'active' : '' ?>">
        <i class="fa-solid fa-map"></i>
        <span>Mapa</span>
    </a>

    <a href="usuarios.php" class="menu-item <?= $pagina == 'usuarios.php' ? 'active' : '' ?>">
        <i class="fa-solid fa-users"></i>
        <span>Usuários</span>
    </a>

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
                <strong>Usuário</strong>
                <p>Administrador</p>
            </div>
        </div>

        <a href="logout.php" class="btn-logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            Sair
        </a>
    </div>

</aside>