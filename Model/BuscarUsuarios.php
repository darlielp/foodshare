<?php
require 'ConexaoBD.php';

class BuscarUsuarios {

    public function buscarUsuarioPorId($id) {

        if (!is_numeric($id)) {
            return false;
        }

        $conexao = new ConexaoBD();
        $pdo = $conexao->conectar();

        $sql = "SELECT * FROM usuarios WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch();
    }
}
?>