<?php

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FoodShare</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</html>
</head>
<body>

<!-- HEADER -->
<?php require_once '../includes/header.php'; ?>

<main class="container">

    <!-- CARD DE LOGIN -->
    <div class="login-card">

        <h2>Bem Vindo</h2>
        <p class="subtitle">Faça login na sua conta FoodShare</p>

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

                <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>

                <!-- OLHINHO -->
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
<script src="../js/validacoes.js"></script>
</body>
</html>