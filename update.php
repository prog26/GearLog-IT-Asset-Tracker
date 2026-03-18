<?php

//la protection
session_start();

if(!isset($_SESSION["user"])){

header("Location: login.php");
exit();

}



require 'config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) header("Location: index.php");

// Récupération
$stmt = $pdo->prepare("SELECT * FROM assets WHERE id = ?");
$stmt->execute([$id]);
$asset = $stmt->fetch();

if (!$asset) {
    echo "Appareil introuvable";
    exit();
}

// Catégories
$categories = $pdo->query("SELECT * FROM categories ORDER BY name ASC")->fetchAll();

// Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $up = $pdo->prepare("UPDATE assets SET serial_number=?, device_name=?, price=?, status=?, category_id=? WHERE id=?");
    $up->execute([
        $_POST['sn'],
        $_POST['name'],
        $_POST['price'],
        $_POST['status'],
        $_POST['cat'],
        $id
    ]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier - GearLog</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">

    <div class="form-card">
        <h2>Modifier l'appareil</h2>

        <form method="POST">

            <div class="form-group">
                <label>Numéro de Série</label>
                <input type="text" name="sn"
                    value="<?= htmlspecialchars($asset['serial_number']) ?>" required>
            </div>

            <div class="form-group">
                <label>Nom de l'appareil</label>
                <input type="text" name="name"
                    value="<?= htmlspecialchars($asset['device_name']) ?>" required>
            </div>

            <div class="form-group">
                <label>Prix (€)</label>
                <input type="number" step="0.01" name="price"
                    value="<?= htmlspecialchars($asset['price']) ?>" required>
            </div>

            <div class="form-group">
                <label>Catégorie</label>
                <select name="cat" required>
                    <?php foreach($categories as $c): ?>
                        <option value="<?= $c['id'] ?>"
                            <?= ($c['id'] == $asset['category_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Statut</label>
                <select name="status">
                    <option value="Available" <?= $asset['status'] == 'Available' ? 'selected' : '' ?>>Available</option>
                    <option value="Deployed" <?= $asset['status'] == 'Deployed' ? 'selected' : '' ?>>Deployed</option>
                    <option value="Under Repair" <?= $asset['status'] == 'Under Repair' ? 'selected' : '' ?>>Under Repair</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-save">Mettre à jour</button>
                <a href="index.php" class="btn btn-cancel">Retour</a>
            </div>

        </form>

    </div>

</div>

</body>
</html>