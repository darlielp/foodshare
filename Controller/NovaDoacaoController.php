<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../View/login.php');
    exit;
}

require '../Model/Doacao.php';

$titulo    = trim($_POST['titulo'] ?? '');
$categoria = trim($_POST['categoria'] ?? '');
$peso      = trim($_POST['peso'] ?? '');
$validade  = trim($_POST['validade'] ?? '');
$endereco  = trim($_POST['endereco'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$status    = trim($_POST['status'] ?? 'disponivel');

$usuario_id = $_SESSION['user']['id'];

if (empty($titulo) || empty($categoria) || empty($peso)) {
    die("Por favor, preencha todos os campos obrigatórios.");
}

$model = new Doacao();
$resultado = $model->cadastrarDoacao($usuario_id, $titulo, $categoria, $peso, $validade, $endereco, $descricao, $status);

if ($resultado === true) {
    header('Location: ../View/doacoes.php');
    exit;
} else {
    echo "<script>alert('" . $resultado . "'); window.history.back();</script>";
}