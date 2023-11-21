<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../view/design/style.css">
</head>
<body>
  <h1> On va rejouer ! </h1>
  <p> Mon cher <?=$nom?> vous jouez pour la <?=$nbGame?>ème fois.
  <p>Bravo ! Vous aimez cela ! </p>
  <p>
    C'est parti à nouveau <?= $nom ?> ?
  </p>
  <form action="jeu.ctrl.php">
    <button type="submit" name="jouer" value="Oui">Oui !</button>
    <button type="submit" name="jouer" value="Nom" formaction="start.ctrl.php">Non ...</button>
  </form>
</body>
</html>
