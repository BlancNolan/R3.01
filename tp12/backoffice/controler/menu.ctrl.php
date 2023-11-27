<?php
// Choisit le bon formulaire en fonction de ce qui est choisi dans le menu
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
// Inclusion du modèle
include_once(__DIR__."/../model/Article.class.php");

// 
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////

$methode = key($_GET);
$viewType = $_GET[$methode]??"";

$view = new View();
$view->display("{$viewType}.view.php");


// 
?>
