<?php
// Puxa o nome da pasta do arquivo atual
$pastaAtual = basename(dirname($_SERVER['PHP_SELF']));

// Se o url estiver dentro da pasta 'View', o navegador voltar uma pasta '../'
// Se não estiver, procurar na mesma pasta './'
$caminho = ($pastaAtual === 'View') ? '../' : './';
?>

<header class="navbar">
    <div class="logo">
        <img src="<?= $caminho ?>img/logo.png" alt="Logo FoodShare">
    </div>

    <div class="nav-buttons">
        <a href="<?= $caminho ?>View/login.php" class="btn btn-login">Login</a>
        <a href="<?= $caminho ?>View/cadastro.php" class="btn btn-register">Criar Conta</a>
    </div>
</header>