<?php
$mysqli = new mysqli("127.0.0.1", "root", "");

if ($mysqli->connect_error) {
    die("Échec de la connexion : " . $mysqli->connect_error);
}
echo "Connexion réussie !";
$mysqli->close();
