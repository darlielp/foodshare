<?php

require 'ConexaoBD.php';

class Usuario
{

    public function criarUsuario($nome, $email, $senha, $tipo = 'usuario')
    {

        if (
            empty($nome) ||
            empty($email) ||
            empty($senha)
        ) {
            return "Preencha todos os campos.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Email inválido.";
        }

        $nome = trim($nome);
        $email = trim($email);

        $conexao = new ConexaoBD();

        $pdo = $conexao->conectar();

        // VERIFICA EMAIL JÁ EXISTE
        $check = $pdo->prepare("
            SELECT id
            FROM usuarios
            WHERE email = :email
        ");

        $check->execute([
            ':email' => $email
        ]);

        if ($check->fetch()) {
            return "Email já cadastrado.";
        }

        // CRIPTOGRAFA SENHA
        $senhaHash = password_hash(
            $senha,
            PASSWORD_DEFAULT
        );

        // INSERE USUÁRIO
        $sql = "
            INSERT INTO usuarios
            (nome, email, senha, tipo)

            VALUES
            (:nome, :email, :senha, :tipo)
        ";

        $stmt = $pdo->prepare($sql);

        $sucesso = $stmt->execute([

            ':nome' => htmlspecialchars($nome),

            ':email' => htmlspecialchars($email),

            ':senha' => $senhaHash,

            ':tipo' => $tipo
        ]);

        if ($sucesso) {
            return true;
        }

        return "Erro ao cadastrar usuário.";
    }
}
