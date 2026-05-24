<?php
// Futuramente: validação, inserção no banco, etc.
// session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro - FoodShare</title>

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

        <div class="cadastro-card">

            <h2>Criar Conta</h2>
            <p class="subtitle">Junte-se ao FoodShare e comece a fazer a diferença</p>

            <form action="../Controller/CadastroController.php" method="POST">

                <!-- NOME -->
                <label>Nome</label>
                <div class="input-group">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="nome" id="nome" placeholder="Digite seu nome ou nome da empresa" required>
                </div>

                <!-- EMAIL -->
                <label for="email">Email</label>
                <div class="input-group">
                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" id="email" required
                        placeholder="exemplo@email.com">
                </div>
                <span class="error-message" id="error-email"></span>


                <!-- CPF/CNPJ -->
                <label>CPF/CNPJ</label>
                <div class="input-group">
                    <span class="icon"><i class="fa-solid fa-id-card"></i></span>
                    <input type="text" name="documento_visual" id="documento_visual"
                        placeholder="Digite um CPF ou CNPJ válido"
                        oninput="mascaraDocumento(this); tratarDocumento(this)"
                        maxlength="18"
                        required>
                    <input type="hidden" name="documento" id="documento_real">
                </div>

                <!-- SENHA -->
                <label>Senha</label>
                <div class="input-group">

                    <span class="icon">
                        <i class="fa-solid fa-lock"></i>
                    </span>

                    <input
                        type="password"
                        name="senha"
                        id="senhaCadastro"
                        placeholder="Crie uma senha forte"
                        required>

                    <span class="toggle-password" onclick="toggleSenha()">

                        <i class="fa-solid fa-eye" id="iconeSenha"></i>

                    </span>

                </div>

                <!-- TIPO DE USUÁRIO -->
                <label>Eu quero</label>
                <div class="opcoes">

                    <label class="opcao">
                        <input type="radio" name="tipo" value="doador" required>
                        <div class="box">
                            <span class="icon"><i class="fa-solid fa-hand-holding-heart"></i></span>
                            <strong>Doar Alimentos</strong>
                            <p>Mercados, Restaurantes, etc</p>
                        </div>
                    </label>

                    <label class="opcao">
                        <input type="radio" name="tipo" value="recebedor">
                        <div class="box">
                            <span class="icon"><i class="fa-solid fa-heart"></i></span>
                            <strong>Receber Alimentos</strong>
                            <p>Abrigos, ONGs, Pessoas, etc</p>
                        </div>
                    </label>

                </div>

                <button type="submit" class="btn-submit">Criar conta</button>

            </form>

            <p class="login-text">
                Já tem uma conta?
                <a href="login.php">Faça o login</a>
            </p>

        </div>

    </main>
    <script src="js/validacoes.js"></script>
</body>

</html>