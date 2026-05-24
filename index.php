<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Home - FoodShare</title>

    <!-- CSS conforme padrão das outras páginas -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Biblioteca p/ icones (Font Awesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php 
// inclui o topo do site (head, abertura do body, navegacao)
include_once ('includes/header.php'); 
?>
<main>
    <section class="hero">
        <div class="container-home">
            <div class="hero-grid">
                <div class="hero-content">
                    <span class="badge">
                        <i class="fa-solid fa-heart"></i> 
                        Lutando pela fome, juntos!
                    </span>
                    <h1>Compartilhe Alimentos,<br> <span>Compartilhe Esperança</span></h1>
                    <p class="hero-description">
                        Conectamos empresas com excedentes de alimentos a pessoas e instituições que precisam. 
                        Juntos, podemos reduzir o desperdício de comida e combater a fome em nossas comunidades.
                    </p>
                    <a href="cadastro.php" class="btn-venha">Venha fazer parte</a>

                    <div class="stats">
                        <div class="stat-item">
                            <h3>+5mil</h3>
                            <p>Refeições compartilhadas</p>
                        </div>
                        <div class="stat-item">
                            <h3>+100</h3>
                            <p>Parceiros</p>
                        </div>
                        <div class="stat-item">
                            <h3>+10</h3>
                            <p>Cidades Atendidas</p>
                        </div>
                    </div>
                </div>

                <div class="hero-visual-mockup">
                    <div class="mockup-base"></div>
                    
                    <div class="floating-card card-vegetais">
                        <div class="icon-circle"><i class="fa-solid fa-box-open"></i></div>
                        <div>
                            <strong>Vegetais Frescos</strong><br>
                            <small>20kg Disponíveis</small>
                        </div>
                    </div>
                    
                    <div class="floating-card card-ong">
                        <div class="icon-circle yellow"><i class="fa-regular fa-user"></i></div>
                        <div>
                            <strong>Ong Comunitária</strong><br>
                            <small>Pedido de doação feito</small>
                        </div>
                    </div>

                    <div class="floating-card card-doacoes">
                        <div class="icon-circle green"><i class="fa-solid fa-heart"></i></div>
                        <strong>+15 Doações hoje</strong>
                    </div>

                    <div class="stat-salvos-box">
                        <h2>2,450 kg</h2>
                        <p>De alimentos salvos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sobre-section">
        <div class="container-sobre">
            <h2>Sobre Nós</h2>
            <p class="subtitle-sobre">Acreditamos que nenhum alimento deve ser desperdiçado enquanto há pessoas passando fome.<br>Nossa plataforma faz a ponte entre o excesso de alimentos e a insegurança alimentar</p>

            <div class="sobre-grid">
                <div class="sobre-card">
                    <div class="icon-box"><i class="fa-solid fa-heart-pulse"></i></div>
                    <h4>Reduzimos o desperdício de alimentos</h4>
                    <p>Ajudamos restaurantes e mercados a direcionar o excedente para quem precisa.</p>
                </div>
                <div class="sobre-card">
                    <div class="icon-box"><i class="fa-solid fa-mug-hot"></i></i></div>
                    <h4>Alimentamos comunidades</h4>
                    <p>Conectamos abrigos locais, bancos de alimentos, ongs e cozinhas comunitárias para fazer uma diferença real.</p>
                </div>
                <div class="sobre-card">
                    <div class="icon-box"><i class="fa-solid fa-earth-americas"></i></div>
                    <h4>Impacto sustentável</h4>
                    <p>Fazemos parte de um movimento em crescimento que une responsabilidade ambiental e impacto social.</p>
                </div>
            </div>
        </div>
    </section>
</main>
