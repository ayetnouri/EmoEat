<?php
include("connexion.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription - EmoEat</title>
    <link rel="stylesheet" href="/EmoEat/style.css?v=10">
</head>

<body>

<div class="container">

<h2>📝 Créer un compte EmoEat</h2>

<p>Rejoignez le système de recommandations alimentaires 🍽</p>

<form method="POST">

    <label>Nom</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Mot de passe</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="register">S'inscrire</button>

</form>

<br>

<a href="login.php">Déjà un compte ? Se connecter</a>

<hr>

<?php

if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "
        INSERT INTO Users (id_user, name, email, password, created_at)
        VALUES (SEQ_USERS.NEXTVAL, :name, :email, :password, SYSDATE)
    ";

    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ":name", $name);
    oci_bind_by_name($stmt, ":email", $email);
    oci_bind_by_name($stmt, ":password", $password);

    $result = oci_execute($stmt);

    if($result)
    {
        echo "<p style='color:green;'>✔ Compte créé avec succès !</p>";
    }
    else
    {
        $e = oci_error($stmt);
        echo "<p style='color:red;'>❌ Erreur : ".$e['message']."</p>";
    }
}
?>

</div>

</body>
</html>