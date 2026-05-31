<?php
require '../Model/Usuario.php';

$nome = htmlspecialchars(trim($_POST['nome'] ?? ''));
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = trim($_POST['senha'] ?? '');
$tipo_html = $_POST['tipo'] ?? 'doador';
$documento = trim($_POST['documento'] ?? '');

$tipo = ($tipo_html === 'recebedor') ? 'instituicao' : 'doador';

if (!$email) {
    die('Email inválido');
}

if (empty($documento)) {
    die('O CPF/CNPJ é obrigatório.');
}

$model = new Usuario();

$resultado = $model->criarUsuario($nome, $email, $senha, $tipo, $documento);

if ($resultado === true) {
    header('Location: ../View/login.php'); 
    exit;
} else {
    echo "<script>alert('Erro: " . $resultado . "'); window.history.back();</script>";
}