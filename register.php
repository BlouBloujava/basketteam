<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $db = (new Database())->getConnection();
  $user = new User($db);

  $user->nom = $_POST['nom'];
  $user->prenom = $_POST['prenom'];
  $user->adresse = $_POST['adresse'];
  $user->email = $_POST['email'];
  $user->password = $_POST['password'];
  $user->numero_bancaire = $_POST['numero_bancaire'] ?? null;
  $user->date_expiration = $_POST['date_expiration'] ?? null;
  $user->code_cvv = $_POST['code_cvv'] ?? null;

  if ($user->register()) {
    // Connexion automatique après inscription
    $_SESSION['user_id'] = $user->getLastInsertId($db);
    $_SESSION['nom'] = $user->nom;
    $_SESSION['prenom'] = $user->prenom;
    header("Location: profil.php");
    exit;
  } else {
    $error = "Erreur lors de l'inscription.";
  }
}
?>

<form method="POST">
  <h2>Inscription</h2>
  <input type="text" name="nom" placeholder="Nom" required><br>
  <input type="text" name="prenom" placeholder="Prénom" required><br>
  <input type="text" name="adresse" placeholder="Adresse" required><br>
  <input type="email" name="email" placeholder="Email" required><br>
  <input type="password" name="password" placeholder="Mot de passe" required><br>
  <input type="text" name="coordonnees_bancaires" placeholder="Coordonnées bancaires (optionnel)"><br>
  <button type="submit">Créer mon compte</button>
  <?php if (isset($error)) echo "<p>$error</p>"; ?>
</form>
