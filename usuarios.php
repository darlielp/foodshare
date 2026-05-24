<?php
// Exemplo de array de dados simulando a consulta do banco de dados
$usuarios = [
    [
        "nome" => "Usuário",
        "email" => "admin@fooshare.com",
        "funcao" => "Administrador",
        "funcao_val" => "administrador",
        "organizacao" => "FoodShare",
        "documento" => "123.456.789-10"
    ],
    [
        "nome" => "Alimentos Frescos",
        "email" => "contato@alimentosfrescos.com",
        "funcao" => "Doador",
        "funcao_val" => "doador",
        "organizacao" => "Alimentos Frescos Ltda.",
        "documento" => "123.456.789-10"
    ],
    [
        "nome" => "Mercado Verde",
        "email" => "contato@mercadoverde.com",
        "funcao" => "Doador",
        "funcao_val" => "doador",
        "organizacao" => "Mercado Verde",
        "documento" => "123.456.789-10"
    ],
    [
        "nome" => "Ong Comunitaria",
        "email" => "info@ongcomunitaria.org",
        "funcao" => "Receptor",
        "funcao_val" => "receptor",
        "organizacao" => "Ong Comunitaria",
        "documento" => "123.456.789-10"
    ],
    [
        "nome" => "Fundação Abrigo",
        "email" => "contato@fundacaoabrigo.rog",
        "funcao" => "Receptor",
        "funcao_val" => "receptor",
        "organizacao" => "Fundação Abrigo",
        "documento" => "123.456.789-10"
    ]
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários - FoodShare</title>

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php require_once 'includes/sidebar.php';?>

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
                        <option value="administrador">Administrador</option>
                        <option value="doador">Doador</option>
                        <option value="receptor">Receptor</option>
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
                            <th style="width: 3%; text-align: center;"></th>
                        </tr>
                    </thead>
                    <tbody id="lista-usuarios-corpo">
                        <?php foreach ($usuarios as $usr): ?>
                            <tr class="linha-usuario" 
                                data-nome="<?= htmlspecialchars(strtolower($usr['nome'])); ?>" 
                                data-email="<?= htmlspecialchars(strtolower($usr['email'])); ?>" 
                                data-funcao="<?= $usr['funcao_val']; ?>">
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-placeholder"></div>
                                        <span><?= htmlspecialchars($usr['nome']); ?></span>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($usr['email']); ?></td>
                                <td>
                                    <?php 
                                        $classe_badge = ($usr['funcao'] == 'Administrador') ? 'status funcao-admin' : '';
                                        if ($usr['funcao'] == 'Doador') $classe_badge = 'status disponivel';
                                        if ($usr['funcao'] == 'Receptor') $classe_badge = 'status solicitado';
                                    ?>
                                    <span class="<?= $classe_badge; ?>">
                                        <?= htmlspecialchars($usr['funcao']); ?>
                                    </span>
                                
                                </td>
                                <td><?= htmlspecialchars($usr['organizacao']); ?></td>
                                <td><?= htmlspecialchars($usr['documento']); ?></td>
                                <td style="text-align: center;">
                                    <button class="btn-opcoes" title="Opções">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
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

    <script src="js/filtros_usuarios.js"></script>
</body>
</html>