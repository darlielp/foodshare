<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// MOCK DE LOCALIZAÇÕES
$locais = [
    [
        'nome' => 'Alimentos Frescos Ltda.',
        'lat' => -23.550520,
        'lng' => -46.633308,
        'tipo' => 'doador'
    ],
    [
        'nome' => 'Mercado Verde',
        'lat' => -23.558700,
        'lng' => -46.625000,
        'tipo' => 'doador'
    ],
    [
        'nome' => 'ONG Esperança',
        'lat' => -23.545000,
        'lng' => -46.640000,
        'tipo' => 'receptor'
    ],
    [
        'nome' => 'Centro Solidário',
        'lat' => -23.560000,
        'lng' => -46.650000,
        'tipo' => 'receptor'
    ]
];

// CONTADORES DINÂMICOS
$totalDoadores = count(
    array_filter($locais, fn($l) => $l['tipo'] === 'doador')
);

$totalReceptores = count(
    array_filter($locais, fn($l) => $l['tipo'] === 'receptor')
);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Doações</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>

<?php require_once '../includes/sidebar.php'; ?>

<main class="dashboard">

    <div class="mapa-header">

        <div>
            <h1>Mapa de Doações</h1>

            <p class="subtitle">
                Encontre doações de alimentos disponíveis perto de você
            </p>
        </div>

    </div>

    <?php include '../includes/components/mapa_foodshare.php'; ?>

</main>

<script>
    const locais = <?= json_encode($locais) ?>;
</script>

<script src="../js/mapa.js"></script>

</body>
</html>