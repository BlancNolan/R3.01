<?php
//   Ecrire votre PHP ici 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Conversion Degré/Radian</title>
    <link rel="stylesheet" href="design/style.css">
  </head>
  <body>
    <h1>Conversion Degré/Radian</h1>
    <form  action="conversion1.php" method="get"> 
      <input id="tInput" type="number" step="any" name="tInput" value="">
      <label for="tInput">Degré</label>
      égal
      <output id="tOutput" name="tOutput">X</output> radian 
      <button type="submit" name="action" value="convertir">Convertir</button>
    </form>
  </body>
</html>
