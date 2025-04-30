<?php
require_once 'classes/Database.php';
$db = (new Database())->getConnection();

$id = $_GET['id'] ?? 0;
$stmt = $db->prepare("SELECT * FROM produits WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
  echo "Produit introuvable.";
  exit;
}
?>

<h2><?= htmlspecialchars($produit['nom']) ?></h2>
<img src="images/<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom']) ?>" width="300">
<p><?= htmlspecialchars($produit['description']) ?></p>
<p><strong><?= $produit['prix'] ?> €</strong></p>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Nom de la page</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>
<form method="POST" action="acheter.php">
  <input type="hidden" name="id" value="<?= $produit['id'] ?>">
  <button type="submit">Acheter</button>
</form>
