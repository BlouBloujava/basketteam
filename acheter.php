<?php
session_start();
require_once 'classes/Database.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
  $db = (new Database())->getConnection();
  $user_id = $_SESSION['user_id'];
  $produit_id = intval($_POST['id']);

  $stmt = $db->prepare("INSERT INTO commandes (user_id, produit_id) VALUES (:user_id, :produit_id)");
  $stmt->execute([
    ':user_id' => $user_id,
    ':produit_id' => $produit_id
  ]);

  echo "<p>Achat confirmé ! Merci pour votre commande.</p>";
} else {
  echo "<p>Erreur : produit non spécifié.</p>";
}
