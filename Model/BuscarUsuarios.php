<?php
require 'ConexaoBD.php';
// [R]EAD - Buscar Apenas Um Usuário (Para edição)
class BuscarUsuarios {
    private $id;

function buscarUsuarioPorId($id) {
    $conexao = new ConexaoBD();
    $pdo = $conexao->conectar();
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}
?>