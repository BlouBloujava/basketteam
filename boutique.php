<?php
require_once 'classes/Database.php';
$db = (new Database())->getConnection();

$stmt = $db->query("SELECT * FROM produits");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Boutique</h2>
<div class="catalogue">
  <?php foreach ($produits as $produit): ?>
    <div class="produit">
      <img src="images/<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom']) ?>" width="200">
      <h3><?= htmlspecialchars($produit['nom']) ?></h3>
      <p><?= htmlspecialchars($produit['description']) ?></p>
      <p><strong><?= $produit['prix'] ?> €</strong></p>
      <a href="produit.php?id=<?= $produit['id'] ?>">Voir le produit</a>
    </div>
  <?php endforeach; ?>
</div>
