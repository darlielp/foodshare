<?php
// MOCK (depois vem do banco)
$doacoesRecentes = [
    [
        'titulo' => 'Mix de Vegetais Frescos',
        'origem' => 'Alimentos Frescos Ltda.',
        'status' => 'disponivel'
    ],
    [
        'titulo' => 'Alimentos Enlatados',
        'origem' => 'Mercado Verde',
        'status' => 'disponivel'
    ],
    [
        'titulo' => 'Itens de Padaria',
        'origem' => 'Padaria da Esquina',
        'status' => 'solicitado'
    ],
    [
        'titulo' => 'Produtos Lácteos',
        'origem' => 'Alimentos Frescos Ltda.',
        'status' => 'disponivel'
    ],
    [
        'titulo' => 'Cesta de Frutas',
        'origem' => 'Alimentos Frescos Ltda.',
        'status' => 'concluido'
    ]
];

$categorias = [
    ['nome' => 'Alimentos Frescos', 'percentual' => 35],
    ['nome' => 'Alimentos Não Perecíveis', 'percentual' => 25],
    ['nome' => 'Refeições Preparadas', 'percentual' => 20],
    ['nome' => 'Padaria', 'percentual' => 12],
    ['nome' => 'Outros', 'percentual' => 8],
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php require_once 'includes/sidebar.php'; ?>

<main class="dashboard">

    <h1>Bem vindo de volta, Usuário!</h1>
    <p class="subtitle">Gerencie a plataforma e monitore as atividades.</p>

    <!-- COMPONENTE CARDS -->
    <?php require_once 'includes/components/cards.php'; ?>

    <div class="dashboard-grid">
        <?php require_once 'includes/components/doacoes_recentes.php'; ?>
        <?php require_once 'includes/components/categorias.php'; ?>
    </div>

</main>

</body>
</html>