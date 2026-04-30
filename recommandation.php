<?php
session_start();
include("connexion.php");

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* =========================
   PROFIL UTILISATEUR
========================= */
$profileQuery = "
SELECT weight, height, allergies, goal
FROM USER_PROFILE
WHERE id_user = :id_user
";

$stmtP = oci_parse($conn, $profileQuery);
oci_bind_by_name($stmtP, ":id_user", $user_id);
oci_execute($stmtP);
$profile = oci_fetch_array($stmtP, OCI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recommandation EmoEat</title>
    <link rel="stylesheet" href="/EmoEat/style.css?v=10">
</head>

<body>

<div class="container">

<h2>🍽 Recommandation intelligente</h2>

<form method="POST">

    <label>Choisir votre émotion :</label><br><br>

    <select name="emotion" required>
        <option value="21">Happy</option>
        <option value="2022">Sad</option>
        <option value="2023">Angry</option>
        <option value="2027">Stress</option>
        <option value="2028">Excited</option>
    </select>

    <br><br>
    <button type="submit" name="get_reco">Obtenir recommandation</button>

</form>

<hr>

<?php
/* =========================
   SI BOUTON CLIQUÉ
========================= */
if(isset($_POST['get_reco'])) {

    $emotion = $_POST['emotion'];

    $query = "
    SELECT f.food_name, f.calories, r.benefit, r.score
    FROM RECOMMENDATIONS r
    JOIN FOODS f ON f.id_food = r.id_food
    WHERE r.id_emotion = :emotion
    ORDER BY r.score DESC
    ";

    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ":emotion", $emotion);
    oci_execute($stmt);

    echo "<h3>🍽 Résultats personnalisés :</h3>";

    $found = false;

    while($row = oci_fetch_array($stmt, OCI_ASSOC)) {

        $found = true;

        $calories = $row['CALORIES'];
        $goal = strtolower($profile['GOAL'] ?? '');
        $allergies = strtolower($profile['ALLERGIES'] ?? '');
        $foodName = strtolower($row['FOOD_NAME']);

        /* FILTRAGE INTELLIGENT */
        $allow = true;

        // allergie
        if($allergies != '' && strpos($foodName, $allergies) !== false) {
            $allow = false;
        }

        // objectif perte de poids
        if($goal == 'lose weight' && $calories > 300) {
            $allow = false;
        }

        if($allow) {
            echo "<div class='food-card'>";
            echo "<h4>".$row['FOOD_NAME']."</h4>";
            echo "<p>".$row['BENEFIT']."</p>";
            echo "<p>🔥 ".$row['CALORIES']." calories</p>";
            echo "<p>⭐ Score ".$row['SCORE']."</p>";
            echo "</div>";
        }
    }

    if(!$found) {
        echo "<p style='color:red'>Aucune recommandation trouvée</p>";
    }
}
?>

<br>
<a href="dashboard.php">⬅ Retour Dashboard</a>

</div>

</body>
</html>