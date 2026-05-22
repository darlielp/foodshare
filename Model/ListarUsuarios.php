<?php
require 'ConexaoBD.php';
// [R]EAD - Listar Todos os Usuários
class Listausuarios {
    private $id;
    private $nome;
    private $email;
function lerUsuarios() {
    $conexao = new ConexaoBD();
    $pdo = $conexao->conectar();
    $sql = "SELECT * FROM usuarios";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>