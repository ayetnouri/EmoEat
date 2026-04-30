<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$role = isset($_SESSION['role']) ? strtoupper(trim($_SESSION['role'])) : "CLIENT";
$name = $_SESSION['user_name'] ?? "Utilisateur";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - EmoEat</title>
    <link rel="stylesheet" href="/EmoEat/style.css?v=10">
</head>

<body>

<div class="container">

    <h2>🎉 Bienvenue <?php echo $name; ?></h2>

    <p>
        Rôle : <strong><?php echo $role; ?></strong>
    </p>

    <hr>

    <h3>📌 Menu principal</h3>

    <a href="recommandation.php">🍽 Obtenir une recommandation</a>

    <a href="profile.php">👤 Mon profil</a>
    <a href="historique.php">📊 Historique</a>

    <?php if($role === "ADMIN") { ?>
        <a href="dashboard_admin.php">⚙️ Dashboard Admin</a>
    <?php } ?>

    <a class="logout" href="logout.php">🚪 Se déconnecter</a>

</div>

</body>
</html>