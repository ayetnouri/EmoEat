<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== "ADMIN")
{
    header("Location: login.php");
    exit();
}

$name = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/EmoEat/style.css?v=10">
</head>

<body>

<div class="container">

    <h2>👑 Dashboard ADMIN</h2>

    <p>Bienvenue <?php echo $name; ?></p>

    <hr>

    <h3>Gestion</h3>

    <a href="#">👥 Gérer les utilisateurs</a>
    <a href="#">🍽 Gérer les aliments</a>
    <a href="admin_emotions.php">😊 Gérer les émotions</a>
    <a href="#">⭐ Gérer les recommandations</a>

    <a class="logout" href="logout.php">🚪 Se déconnecter</a>

</div>

</body>
</html>