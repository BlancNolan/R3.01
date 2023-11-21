<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../view/design/style.css">
</head>
<body>
  <h1> Le Jeu du nombre : une erreur interne est survenue</h1>
  <p> <?= $error ?> </p>
  <form action="main.ctrl.php">
    <input type="hidden" name="nom" value="<?= $nom ?>"/>
    <input type="submit" value="Recommencer" />
  </form>
</body>
</html>
