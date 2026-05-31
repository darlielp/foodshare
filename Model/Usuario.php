<?php

require_once 'ConexaoBD.php';

class Usuario
{
    public function criarUsuario($nome, $email, $senha, $tipo, $documento)
    {
        if (empty($nome) || empty($email) || empty($senha) || empty($documento)) {
            return "Preencha todos os campos.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Email inválido.";
        }

        $conexao = new ConexaoBD();
        $pdo = $conexao->conectar();

        try {
            $pdo->beginTransaction();

            //VERIFICA SE EMAIL JÁ EXISTE
            $check = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
            $check->execute([':email' => $email]);
            if ($check->fetch()) {
                $pdo->rollBack();
                return "Email já cadastrado.";
            }

            // CRIPTOGRAFA SENHA
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            // INSERE USUÁRIO BASE
            $sqlUser = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)";
            $stmtUser = $pdo->prepare($sqlUser);
            $stmtUser->execute([
                ':nome' => htmlspecialchars($nome),
                ':email' => htmlspecialchars($email),
                ':senha' => $senhaHash,
                ':tipo' => $tipo
            ]);

            // Pega o ID do usuário que acabou de criar
            $usuario_id = $pdo->lastInsertId();

            $documento_limpo = preg_replace('/[^0-9]/', '', $documento);

            // INSERE NA TABELA ESPECÍFICA (Doador ou Instituição)
            if ($tipo === 'doador') {
                // Descobre se é PF ou PJ pelo tamanho do numero
                $tipo_doador = (strlen($documento_limpo) <= 11) ? 'pessoa_fisica' : 'empresa';
                
                $sqlDoador = "INSERT INTO doadores (usuario_id, cpf_cnpj, tipo_doador) VALUES (:usuario_id, :cpf_cnpj, :tipo_doador)";
                $stmtDoador = $pdo->prepare($sqlDoador);
                $stmtDoador->execute([
                    ':usuario_id' => $usuario_id,
                    ':cpf_cnpj' => $documento_limpo,
                    ':tipo_doador' => $tipo_doador
                ]);

            } elseif ($tipo === 'instituicao') {
                // Insere na tabela de instituições
                $sqlInst = "INSERT INTO instituicoes (usuario_id, cnpj, area_atuacao) VALUES (:usuario_id, :cnpj, :area)";
                $stmtInst = $pdo->prepare($sqlInst);
                $stmtInst->execute([
                    ':usuario_id' => $usuario_id,
                    ':cnpj' => $documento_limpo,
                    ':area' => 'Assistência Social' 
                ]);
            }

            $pdo->commit();
            return true;

        } catch (PDOException $e) {
            // Se der qualquer problema refaz tudo
            $pdo->rollBack();
            
            if ($e->getCode() == 23000) {
                return "Este CPF/CNPJ ou Email já está em uso.";
            }
            
            return "Erro interno: " . $e->getMessage();
        }
    }
}