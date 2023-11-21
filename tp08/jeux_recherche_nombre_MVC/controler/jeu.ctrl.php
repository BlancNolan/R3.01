<?php
// Controleur du jeu
// Etat : on connait le nom de la personne
// Si un objet de la classe Jeu est présent dans la session, il
// représente l'état actuel du jeu, sinon cela signifie que le
// jeu vient juste de débuter.

// Inclut le mini framework
require_once(__DIR__.'/../framework/view.fw.php');
// Ce controleur a besoin du modèle
require_once(__DIR__.'/../model/jeu.class.php');

//////////////////////////////////////////////////////////////////////////////
// PARTIE RECUPERATION DES DONNEES
//////////////////////////////////////////////////////////////////////////////

// Récupération des informations de la query string

// Le nom de l'utilisateur
/*
if (isset($_GET['nom'])) {
  $nom = $_GET['nom'];
} else {
  // C'est une erreur : on doit toujours avoir un nom
  $error = 'jeu.ctrl.php : le nom a été perdu dans la query string';
}*/

//recuperer le nom de la session :
if(isset($_SESSION['nom'])){
  $nom = $_SESSION['nom'];
}else {
  $nom = '';
  // C'est une erreur : on doit toujours avoir un nom
  $error = 'jeu.ctrl.php : le nom a été perdu dans la session';
}

// La réponse, si l'on est en cours de jeu
// Si c'est le premier tour du jeu : on n'a pas encore de réponse de l'utilisateur
$reponse = $_GET['reponse'] ?? '';

// Ouvre la session
session_start();

// Récupère l'objet du Jeu dans la session
// Si c'est le début du jeu, on n'a pas encore d'objet dans la session, on crée l'objet
$jeu = $_SESSION['jeu'] ?? new Jeu();

//////////////////////////////////////////////////////////////////////////////
// PARTIE USAGE DU MODELE
//////////////////////////////////////////////////////////////////////////////

// Booléen pour indiquer la fin du jeu
$finDuJeu = false;

// Booléen pour indiqué que le joueur a triché
$triche = false;

// Examen de la réponse de l'utilisateur
if ($reponse == 'Trouvé') {
  // L'utilisateur nous dit que la valeur est trouvée
  // Rappel la valeur devinée
  $guess = $jeu->getGuess();
  // C'est la fin du jeu
  $finDuJeu = true;
} else {
  // S'il n'y a plus d'autre choix c'est que l'utilisateur a triché
  if ($jeu->noChoice()) {
    // C'est une triche
    $triche = true;
  } else {
    // Autres cas ou l'on poursuit le jeu
    if ($reponse == 'Trop grand') {
      // L'utilisateur nous dit que la valeur est trop grande
      // Informe le modèle du choix de l'utilisateur
      $jeu->guessTooHigh();
      // Demande au modèle de refaire une estimation
      $guess = $jeu->guess();
    } elseif ($reponse == 'Trop petit') {
      // L'utilisateur nous dit que la valeur est trop petite
      // Informe le modèle du choix de l'utilisateur
      $jeu->guessTooLow();
      // Demande au modèle de refaire une estimation
      $guess = $jeu->guess();
    } else {
      // C'est le premier pas du jeu, la première estimation
      $guess = $jeu->guess();
    }
  }
}

// Sauvegarde l'objet dans la session
$_SESSION['jeu'] = $jeu;
// Ferme la session
session_write_close();

//////////////////////////////////////////////////////////////////////////////
// PARTIE GESTION DE LA VUE
//////////////////////////////////////////////////////////////////////////////

// Création de la vue
$view = new View();

// S'il y a une erreur
if (isset($error)) {
  // Passe le paramètre à la vue
  $view->assign('error',$error);
  // On affiche la vue
  $view->display('error.view.php');
}
if ($finDuJeu) {
  // Fin du jeu
  // On passe les informations à la vue
  $view->assign('solution',$guess);
  $view->assign('nom',$nom);
  $view->assign('nombreDeCoup',$jeu->getNbGuess());
  // On affiche la vue
  $view->display('finDuJeu.view.php');
}
if ($triche) {
  // Un cas de triche
  // On passe les informations à la vue
  $view->assign('nom',$nom);
  // On charge la vue
  $view->display('triche.view.php');
} else {
  // Suite du jeu
  // On passe les informations à la vue
  $view->assign('nom',$nom);
  $view->assign('guess',$guess);
  // On charge la vue
  $view->display('jeu.view.php');
}


?>
