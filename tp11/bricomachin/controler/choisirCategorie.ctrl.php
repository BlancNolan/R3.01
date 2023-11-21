<?php

// Partie principale

// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");

// Inclusion du modèle
include_once(__DIR__."/../model/Article.class.php");
include_once(__DIR__."/../model/Categorie.class.php");

//creation array pour les categories
$idCategorie = $_GET['idCategorie'] ?? 1;
$categoriePere = Categorie::read($idCategorie);
$categories = $categoriePere->readSubCategorie();

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

//passage des parametres a la vue
$view->assign('categories',$categories);
$view->assign('categoriePere',$categoriePere);
// Charge la vue
$view->display("categorie.view.php")

?>
