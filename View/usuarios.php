<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'admin') {
    header('Location: doacoes.php');
    exit;
}

require '../Model/ListarUsuarios.php';

$model = new ListarUsuarios();
$usuarios = $model->lerUsuarios();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários - FoodShare</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php require_once '../includes/sidebar.php';?>

    <main class="dashboard">
        <h1>Gerenciamento de Usuários</h1>
        <p class="subtitle-usuarios">Gerencie todos os usuários da plataforma</p>

        <div class="card-box">
            <div class="card-header-usuarios">
                <div>
                    <h3 class="card-title-usuarios">Todos os Usuários</h3>
                    <p class="card-counter-usuarios"><span id="total-usuarios"><?= count($usuarios); ?></span> usuários no total</p>
                </div>
                
                <div class="filtros-usuarios">
                    <select id="filtroFuncao" class="select-filtro">
                        <option value="">Todas as funções</option>
                        <option value="admin">Administrador</option>
                        <option value="doador">Doador</option>
                        <option value="instituicao">Receptor (Instituição)</option>
                    </select>

                    <div class="busca-container">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="buscaUsuarios" class="input-busca" placeholder="Procurar usuários...">
                    </div>
                </div>
            </div>

            <div class="tabela-container">
                
                <table class="tabela-usuarios" id="tabela-usuarios-lista">
                    <thead>
                        <tr>
                            <th style="width: 25%;">Usuário</th>
                            <th style="width: 25%;">Email</th>
                            <th style="width: 15%;">Função</th>
                            <th style="width: 20%;">Organização</th>
                            <th style="width: 12%;">CPF/CNPJ</th>
                            <th style="width: 3%; text-align: center;">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="lista-usuarios-corpo">
                        <?php foreach ($usuarios as $usr): 
                            
                           
                            $tipoBD = strtolower($usr['tipo'] ?? '');
                            $funcaoNome = 'Desconhecido';
                            $classe_badge = '';
                            
                            if ($tipoBD === 'admin') {
                                $funcaoNome = 'Administrador';
                                $classe_badge = 'status funcao-admin';
                            } elseif ($tipoBD === 'doador') {
                                $funcaoNome = 'Doador';
                                $classe_badge = 'status disponivel';
                            } elseif ($tipoBD === 'instituicao') {
                                $funcaoNome = 'Receptor';
                                $classe_badge = 'status solicitado';
                            }

                            
                            $organizacao = $usr['organizacao'] ?? 'Não informado';
                            $documento = $usr['documento'] ?? 'N/A';
                        ?>
                            <tr class="linha-usuario" 
                                data-nome="<?= htmlspecialchars(strtolower($usr['nome'])); ?>" 
                                data-email="<?= htmlspecialchars(strtolower($usr['email'])); ?>" 
                                data-funcao="<?= $tipoBD; ?>">
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-placeholder">
                                            <i class="fa-solid fa-user" style="color: #fff; margin-top: 8px; display: block; text-align: center;"></i>
                                        </div>
                                        <span><?= htmlspecialchars($usr['nome']); ?></span>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($usr['email']); ?></td>
                                <td>
                                    <span class="<?= $classe_badge; ?>" style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold;">
                                        <?= $funcaoNome; ?>
                                    </span>
                                </td>
                                <td style="color: #666; font-size: 14px;"><?= htmlspecialchars($organizacao); ?></td>
                                <td style="color: #666; font-size: 14px;"><?= htmlspecialchars($documento); ?></td>
                                <td style="text-align: center;">
                                    
                                    <?php if ($usr['id'] !== $_SESSION['user']['id']): ?>
                                        <a href="../Controller/ExcluirUsuarioController.php?id=<?= $usr['id'] ?>" 
                                           class="btn-delete" 
                                           onclick="return confirm('Tem certeza que deseja excluir esta conta?')"
                                           title="Excluir"
                                           style="text-decoration: none; font-size: 16px;">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    <?php else: ?>
                                        <span style="color: #ccc; font-size: 12px;" title="Sua conta">Você</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div id="aviso-sem-resultados" style="display: none; text-align: center; padding: 60px 20px; color: #888;">
                    <i class="fa-solid fa-user-slash" style="font-size: 32px; display: block; margin-bottom: 12px; color: #ccc;"></i>
                    <p style="font-size: 14px; margin: 0;">Nenhum usuário encontrado para a pesquisa realizada.</p>
                </div>

            </div>

        </div>
    </main>

    <script src="../js/filtros_usuarios.js"></script>
</body>
</html>