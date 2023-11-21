<?php
// Controleur du début du jeu
// Etat : on connait le nom de la personne
// Objectif : on va lui demander si elle veut jouer
// Si c'est oui, on lui présente la regle du jeu,
// si non on termine.

// Inclut le mini framework
require_once('../framework/view.fw.php');
// Ce controleur a besoin du modèle
require_once('../model/jeu.class.php');

//////////////////////////////////////////////////////////////////////////////
// PARTIE RECUPERATION DES DONNEES
//////////////////////////////////////////////////////////////////////////////

/*
// Récupération des informations de la query string
if (isset($_GET['nom'])) {
  $nom = $_GET['nom'];
} else {
  $nom = '';
  // C'est une erreur : on doit toujours avoir un nom
  $error = 'start.ctrl.php : le nom a été perdu dans la query string';
}
*/

//recuperer le nom de la session :
var_dump($_SESSION);
if(isset($_SESSION['nom'])){
  $nom = $_SESSION['nom'];
}else {
  $nom = '';
  // C'est une erreur : on doit toujours avoir un nom
  $error = 'start.ctrl.php : le nom a été perdu dans la session';
}

$jouer = false;
if (isset($_GET['jouer'])) {
  if ($_GET['jouer'] == 'Oui') {
    $jouer = true;
  }
} else {
  // C'est une erreur : on doit toujours avoir une réponse
  $error = 'start.ctrl.php : pas de réponse dans la query string';
}

//////////////////////////////////////////////////////////////////////////////
// PARTIE USAGE DU MODELE
//////////////////////////////////////////////////////////////////////////////

// Ouvre la session
session_start();
// Récupère l'objet du Jeu dans la session
if (isset($_SESSION['jeu'])) {
  $jeu = $_SESSION['jeu'];
  // C'était le jeu précédent, on le réinitialise si la personne veux jouer
  if ($jouer) {
    $jeu->restart();
  }
} else {
  // C'est le début du jeu, on n'a pas encore d'objet dans la session
  // on crée l'objet
  $jeu = new Jeu();
}

if ($jouer) {
  // Sauvegarde l'objet dans la session
  $_SESSION['jeu'] = $jeu;
  // Ferme la session
  session_write_close();
} else {
  // C'est terminé on détruit la session
  session_destroy();
}

//////////////////////////////////////////////////////////////////////////////
// PARTIE SELECTION DE LA VUE
//////////////////////////////////////////////////////////////////////////////

// Création de l'objet vue
$view = new View();

// Choix de la vue en fonction de l'état des variables
// S'il y a une erreur
if (isset($error)) {
  // Passe le paramètre à la vue
  $view->assign('error',$error);
  // On affiche la vue
  $view->display('error.view.php');
}

// Le joueur veut jouer ?
if ($jouer) {
  // Passage des paramètres à la vue
  $view->assign('nom',$nom);
  // Est-ce la première fois ?
  if ($jeu->getNbGame() <= 1) {
    // On affiche la vue de l'affichage de la règle du jeu
    $view->display('regleDuJeu.view.php');
  } else {
    // On affiche le message de continuation avec le nombre de fois
    $view->assign('nbGame',$jeu->getNbGame());
    $view->display('rejouer.view.php');
  }
}

// Le joueur ne veut plus jouer
// La vue pour confimer qu'on ne joue plus
// Passage des paramètres à la vue
$view->assign('nom',$nom);
// On affiche la vue
$view->display('pasDeJeu.view.php');


?>
