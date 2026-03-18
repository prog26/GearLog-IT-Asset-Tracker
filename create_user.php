<?php

require "config/db.php";

$username = "admin";
$password = "admin123";

/* HASH du mot de passe */
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

$stmt->execute([$username, $hashedPassword]);

echo "Utilisateur admin créé";

?>