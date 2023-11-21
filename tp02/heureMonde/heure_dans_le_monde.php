<?php
header("refresh: 60");

$villes = array('America/Anchorage','America/Los_Angeles','America/Guadeloupe',
'Europe/Paris', 'Africa/Kigali',
'Asia/Singapore','Australia/Sydney','Pacific/Auckland');

function fuseaux():string {

  global $villes;
  $fuseaux ='';
  foreach($villes as $val){
    date_default_timezone_set($val);
    $fuseaux .= '<tr><th>'.$val.'</th><td>'.date("H:i d/m/Y\n").'</td></tr>';
  }

  return $fuseaux;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>L'heure dans le monde</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>L'heure dans le monde</h1>
  <table>
    <?= fuseaux()?>
  </table>
</body>
</html>
