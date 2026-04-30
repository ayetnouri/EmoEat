<?php
session_start();
include("connexion.php");

$error = "";

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT ID_USER, NAME, PASSWORD, ROLE 
              FROM USERS 
              WHERE EMAIL = :email";

    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ":email", $email);
    oci_execute($stmt);

    $user = oci_fetch_assoc($stmt);

    if($user)
    {
        if($password == $user['PASSWORD'])
        {
            $_SESSION['user_id'] = $user['ID_USER'];
            $_SESSION['user_name'] = $user['NAME'];
            $_SESSION['role'] = strtoupper(trim($user['ROLE']));

            if($_SESSION['role'] === "ADMIN")
            {
                header("Location: dashboard_admin.php");
            }
            else
            {
                header("Location: dashboard.php");
            }
            exit();
        }
        else
        {
            $error = "Mot de passe incorrect";
        }
    }
    else
    {
        $error = "Email introuvable";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login EmoEat</title>
    <link rel="stylesheet" href="/EmoEat/style.css?v=10">
</head>

<body>

<div class="container">

    <h2>🍽 Connexion EmoEat</h2>

    <?php
    if(!empty($error))
    {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

    <form method="POST">

        <input type="email" name="email" placeholder="Email" required><br><br>

        <input type="password" name="password" placeholder="Mot de passe" required><br><br>

        <button type="submit" name="login">Se connecter</button>

    </form>

</div>

</body>
</html>