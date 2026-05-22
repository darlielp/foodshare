<?php
/*[C]REATE - Inserir Usuário*/
require 'ConexaoBD.php';
class AtualizarDados {
    private $nome;
    private $email;
function criarUsuario($nome, $email) {
    $conexao = new ConexaoBD();
    $pdo = $conexao->conectar();
    $sql = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':nome' => $nome, ':email' => $email]);
}
}
?>