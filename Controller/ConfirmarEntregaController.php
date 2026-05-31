<?php
session_start();

// Só quem recebe pode confirmar a entrega
if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'instituicao') {
    die("Acesso negado.");
}

require '../Model/ConexaoBD.php';

$doacao_id = filter_input(INPUT_POST, 'doacao_id', FILTER_VALIDATE_INT);

if ($doacao_id) {
    $conexao = new ConexaoBD();
    $pdo = $conexao->conectar();
    
    // Pega o ID do usuario logado
    $id_usuario = $_SESSION['user']['id'];
    
    // Só pode confirmar se o ID se quem solicitou for o mesmo de quem recebeu
    $stmt = $pdo->prepare("UPDATE doacoes SET status = 'concluido' WHERE id = :id AND status = 'solicitado' AND receptor_id = :receptor_id");
    $stmt->execute([
        ':id' => $doacao_id,
        ':receptor_id' => $id_usuario
    ]);
}

header('Location: ../View/doacoes.php');
exit;