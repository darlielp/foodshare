<?php
require_once 'ConexaoBD.php';

class AtualizarDados {

    public function atualizarPerfilCompleto($id, $nome, $email, $telefone, $endereco, $senha_nova) {
        $conexao = new ConexaoBD();
        $pdo = $conexao->conectar();

        $stmtCheck = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email AND id != :id");
        $stmtCheck->execute([':email' => $email, ':id' => $id]);
        if ($stmtCheck->fetch()) {
            return "EMAIL_EXISTE";
        }

        if (!empty($senha_nova)) {
            $senhaHash = password_hash($senha_nova, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco, senha = :senha WHERE id = :id";
            $params = [
                ':nome' => $nome, ':email' => $email, ':telefone' => $telefone, 
                ':endereco' => $endereco, ':senha' => $senhaHash, ':id' => $id
            ];
        } else {
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco WHERE id = :id";
            $params = [
                ':nome' => $nome, ':email' => $email, ':telefone' => $telefone, 
                ':endereco' => $endereco, ':id' => $id
            ];
        }
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return "SUCESSO";
        } catch (PDOException $e) {
            return "ERRO";
        }
    }
}
?>