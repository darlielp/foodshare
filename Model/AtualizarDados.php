<?php
require 'ConexaoBD.php';

class AtualizarDados {

    public function atualizarUsuario($id, $nome, $email) {

        if (!is_numeric($id)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $nome = htmlspecialchars(trim($nome));
        $email = htmlspecialchars(trim($email));

        $conexao = new ConexaoBD();
        $pdo = $conexao->conectar();

        $sql = "UPDATE usuarios
                SET nome = :nome,
                    email = :email
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email
        ]);
    }
}
?>