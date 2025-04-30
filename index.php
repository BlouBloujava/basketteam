<?php
session_start();
$isConnected = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Équipe de Basket</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
  <header>
    <h1>Bienvenue sur le site de notre Équipe de Basket</h1>
    <nav>
      <a href="index.php">Accueil</a>
      <?php if (!$isConnected): ?>
        <a href="login.php">Connexion</a>
        <a href="register.php">Inscription</a>
      <?php else: ?>
        <a href="profil.php">Profil</a>
        <a href="logout.php">Déconnexion</a>
      <?php endif; ?>
    </nav>
  </header>

  <main>
    <section>
      <h2>Présentation de l'équipe</h2>
      <p>Nous sommes une équipe passionnée de basketball basée à Paris.</p>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Équipe de Basket. Tous droits réservés.</p>
  </footer>
</body>
</html>
