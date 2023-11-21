<?php
$nom = $_GET['name'] ?? '';
$password = $_GET['password'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <h1>Sur le site</h1>
    <p>
      <!-- A COMPLETER -->
      <p>salut <?= $nom?> !</p>
      <p>longueur mdp <?= strlen($password)?></p>

    </p>
  </body>
</html>
