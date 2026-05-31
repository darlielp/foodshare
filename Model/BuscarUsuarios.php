<?php
require_once 'ConexaoBD.php';

class BuscarUsuarios {

    public function buscarUsuarioPorId($id) {
        if (!is_numeric($id)) return false;

        $conexao = new ConexaoBD();
        $pdo = $conexao->conectar();

        $sql = "
            SELECT 
                u.nome, u.email, u.tipo, u.telefone, u.endereco,
                COALESCE(d.cpf_cnpj, i.cnpj, '') AS documento,
                CASE 
                    WHEN u.tipo = 'admin' THEN 'FoodShare Admin'
                    WHEN u.tipo = 'instituicao' THEN COALESCE(i.area_atuacao, 'Instituição')
                    WHEN u.tipo = 'doador' AND d.tipo_doador = 'empresa' THEN 'Empresa'
                    WHEN u.tipo = 'doador' AND d.tipo_doador = 'pessoa_fisica' THEN 'Pessoa Física'
                    ELSE 'Não informada'
                END AS organizacao
            FROM usuarios u
            LEFT JOIN doadores d ON u.id = d.usuario_id
            LEFT JOIN instituicoes i ON u.id = i.usuario_id
            WHERE u.id = :id
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>