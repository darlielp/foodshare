<?php
require 'ConexaoBD.php';
// [U]PDATE - Atualizar Dados do Usuário
class AtualizarDados {
    private $id;
    private $nome;
    private $email;
function atualizarUsuario($id, $nome, $email) {
    $conexao = new ConexaoBD();
    $pdo = $conexao->conectar();
    $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id, ':nome' => $nome, ':email' => $email]);
}
}
?>