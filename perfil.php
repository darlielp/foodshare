<!-- MOCK DE USUÁRIOS -->
<?php $usuariosMock = [
    [
        "id" => 1,
        "nome" => "Usuário Adm",
        "email" => "admin@fooshare.com",
        "tipo_conta" => "administrador", // Substitui o antigo termo "função"
        "organizacao" => "FoodShare",
        "documento" => "123.456.789-10",
        "telefone" => "(11) 99999-9999",
        "endereco" => "Rua da Sede Central, 100 - São Paulo - SP",
        "senha" => "123456"
    ],
    [
        "id" => 2,
        "nome" => "Alimentos Frescos Ltda.",
        "email" => "contato@alimentosfrescos.com",
        "tipo_conta" => "doador",
        "organizacao" => "Alimentos Frescos Ltda.",
        "documento" => "12.345.678/0001-99",
        "telefone" => "(13) 3333-4444",
        "endereco" => "Av. das Nações, 450 - Praia Grande - SP",
        "senha" => "doador123"
    ],
    [
        "id" => 3,
        "nome" => "ONG Comunitária Viva",
        "email" => "info@ongcomunitaria.org",
        "tipo_conta" => "receptor",
        "organizacao" => "Associação Ong Comunitária",
        "documento" => "98.765.432/0001-10",
        "telefone" => "(11) 98888-7777",
        "endereco" => "Rua Solidária, 12 - São Paulo - SP",
        "senha" => "receptor123"
    ]
];

// simulacao de sessao
$emailSessaoLogado = 'contato@alimentosfrescos.com'; 

// busca o usuario
$dadosUsuario = null;
foreach ($usuariosMock as $usr) {
    if ($usr['email'] === $emailSessaoLogado) {
        $dadosUsuario = $usr;
        break;
    }
}

// fallback
if (!$dadosUsuario) {
    $dadosUsuario = [
        "id" => 0, "nome" => "Usuário Novo", "email" => $emailSessaoLogado, 
        "tipo_conta" => "doador", "organizacao" => "", "documento" => "", 
        "telefone" => "", "endereco" => ""
    ];
}
?> 

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS conforme padrão das outras páginas -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Biblioteca p/ icones (Font Awesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php require_once 'includes/sidebar.php';?>
    <main class="dashboard">
        <!-- cabeçalho -->
        <header class="perfil-header">
            <h1>Perfil</h1>
            <p class="subtitle-perfil">Gerencie as informações da sua conta</p>
        </header>

        <!-- card de identificação -->
        <section class="card-box profile-banner-card">
            <div class="banner-color"></div>
            <div class="profile-info-wrapper">
                <div class="profile-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                
                <div class="profile-text">
                    <h2><?= htmlspecialchars($dadosUsuario['nome']); ?></h2>
                    <p><?= htmlspecialchars(ucfirst($dadosUsuario['tipo_conta'])); ?></p>
                </div>
            </div>
        </section>

        <!-- formulario de informações -->
        <section class="card-box profile-details-form">
            <h3>Informações da Conta</h3>
            <p class="subtitle" style="text-align: left; margin-bottom: 25px;">Seus dados pessoais e de contato</p>

            <form action="atualizar_perfil.php" method="POST">
                <div class="form-grid">
                    <div class="form-control">
                        <label>Nome completo:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="nome" placeholder="Usuário" value="<?= htmlspecialchars($dadosUsuario['nome']); ?>">
                        </div>
                    </div>

                    <div class="form-control">
                        <label>Senha:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="senha" id="senha" value="<?= htmlspecialchars($dadosUsuario['senha']); ?>" placeholder="********">
        
                            <span type="button" class="toggle-password" onclick="toggleSenha()">
                                <i class="fa-solid fa-eye" id="iconeSenha"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-control">
                        <label>Organização:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-building"></i></span>
                            <input type="text" name="organizacao" placeholder="FoodShare" value="<?= htmlspecialchars($dadosUsuario['organizacao']); ?>">
                        </div>
                    </div>

                    <div class="form-control">
                        <label>Telefone:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-phone"></i></span>
                            <input type="text" name="telefone" placeholder="(11) 91234-5678" value="<?= htmlspecialchars($dadosUsuario['telefone']); ?>">
                        </div>
                    </div>

                    <div class="form-control">
                        <label>Email:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" id="email" placeholder="admin@foodshare.com" value="<?= htmlspecialchars($dadosUsuario['email']); ?>">
                        </div>
                        <span class="error-message" id="error-email"></span> <!-- ADD -->
                    </div>

                    <div class="form-control">
                        <label>CPF/CNPJ:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-address-card"></i></span>
                            <input type="text" name="documento" id="documento" placeholder="123.456.789-10"
                            value="<?= htmlspecialchars($dadosUsuario['documento']); ?>"
                            oninput="mascaraDocumento(this); tratarDocumento(this)" 
                            maxlength="18" >
                        </div>
                        <span class="error-message" id="error-documento"></span> <!-- ADD -->
                    </div>

                    <div class="form-control full-width">
                        <label>Endereço:</label>
                        <div class="input-group">
                            <span class="icon"><i class="fa-solid fa-location-dot"></i></span>
                            <input type="text" name="endereco" placeholder="Rua Aleatória Número 102 - SP" value="<?= htmlspecialchars($dadosUsuario['endereco']); ?>">
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

        <!-- ação de risco -->
        <div class="danger-zone">
            <button class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.')">
                <i class="fa-solid fa-trash-can"></i> DELETAR CONTA
            </button>
        </div>
    </main>
    <script src="js/validacoes.js"></script>
</body>
</html>