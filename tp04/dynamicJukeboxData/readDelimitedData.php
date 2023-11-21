<?php

// Analyse le fichier de nom $filename
// Ce fichier contient des informations séparées par $delimiter
// Le résultat est un tableau de tableau.
// Chaque element du premier tableau est produit à partir d'une ligne.
// Chaque ligne est découpée et placée dans un tableau.
// Par exemple : le fichier
//   Dads|Groin Twerk
//   The Black Eyed Peas|I Gotta Feeling
// Produit le tableau :
// array(2) {
//  [0]=> array(2) {
//      [0]=> string(4) "Dads"
//      [1]=> string(11) "Groin Twerk"
//      }
//  [1]=> array(2) {
//      [0]=> string(19) "The Black Eyed Peas"
//      [1]=> string(15) "I Gotta Feeling"
//      }
// }
function readDelimitedData(string $filename, string $delimiter='|') : array {
  // Initialise le tableau des résultats
  $tab = array();

  $handle = fopen($filename, "r");
  $string = fgets($handle);
  rtrim($string);
  
  for($i=0; !feof($handle); $i++){
    $tab[$i] = explode($delimiter, $string);
    $string = fgets($handle);
    rtrim($string);
  }

  // Retourne le tableau
  return $tab;
}


 ?>
