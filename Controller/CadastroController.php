<?php

require '../Model/Usuario.php';

$nome = htmlspecialchars(
    trim($_POST['nome'])
);

$email = filter_input(
    INPUT_POST,
    'email',
    FILTER_VALIDATE_EMAIL
);

$senha = trim($_POST['senha']);

$tipo = 'usuario';

if (!$email) {

    die('Email inválido');
}

$model = new Usuario();

$resultado = $model->criarUsuario(
    $nome,
    $email,
    $senha,
    $tipo
);

if ($resultado === true) {

    header('Location: ../View/login.php');

    exit;
} else {

    echo $resultado;
}
