<?php
session_start();

// Só receptores podem solicitar
if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'instituicao') {
    die("Acesso negado.");
}

require '../Model/ConexaoBD.php';

$doacao_id = filter_input(INPUT_POST, 'doacao_id', FILTER_VALIDATE_INT);

if ($doacao_id) {
    $conexao = new ConexaoBD();
    $pdo = $conexao->conectar();
    
    // Pega o id do usuario
    $id_usuario = $_SESSION['user']['id'];
    
    // Muda o status pra solicitado e salva o id do usuario que solicitou
    $stmt = $pdo->prepare("UPDATE doacoes SET status = 'solicitado', receptor_id = :receptor_id WHERE id = :id AND status = 'disponivel'");
    $stmt->execute([
        ':receptor_id' => $id_usuario, 
        ':id' => $doacao_id
    ]);
}

header('Location: ../View/doacoes.php');
exit;