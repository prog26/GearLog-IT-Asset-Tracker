<?php

//la protection
session_start();

if(!isset($_SESSION["user"])){

header("Location: login.php");
exit();

}


require 'config/db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM assets WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: index.php?success=deleted");
    exit();
}

header("Location: index.php");
exit();