<?php
// Partie CONTRÔLE de cette page WEB
// Placer ici la récupération des données de la query string et le calcul

// Récupération du sens, de l'action à réaliser et de la température en entrée
if (isset($_GET['sens'])){
  $sens = $_GET['sens'];
}else{
  $sens = 'C2F';
}

$action = $_GET['action'] ?? '';

if($sens === 'C2F'){
  $unit_in = 'Celsius';
  $unit_out = 'Fahrenheit';
}else{
  $unit_out = 'Celsius';
  $unit_in = 'Fahrenheit';
}


$temp_in = $_GET['temp_in'] ?? '';
if($temp_in != ''){

  if($action == 'convertir'){
    convertion($sens);
  }
  if($action == 'inverser'){
    convertion($sens);
    if($sens === 'C2F'){
      $sens = 'F2C';
      $unit_out = 'Celsius';
      $unit_in = 'Fahrenheit';
    }else{
      $sens = 'C2F';
      $unit_in = 'Celsius';
      $unit_out = 'Fahrenheit';
    }
    $permute = $temp_in;
    $temp_in = $temp_out;
    $temp_out = $permute;
  }

}else{
  $temp_out = 'X';
  if($action == 'inverser'){
    if($sens === 'C2F'){
      $sens = 'F2C';
      $unit_out = 'Celsius';
      $unit_in = 'Fahrenheit';
    }else{
      $sens = 'C2F';
      $unit_in = 'Celsius';
      $unit_out = 'Fahrenheit';
    }
  }
}





function convertion(string $sens){

  global $temp_out;
  global $temp_in;
  if($sens == 'C2F'){
    
    $temp_out = (1.8 *  $temp_in )+ 32.0;
  
  }else{

    $temp_out = ($temp_in - 32.0)/1.8;
    
  }
}


  // La suite est la partie VUE
  ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Conversion Celcius/Fahrenheit</title>
    <link rel="stylesheet" href="design/style.css">
  </head>
  <body>
    <h1>Conversion de températures</h1>
    <form  action="conversion2.php" method="get">
      <input type="hidden" name="sens" value="<?=$sens?>">
      <button type="submit" name="action" value="inverser">Inverser</button>
      <input id="in" type="number" step="any" name="temp_in" value="<?=$temp_in?>">
      <label for="in"><?=$unit_in?></label>
      égal
      <output id="out" for="in" name="temp_out"><?=$temp_out?></output>
      <label for="out"><?=$unit_out?></label>
      <button type="submit" name="action" value="convertir">Convertir</button>
    </form>
  </body>
  </html>
