<?php
session_start();

// Verifica se está logado e se é Admin ou Doador
$tipo = $_SESSION['user']['tipo'] ?? '';
if (!isset($_SESSION['user']) || ($tipo !== 'admin' && $tipo !== 'doador')) {
    die("Você não tem permissão para excluir.");
}

require '../Model/ConexaoBD.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $conexao = new ConexaoBD();
    $pdo = $conexao->conectar();
    
    // Deleta a doação do banco
    $stmt = $pdo->prepare("DELETE FROM doacoes WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: ../View/doacoes.php');
exit;