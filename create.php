<?php

//la protection
session_start();

if(!isset($_SESSION["user"])){

header("Location: login.php");
exit();

}


require 'config/db.php';

$categories = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO assets (serial_number, device_name, price, status, category_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['sn'], $_POST['name'], $_POST['price'], $_POST['status'], $_POST['cat']]);
    header("Location: index.php");
    exit();
}




?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter - GearLog</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">

    <div class="form-card">
        <h2>Ajouter un nouvel appareil</h2>

        <form method="POST" class="form">

            <div class="form-group">
                <label>Numéro de Série</label>
                <input type="text" name="sn" required>
            </div>

            <div class="form-group">
                <label>Nom de l'appareil</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Prix (€)</label>
                <input type="number" step="0.01" name="price" required>
            </div>

            <div class="form-group">
                <label>Catégorie</label>
                <select name="cat" required>
                    <option value="">-- Sélectionnez une catégorie --</option>
                    <?php foreach($categories as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Statut</label>
                <select name="status">
                    <option value="Available">Available</option>
                    <option value="Deployed">Deployed</option>
                    <option value="Under Repair">Under Repair</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-save">Enregistrer</button>
                <a href="index.php" class="btn btn-cancel">Annuler</a>
            </div>

        </form>
    </div>

</div>

</body>
</html>