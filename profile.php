<?php
session_start();
include("connexion.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

/* =========================
   1. Vérifier si profil existe
========================= */
$query = "SELECT * FROM USER_PROFILE WHERE ID_USER = :id_user";
$stmt = oci_parse($conn, $query);
oci_bind_by_name($stmt, ":id_user", $user_id);
oci_execute($stmt);

$profile = oci_fetch_assoc($stmt);

/* =========================
   2. INSERT / UPDATE
========================= */
if(isset($_POST['save']))
{
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $allergies = $_POST['allergies'];
    $goal = $_POST['goal'];

    if($profile)
    {
        // UPDATE
        $sql = "UPDATE USER_PROFILE 
                SET weight = :weight,
                    height = :height,
                    allergies = :allergies,
                    goal = :goal
                WHERE id_user = :id_user";
    }
    else
    {
        // INSERT
        $sql = "INSERT INTO USER_PROFILE 
                (id_profile, id_user, weight, height, allergies, goal)
                VALUES (SEQ_PROFILE.NEXTVAL, :id_user, :weight, :height, :allergies, :goal)";
    }

    $stmt2 = oci_parse($conn, $sql);

    oci_bind_by_name($stmt2, ":id_user", $user_id);
    oci_bind_by_name($stmt2, ":weight", $weight);
    oci_bind_by_name($stmt2, ":height", $height);
    oci_bind_by_name($stmt2, ":allergies", $allergies);
    oci_bind_by_name($stmt2, ":goal", $goal);

    oci_execute($stmt2);

    $message = "Profil sauvegardé avec succès ✔";

    // reload profile
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mon Profil - EmoEat</title>
    <link rel="stylesheet" href="/EmoEat/style.css?v=10">
</head>

<body>

<div class="container">

<h2>👤 Mon Profil</h2>

<?php if($message != "") echo "<p style='color:green;'>$message</p>"; ?>

<form method="POST">

    <input type="number" name="weight" placeholder="Poids (kg)"
    value="<?php echo $profile['WEIGHT'] ?? ''; ?>"><br><br>

    <input type="number" name="height" placeholder="Taille (cm)"
    value="<?php echo $profile['HEIGHT'] ?? ''; ?>"><br><br>

    <input type="text" name="allergies" placeholder="Allergies"
    value="<?php echo $profile['ALLERGIES'] ?? ''; ?>"><br><br>

    <input type="text" name="goal" placeholder="Objectif (lose weight / gain / maintain)"
    value="<?php echo $profile['GOAL'] ?? ''; ?>"><br><br>

    <button type="submit" name="save">💾 Sauvegarder</button>

</form>

</div>

</body>
</html>