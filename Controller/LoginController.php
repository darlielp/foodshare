<?php

session_start();

require '../Model/ConexaoBD.php';

$email = trim($_POST['email'] ?? '');

$senha = trim($_POST['senha'] ?? '');

if (empty($email) || empty($senha)) {

    die('Preencha todos os campos.');
}

$conexao = new ConexaoBD();

$pdo = $conexao->conectar();

$sql = "
    SELECT *
    FROM usuarios
    WHERE email = :email
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':email' => $email
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {

    header('Location: ../View/login.php?erro=1');
    exit;
}

if (password_verify($senha, $user['senha'])) {

    $_SESSION['user'] = [

        'id' => $user['id'],

        'nome' => $user['nome'],

        'email' => $user['email'],

        'tipo' => $user['tipo']
    ];

    // Se for Admin, vai pro Dashboard. Se não for, vai pra Doações!
    if ($user['tipo'] === 'admin') {
        header('Location: ../View/dashboard.php');
    } else {
        header('Location: ../View/doacoes.php');
    }

    exit;

} else {

    header('Location: ../View/login.php?erro=1');
    exit;
}