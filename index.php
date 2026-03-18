<?php

//la protection
session_start();

if(!isset($_SESSION["user"])){

header("Location: login.php");
exit();

}




require 'config/db.php'; 

$search = $_GET['search'] ?? '';

// Total
$total = $pdo->query("SELECT SUM(price) FROM assets")->fetchColumn() ?: 0;

// Requête
$sql = "SELECT a.*, c.name as category_name 
        FROM assets a 
        LEFT JOIN categories c ON a.category_id = c.id";

if ($search) {
    $sql .= " WHERE a.device_name LIKE :s OR a.serial_number LIKE :s";
}

$stmt = $pdo->prepare($sql);
if ($search) $stmt->execute(['s' => "%$search%"]); else $stmt->execute();
$assets = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GearLog | Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="logout-bar">
     <a href="logout.php" class="btn btn-logout">Logout</a>
    </div>

<div class="container">

    <header class="main-header">
      <h1>GearLog Inventory</h1>
      <p class="total">Valeur du Stock : <strong><?= number_format($total, 2) ?> €</strong></p>
    </header>

    <div class="top-bar">
        <a href="create.php" class="btn btn-add">+ Ajouter</a>

        <form method="GET" class="search-box">
            <input type="text" name="search" placeholder="Rechercher..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-search">Go</button>
        </form>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Device</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($assets as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['serial_number']) ?></td>
                <td><?= htmlspecialchars($row['device_name']) ?></td>
                <td><?= htmlspecialchars($row['category_name'] ?? 'Inconnu') ?></td>
                <td><?= number_format($row['price'], 2) ?> €</td>
                <td>
                    <span class="status <?= strtolower(str_replace(' ', '-', $row['status'])) ?>">
                        <?= $row['status'] ?>
                    </span>
                </td>
                <td>
                    <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-edit">Update</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Supprimer ?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>


</body>
</html>