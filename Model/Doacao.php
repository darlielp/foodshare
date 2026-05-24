<?php
require 'ConexaoBD.php';

class Doacao {

    public function listarDoacoes() {

        $conexao = new ConexaoBD();
        $pdo = $conexao->conectar();

        $sql = "SELECT * FROM doacoes";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function cadastrarDoacao($doador_id, $descricao, $tipo, $quantidade) {

        if (!is_numeric($quantidade)) {
            return false;
        }

        $conexao = new ConexaoBD();
        $pdo = $conexao->conectar();

        $sql = "INSERT INTO doacoes
                (doador_id, descricao, tipo_alimento, quantidade)
                VALUES
                (:doador_id, :descricao, :tipo, :quantidade)";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ':doador_id' => $doador_id,
            ':descricao' => htmlspecialchars(trim($descricao)),
            ':tipo' => htmlspecialchars(trim($tipo)),
            ':quantidade' => $quantidade
        ]);
    }
}
?>