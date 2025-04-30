<?php
session_start();
require_once 'classes/Database.php';
require_once 'classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $db = (new Database())->getConnection();
  $user = new User($db);

  $user->email = $_POST['email'];
  $user->password = $_POST['password'];

  if ($user->login()) {
    $_SESSION['user_id'] = $user->id;
    $_SESSION['nom'] = $user->nom;
    $_SESSION['prenom'] = $user->prenom;
    header("Location: index.php");
    exit;
  } else {
    $error = "Email ou mot de passe incorrect.";
  }
}
?>

<form method="POST">
  <h2>Connexion</h2>
  <input type="email" name="email" placeholder="Email" required><br>
  <input type="password" name="password" placeholder="Mot de passe" required><br>
  <button type="submit">Se connecter</button>
  <?php if (isset($error)) echo "<p>$error</p>"; ?>
</form>
