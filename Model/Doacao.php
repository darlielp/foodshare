<?php
require_once 'ConexaoBD.php';

class Doacao {

    public function listarDoacoes() {
        $conexao = new ConexaoBD();
        $pdo = $conexao->conectar();
        $stmt = $pdo->prepare("SELECT * FROM doacoes ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrarDoacao($usuario_id, $titulo, $categoria, $peso_str, $validade, $endereco, $descricao, $status) {
        $conexao = new ConexaoBD();
        $pdo = $conexao->conectar();

        $stmtDoador = $pdo->prepare("
            SELECT d.id as doador_id, u.nome as origem 
            FROM doadores d 
            JOIN usuarios u ON d.usuario_id = u.id 
            WHERE u.id = :uid
        ");
        $stmtDoador->execute([':uid' => $usuario_id]);
        $doador = $stmtDoador->fetch(PDO::FETCH_ASSOC);

        if (!$doador) {
            return "Erro: Apenas contas do tipo 'Doador' podem registar alimentos.";
        }

        $quantidade = (int) preg_replace('/[^0-9]/', '', $peso_str);
        if ($quantidade <= 0) $quantidade = 1;

        $sql = "INSERT INTO doacoes 
                (doador_id, descricao, tipo_alimento, quantidade, data_disponivel, status, endereco, origem, peso)
                VALUES 
                (:doador_id, :descricao, :tipo, :quantidade, :data_disp, :status, :endereco, :origem, :peso_str)";
        
        $stmt = $pdo->prepare($sql);
        $sucesso = $stmt->execute([
            ':doador_id' => $doador['doador_id'],
            ':descricao' => $titulo . " - " . $descricao,
            ':tipo'      => $categoria,
            ':quantidade'=> $quantidade,
            ':data_disp' => $validade,
            ':status'    => $status,
            ':endereco'  => $endereco,
            ':origem'    => $doador['origem'],
            ':peso_str'  => $peso_str
        ]);

        return $sucesso ? true : "Erro ao guardar a doação na base de dados.";
    }
}
?>