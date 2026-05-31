<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Doação</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php require_once '../includes/sidebar.php'; ?>

<main class="dashboard">

    <div class="top-bar">
        <div>
            <h1>Nova Doação</h1>
            <p class="subtitle">Cadastre uma nova doação de alimentos</p>
        </div>
        <a href="doacoes.php" class="btn btn-register">Voltar</a>
    </div>

    <div class="form-card">
        <form action="../Controller/NovaDoacaoController.php" method="POST" class="form-doacao">

            <div class="form-row">
                <div class="form-group">
                    <label>Título da Doação</label>
                    <input type="text" name="titulo" placeholder="Ex: Mix de Vegetais" required>
                </div>

                <div class="form-group">
                    <label>Categoria</label>
                    <select name="categoria" required>
                        <option value="">Selecione</option>
                        <option value="vegetais">Vegetais</option>
                        <option value="padaria">Padaria</option>
                        <option value="laticinios">Laticínios</option>
                        <option value="enlatados">Enlatados</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Peso / Quantidade</label>
                    <input type="text" name="peso" placeholder="Ex: 50kg" required>
                </div>

                <div class="form-group">
                    <label>Data de Validade</label>
                    <input type="date" name="validade" required>
                </div>
            </div>

            <div class="form-group">
                <label>Endereço</label>
                <input type="text" name="endereco" placeholder="Ex: Av. Paulista, 1000" required>
            </div>

            <div class="form-group">
                <label>Descrição</label>
                <textarea name="descricao" rows="5" placeholder="Descreva os alimentos disponíveis..." required></textarea>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="disponivel">Disponível</option>
                    <option value="solicitado">Solicitado</option>
                    <option value="concluido">Concluído</option>
                </select>
            </div>

            <div class="form-actions">
                <a href="doacoes.php" class="btn-cancelar">Cancelar</a>
                <button type="submit" class="btn-submit">Salvar Doação</button>
            </div>

        </form>
    </div>
</main>
</body>
</html>