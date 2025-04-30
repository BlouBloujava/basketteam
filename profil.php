<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/User.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$db = (new Database())->getConnection();
$user = new User($db);
$user->id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $user->id);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Nom de la page</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>

<h2>Mon Profil</h2>
<p><strong>Nom :</strong> <?= htmlspecialchars($data['nom']) ?></p>
<p><strong>Prénom :</strong> <?= htmlspecialchars($data['prenom']) ?></p>
<p><strong>Adresse :</strong> <?= htmlspecialchars($data['adresse']) ?></p>
<p><strong>Email :</strong> <?= htmlspecialchars($data['email']) ?></p>
<p><strong>Email :</strong> <?= htmlspecialchars($data['numero_bancaire']) ?></p>
<p><strong>Email :</strong> <?= htmlspecialchars($data['date_expiration']) ?></p>
<p><strong>Email :</strong> <?= htmlspecialchars($data['code_cvv']) ?></p>

<p><strong>Coordonnées bancaires :</strong> <?= $data['numero_bancaire'] ? htmlspecialchars($data['numero_bancaire']) : 'Non renseigné' ?></p>
