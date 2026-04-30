<?php
session_start();
include("connexion.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>EmoEat - Accueil</title>
    <link rel="stylesheet" href="/EmoEat/style.css?v=30">
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="logo">EmoEat</div>
    <div class="nav-links">
        <a href="index.php">Accueil</a>
        <a href="login.php">Connexion</a>
        <a href="register.php">Inscription</a>
    </div>
</div>

<!-- HERO -->
<div class="hero">
    <h1>Une alimentation adaptée à vos émotions</h1>
    <p>Découvrez des plats qui correspondent à votre humeur et votre bien-être</p>
</div>

<!-- INTRO -->
<div class="container">

    <h2>🌿 Bienvenue sur EmoEat</h2>

    <p>
        EmoEat est une plateforme intelligente qui combine nutrition et émotions pour vous proposer des repas adaptés à votre état mental et physique.
        Mangez mieux, vivez mieux.
    </p>

    <hr>

    <!-- FEATURE CARDS -->
    <h2>✨ Nos fonctionnalités</h2>

    <div class="food-grid">

        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836" width="100%" style="border-radius:10px;">
            <h3>Alimentation personnalisée</h3>
            <p>Des recommandations basées sur vos émotions et votre profil.</p>
        </div>

        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061" width="100%" style="border-radius:10px;">
            <h3>Nutrition équilibrée</h3>
            <p>Des plats adaptés à votre santé, poids et objectifs.</p>
        </div>

        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c" width="100%" style="border-radius:10px;">
            <h3>Expérience émotionnelle</h3>
            <p>Choisissez votre humeur et recevez des suggestions adaptées.</p>
        </div>

    </div>

    <hr>

    <!-- HOW IT WORKS -->
    <h2>⚙️ Comment ça marche</h2>

    <div class="info-box">
        <p>1. Créez un compte utilisateur</p>
        <p>2. Complétez votre profil nutritionnel</p>
        <p>3. Sélectionnez votre émotion actuelle</p>
        <p>4. Recevez des recommandations intelligentes</p>
    </div>

    <hr>

    <!-- CTA -->
    <div class="cta">

        <h2>Commencez votre expérience maintenant</h2>

        <a href="login.php">
            <button>Se connecter</button>
        </a>

        <a href="register.php">
            <button>S'inscrire</button>
        </a>

    </div>

</div>

</body>
</html>