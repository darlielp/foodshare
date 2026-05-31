<?php
session_start();

// Verifica se está logado e se não é um receptor
if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] === 'instituicao') {
    die("Você não tem permissão para editar doações.");
}

require '../Model/ConexaoBD.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$titulo = trim($_POST['titulo'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$peso_str = trim($_POST['peso'] ?? '');
$validade = trim($_POST['validade'] ?? '');

if ($id && $titulo && $descricao && $peso_str) {
    $conexao = new ConexaoBD();
    $pdo = $conexao->conectar();
    
    $descricaoCompleta = $titulo . " - " . $descricao;
    
    $quantidade = (int) preg_replace('/[^0-9]/', '', $peso_str);
    if ($quantidade <= 0) $quantidade = 1;
    
    // Atualiza doacao
    $stmt = $pdo->prepare("
        UPDATE doacoes 
        SET descricao = :descricao, 
            peso = :peso_str, 
            quantidade = :quantidade, 
            data_disponivel = :validade 
        WHERE id = :id
    ");

    $stmt->execute([
        ':descricao' => $descricaoCompleta,
        ':peso_str' => $peso_str,
        ':quantidade' => $quantidade,
        ':validade' => $validade,
        ':id' => $id
    ]);
}

header('Location: ../View/doacoes.php');
exit;