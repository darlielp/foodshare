<?php
require_once 'ConexaoBD.php';

class ListarUsuarios {

    public function lerUsuarios() {
        $conexao = new ConexaoBD();
        $pdo = $conexao->conectar();
        $sql = "
            SELECT 
                u.id, u.nome, u.email, u.tipo,
                COALESCE(d.cpf_cnpj, i.cnpj, 'N/A') AS documento,
                CASE 
                    WHEN u.tipo = 'admin' THEN 'Plataforma FoodShare'
                    WHEN u.tipo = 'instituicao' THEN COALESCE(i.area_atuacao, 'Instituição Parceira')
                    WHEN u.tipo = 'doador' AND d.tipo_doador = 'empresa' THEN 'Empresa'
                    WHEN u.tipo = 'doador' AND d.tipo_doador = 'pessoa_fisica' THEN 'Pessoa Física'
                    ELSE 'Não informada'
                END AS organizacao
            FROM usuarios u
            LEFT JOIN doadores d ON u.id = d.usuario_id
            LEFT JOIN instituicoes i ON u.id = i.usuario_id
            ORDER BY u.id DESC
        ";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>