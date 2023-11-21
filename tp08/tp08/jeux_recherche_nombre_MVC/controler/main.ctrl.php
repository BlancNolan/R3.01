<?php
// Controleur principal : celui qui est utilisé au démarrage
// Etat : on connait ou non le nom de la personne
// Objectif : si le nom est connu on passe au début du jeu (start)
// sinon on demande à la personne de se présenter.

// Inclus le mini framework
require_once(__DIR__.'/../framework/view.fw.php');

//////////////////////////////////////////////////////////////////////////////
// PARTIE RECUPERATION DES DONNEES
//////////////////////////////////////////////////////////////////////////////

// Récupération des informations de la query string
$nom = $_GET['nom'] ?? '';


//////////////////////////////////////////////////////////////////////////////
// PARTIE USAGE DU MODELE
//////////////////////////////////////////////////////////////////////////////

// Rien à faire

//////////////////////////////////////////////////////////////////////////////
// PARTIE SELECTION DE LA VUE
//////////////////////////////////////////////////////////////////////////////

// Création de la vue
$view = new View();

// Si l'on connait la personne on lui propose un jeu
// sinon, on lui demande de se présenter
if ($nom == '') {
  // On ne sait pas qui est la personne
  // on lui propose de se présenter
  // On charge la vue du formulaire
  // Il n'y a pas de données à cette vue qui est purement en HTLM
  $view->display('getName.view.html');
}
// Ouvre la session
session_start();
//on passe le nom dans la session
$_SESSION['nom']=$nom;


// On connait son nom,  on va lui proposer de jouer
// On passe les informations à la vue
$view->assign('nom',$nom);
// On affiche la vue
$view->display('start.view.php');

?>
