<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require '../Model/BuscarUsuarios.php';

$usuario_id = $_SESSION['user']['id'];

$model = new BuscarUsuarios();
$dadosUsuario = $model->buscarUsuarioPorId($usuario_id);

if (!$dadosUsuario) {
    die("Erro ao carregar os dados do perfil.");
}

$tipoVisual = 'Desconhecido';
if ($dadosUsuario['tipo'] === 'admin') $tipoVisual = 'Administrador';
if ($dadosUsuario['tipo'] === 'doador') $tipoVisual = 'Doador';
if ($dadosUsuario['tipo'] === 'instituicao') $tipoVisual = 'Receptor';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - FoodShare</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php require_once '../includes/sidebar.php';?>
    
    <main class="dashboard">
        <header class="perfil-header">
            <h1>Perfil</h1>
            <p class="subtitle-perfil">Gerencie as informações da sua conta</p>
        </header>

        <section class="card-box profile-banner-card">
            <div class="banner-color"></div>
            <div class="profile-info-wrapper">
                <div class="profile-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                
                <div class="profile-text">
                    <h2><?= htmlspecialchars($dadosUsuario['nome']); ?></h2>
                    <p><?= htmlspecialchars($tipoVisual); ?></p>
                </div>
            </div>
        </section>

        <section class="card-box profile-details-form">
            <h3>Informações da Conta</h3>
            <p class="subtitle" style="text-align: left; margin-bottom: 25px;">Seus dados pessoais e de contato</p>

            <form action="../Controller/AtualizarPerfilController.php" method="POST">
                <div class="form-grid">
                    
                    <div class="form-control">
                        <label>Nome completo:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="nome" value="<?= htmlspecialchars($dadosUsuario['nome']); ?>" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label>Senha:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="senha" id="senha" placeholder="Deixe em branco para manter a atual">
                            <span type="button" class="toggle-password" onclick="toggleSenha()">
                                <i class="fa-solid fa-eye" id="iconeSenha"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-control">
                        <label>Organização:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-building"></i></span>
                            <input type="text" name="organizacao" value="<?= htmlspecialchars($dadosUsuario['organizacao']); ?>" readonly style="background: #f4f4f4;">
                        </div>
                    </div>

                    <div class="form-control">
                        <label>Telefone:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-phone"></i></span>
                            <input type="text" name="telefone" value="<?= htmlspecialchars($dadosUsuario['telefone']); ?>">
                        </div>
                    </div>

                    <div class="form-control">
                        <label>Email:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" id="email" value="<?= htmlspecialchars($dadosUsuario['email']); ?>" required>
                        </div>
                        <span class="error-message" id="error-email"></span>
                    </div>

                    <div class="form-control">
                        <label>CPF/CNPJ:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-address-card"></i></span>
                            <input type="text" name="documento" id="documento" 
                            value="<?= htmlspecialchars($dadosUsuario['documento']); ?>"
                            readonly style="background: #f4f4f4;">
                        </div>
                        <span class="error-message" id="error-documento"></span>
                    </div>

                    <div class="form-control full-width">
                        <label>Endereço:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-location-dot"></i></span>
                            <input type="text" name="endereco" value="<?= htmlspecialchars($dadosUsuario['endereco']); ?>">
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-perfil" style="border:none; cursor:pointer; padding: 10px 25px;">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </section>

        <div class="danger-zone">
            <a href="../Controller/ExcluirMinhaContaController.php" class="btn-delete" style="text-decoration: none; display: inline-block; text-align: center;" onclick="return confirm('Tem certeza que deseja excluir sua conta? Esta ação apaga TODAS as suas doações e não pode ser desfeita.')">
                <i class="fa-solid fa-trash-can"></i> DELETAR CONTA
            </a>
        </div>
    </main>
    <script src="../js/validacoes.js"></script>
</body>
</html>