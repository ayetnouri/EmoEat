<?php
session_start();
include("connexion.php");

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* =========================
   HISTORIQUE RECOMMANDATIONS
========================= */

$query = "
SELECT 
    f.food_name,
    r.benefit,
    r.score,
    r.recommendation_date,
    e.emotion_name
FROM RECOMMENDATIONS r
JOIN FOODS f ON f.id_food = r.id_food
JOIN EMOTIONS e ON e.id_emotion = r.id_emotion
WHERE r.id_user = :id_user
ORDER BY r.recommendation_date DESC
";

$stmt = oci_parse($conn, $query);
oci_bind_by_name($stmt, ":id_user", $user_id);
oci_execute($stmt);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Historique - EmoEat</title>
    <link rel="stylesheet" href="/EmoEat/style.css?v=10">
</head>

<body>

<div class="container">

<h2>📊 Historique des recommandations</h2>
<hr>

<?php
$found = false;

while($row = oci_fetch_array($stmt, OCI_ASSOC))
{
    $found = true;

    echo "<div class='card'>";
    echo "<h3>".$row['FOOD_NAME']."</h3>";
    echo "<p>💡 ".$row['BENEFIT']."</p>";
    echo "<p>😊 Emotion : ".$row['EMOTION_NAME']."</p>";
    echo "<p>⭐ Score : ".$row['SCORE']."</p>";
    echo "<p>📅 Date : ".$row['RECOMMENDATION_DATE']."</p>";
    echo "</div>";
}

if(!$found)
{
    echo "<p>Aucune recommandation trouvée.</p>";
}
?>

<br>
<a href="dashboard.php">⬅ Retour Dashboard</a>

</div>
</body>
</html>