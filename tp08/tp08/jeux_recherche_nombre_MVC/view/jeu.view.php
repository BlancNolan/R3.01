<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../view/design/style.css">
</head>
<body>
<h1> Le Jeux du nombre </h1>
<p> Je propose : <?= $guess ?>
</p>
<form action="jeu.ctrl.php">
<input type="submit" name="reponse" value="Trop grand"/>
<input type="submit" name="reponse" value="Trop petit"/>
<input type="submit" name="reponse" value="Trouvé"/>
</form>
</body>
</html>
