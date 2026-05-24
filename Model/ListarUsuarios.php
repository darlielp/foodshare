<?php
require 'ConexaoBD.php';

class ListarUsuarios {

    public function lerUsuarios() {

        $conexao = new ConexaoBD();
        $pdo = $conexao->conectar();

        $sql = "SELECT id, nome, email, tipo, criado_em FROM usuarios";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
?>