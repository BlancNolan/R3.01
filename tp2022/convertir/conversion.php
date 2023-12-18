<?php

$tInput = $_GET['tInput'] ?? '';

if($tInput == ''){
  $tOuput = 'X';
}else{
  $tOuput = (float)$tInput* pi() / 180.0;
}
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
    <form  action="conversion.php" method="get"> 
      <input id="tInput" type="number" step="any" name="tInput" value="<?= $tInput?>">
      <label for="tInput">Degré</label>
      égal
      <output id="tOutput" name="tOutput"><?= $tOuput?></output> radian 
      <button type="submit" name="action" value="convertir">Convertir</button>
    </form>
  </body>
</html>
