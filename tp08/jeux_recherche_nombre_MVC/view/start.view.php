<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../view/design/style.css">
</head>
<body>
  <h1> Le Jeu du nombre </h1>
  <form action="start.ctrl.php">
    <p> Bonjour <?= $nom ?>,
      voulez-vous jouer au jeu du nombre ?
    </p>
    <input type="submit" name="jouer" value="Oui"/>
    <input type="submit" name="jouer" value="Non"/>
    
  </form>
</body>
</html>
