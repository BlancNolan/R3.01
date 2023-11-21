<?php

//
function readCSV(string $filename,string $delimiter=',') : array {
  $res = array();

  $handle = fopen(dirname(__FILE__)."/".$filename, "r");
  $string = fgets($handle);
  rtrim($string);
  $string = fgets($handle);
  rtrim($string);
  
  for($i=0; !feof($handle); $i++){
    $res[$i] = explode($delimiter, $string);
    $string = fgets($handle);
    rtrim($string);
  }

  return $res;
}

 ?>
