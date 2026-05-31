<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../View/login.php');
    exit;
}

require '../Model/AtualizarDados.php';

$id = $_SESSION['user']['id'];
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$endereco = trim($_POST['endereco'] ?? '');
$senha_nova = $_POST['senha'] ?? '';

if (empty($nome) || empty($email)) {
    echo "<script>alert('Nome e Email são obrigatórios!'); window.history.back();</script>";
    exit;
}

$model = new AtualizarDados();
$resultado = $model->atualizarPerfilCompleto($id, $nome, $email, $telefone, $endereco, $senha_nova);

if ($resultado === "EMAIL_EXISTE") {
    echo "<script>alert('Este e-mail já está registado por outro utilizador.'); window.history.back();</script>";
    exit;
} elseif ($resultado === "SUCESSO") {
    $_SESSION['user']['nome'] = $nome;
    $_SESSION['user']['email'] = $email;

    echo "<script>alert('Perfil atualizado com sucesso!'); window.location.href='../View/perfil.php';</script>";
    exit;
} else {
    echo "<script>alert('Erro ao atualizar o perfil. Tente novamente.'); window.history.back();</script>";
    exit;
}
?>