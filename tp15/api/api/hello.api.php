<?php
// API de type REST qui envoit une salutation à la personne 
//
header("Content-type:text/plain");
// 
$nom = $_GET['nom']?? 'titouan';
print("Hello  $nom !");
// 
?>