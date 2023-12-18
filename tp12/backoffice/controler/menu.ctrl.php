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


// Verification de la connection
session_start();
if (! isset($_SESSION['connected']) || $_SESSION['connected'] == false) {
  // On n'est pas connecté
  $view = new View();
  $view->display("login.view.php");
  exit(0);
}

if (isset($_GET['article'])) {
    $context = 'article';
    $action  = $_GET['article'];
  } elseif (isset($_GET['access'])) {
    $context = 'access';
    $action  = $_GET['access'];
  } else {
    $context = '';
    $action = '';
  }

$ref = $_GET['ref']?? 0;
var_dump($ref);
// Vérifie que la référence est un nombre
if (is_numeric($ref)) {
    $ref = intval($ref);
  } else {
    // TODO : gérer cette erreur plus explicitement
    $ref = 0;
  }


///////////////////////////////////////////////////////////////////////////////
// Partie calculs avec le modèle
///////////////////////////////////////////////////////////////////////////////

// Erreurs potentielles
$error = array();

// Récupére l'article si sa référence est connue
if ($ref != '' && $ref != 0) {
  try {
    $article = Article::read($ref);
  } catch (Exception $e) {
    $error[] = $e->getMessage();
  }
}else {
  // Crée un article vide
  $article = new Article();
}

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

// Charge la vue en fonction de l'action
// On ne tiens pas compte du contexte dans cette version du controleur
// Les actions sont toutes différentes
switch ($action) {
    case 'create':
    // Initialise les paramètres de la vue
    $view->assign('ref',0);
    $view->assign('libelle','');
    $view->assign('prix',0);
    // la vue de création d'un nouvel article
    $view->display("article.create.view.php");
    break;
    case 'read':
    $view->assign('ref',0);
    $view->assign('libelle','');
    $view->assign('prix',0);
    $view->assign('categorie','');
    // La vue pour l'affichage d'un article
    $view->display("article.read.view.php");
    break;
    case 'update':
    $view->assign('ref',$article->getRef());
    $view->assign('libelle',$article->getLibelle());
    $view->assign('prix',$article->getPrix());
    $view->assign('categorie',$article->getCategorie()->getNom());
    $view->assign('imageURL',$article->getImageURL());
    // La vue pour la mise à jour d'un article
    $view->display("article.update.view.php");
    break;
    case 'delete':
    $view->assign('ref',$article->getRef());
    $view->assign('libelle',$article->getLibelle());
    $view->assign('prix',$article->getPrix());
    $view->assign('categorie',$article->getCategorie()->getNom());
    $view->assign('imageURL',$article->getImageURL());
    // La vue pour la mise à jour d'un article
    $view->display("article.delete.view.php");
    break;
    case 'login':
    // la vue pour le login
    $view->display("login.view.php");
    break;
    case 'logout':
    $_SESSION['connected'] = false;
    // la vue pour le logout
    $view->display("logout.view.php");
    break;
    default:
    // Si aucune action est connue, retourne à la vue principale
    $view->display("main.view.php");
    break;

}

// 
?>
