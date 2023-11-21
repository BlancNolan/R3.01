<?php
// Inclusion les modèles : music.class.php, musicDAO.class.php et view.class.php
// à completer 
require_once('../model/music.class.php');
require_once('../model/musicDAO.class.php');
require_once('../framework/view.class.php');


// Nombre de boutons de choix de page
$nbButtonPage = 8;

// Partie analyse des valeurs de la query string
// get "la page"... à completer
$page = $_GET['page'] ?? '';

// Nombre de musiques par page.. à completer
$pageSize = $_GET['pageSize'] ?? '';



// Creation de l'instace DAO .. à completer 
$jukebox = new musicDAO();


// Calcul de la dernière page .. à completer
$lastPage = ceil($jukebox->maxId()/$pageSize);

// Test si la page prévue est correcte .. à completer
if($page < 1 || $page > $lastPage) $page = 1;


// Calcul du premier id de la page .. à completer
$firstId = ($page-1)*$pageSize+1;


$list = array();

// Récupération des données à placer dans la vue à partir du modèle

for($i=$firstId; $i<$firstId+$pageSize && $i <= $jukebox->maxId();$i++){

  // Récupération de l'objet Music
  $music = $jukebox->get($i);
  // Ajout à la liste des images à afficher
  $list[] = $music;
}

////////////////////////////////
// Passage des données à la vue
///////////////////////////////

// Les positions pour les boutons
if ( $page > $nbButtonPage) {
  $prev = $page - $nbButtonPage;
} else {
  $prev = 1;
}

if ($page + $nbButtonPage <= $lastPage) {
  $next = $page + $nbButtonPage;
} else {
  $next = $page;
}

///////// AJOUTE POUR MVC
$view = new View();

// Passage des paramètres à la vue
$view->assign('page', $page);
$view->assign('pageSize', $pageSize);
$view->assign('lastPage', $lastPage);
$view->assign('prev', $prev);
$view->assign('next', $next);
$view->assign('list', $list);
$view->assign('nbButtonPage', $nbButtonPage);


// Appel de la vue
$view->display('jukebox.view.php');

?>
