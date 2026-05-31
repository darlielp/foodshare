<?php
session_start();

// Só adms podem apagar usuarios
if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'admin') {
    die("Acesso negado. Apenas administradores podem excluir contas.");
}

require '../Model/ConexaoBD.php';

$id_para_excluir = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$id_logado = $_SESSION['user']['id'];

// Impede que o adm se apague
if ($id_para_excluir && $id_para_excluir !== $id_logado) {
    
    $conexao = new ConexaoBD();
    $pdo = $conexao->conectar();
    
    try {
        // Tenta excluir o usuário
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => $id_para_excluir]);
        
    } catch (PDOException $e) {
        // Se der erro retorna um alerta
        echo "<script>
                alert('Não foi possível excluir. Este utilizador tem doações ou pedidos associados no sistema.'); 
                window.location.href='../View/usuarios.php';
              </script>";
        exit;
    }
}

header('Location: ../View/usuarios.php');
exit;