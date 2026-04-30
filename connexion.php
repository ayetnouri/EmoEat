<?php
$conn = oci_connect("ESEN_STUDENT", "ayetnr7", "localhost:1521/XE");

if (!$conn) {
    $e = oci_error();
    echo "Erreur connexion Oracle";
} else {
    echo "Connexion Oracle réussie";
}
?>