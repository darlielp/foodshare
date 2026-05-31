<?php
session_start();

// Apaga as variaveis do servidor
$_SESSION = array();

// Destrói a sessão
session_destroy();

// Volta pra tela de login
header('Location: ../View/login.php');
exit;