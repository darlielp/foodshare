<?php
// Futuramente: validação, inserção no banco, etc.
// session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login - FoodShare</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- Biblioteca p/ icones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<script src="../js/validacoes.js"></script>

<body>

    <!-- HEADER -->
    <?php require_once('../includes/header.php'); ?>

    <main class="container">

        <!-- CARD DE LOGIN -->
        <div class="login-card">

            <h2>Bem Vindo</h2>
            <p class="subtitle">Faça login na sua conta FoodShare</p>
            
            <?php if (isset($_GET['erro'])): ?>

                <div class="erro-login">
                    Email ou senha incorretos.
                </div>

            <?php endif; ?>
            <!-- FORMULÁRIO -->
            <form action="../Controller/LoginController.php" method="POST">

                <!-- CAMPO EMAIL -->
                <label for="email">Email</label>
                <div class="input-group">
                    <span class="icon">
                        <!-- AJUSTE: ícone correto de email -->
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" name="email" id="email" placeholder="seunome@email.com" required>
                </div>
                <!-- MENSAGEM DE ERRO PARA O EMAIL -->
                <span class="error-message" id="error-email"></span>

                <!-- CAMPO SENHA -->
                <label for="senha">Senha</label>
                <div class="input-group">

                    <span class="icon">
                        <i class="fa-solid fa-lock"></i>
                    </span>

                    <input
                        type="password"
                        name="senha"
                        id="senhaCadastro"
                        required>

                    <span class="toggle-password" onclick="toggleSenha()">

                        <i class="fa-solid fa-eye" id="iconeSenha"></i>

                    </span>

                </div>

                <button type="submit" class="btn-submit">Acessar</button>

            </form>

            <!-- LINK CADASTRO -->
            <p class="register-text">
                Não tem uma conta?
                <a href="cadastro.php">Crie uma</a>
            </p>

        </div>
    </main>
</body>

</html>