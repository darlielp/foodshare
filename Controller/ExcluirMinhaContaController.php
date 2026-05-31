<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../View/login.php');
    exit;
}

require '../Model/ConexaoBD.php';

$id = $_SESSION['user']['id'];

$conexao = new ConexaoBD();
$pdo = $conexao->conectar();

try {
    // Apaga o usuario
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->execute([':id' => $id]);

    // Deslogar a pessoa
    session_destroy();

    // Redireciona para o login com mensagem
    echo "<script>
            alert('A sua conta e todos os seus dados foram excluídos com sucesso. Esperamos vê-lo novamente!'); 
            window.location.href='../View/login.php';
          </script>";
    exit;

} catch (PDOException $e) {
    echo "<script>alert('Erro ao excluir a conta. Pode haver pedidos pendentes que impedem a exclusão.'); window.location.href='../View/perfil.php';</script>";
    exit;
}