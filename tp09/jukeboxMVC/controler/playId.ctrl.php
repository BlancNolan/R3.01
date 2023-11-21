<?php
// Joue une musique conneu par son Id
// Inclusion des modèles .. à copmleter
require_once('../model/music.class.php');
require_once('../model/musicDAO.class.php');
require_once('../framework/view.class.php');

// récupération des valeurs de la query string
// ID de la chanson .. à completer 
$id = $_GET['id'] ?? '';
$page = $_GET['page'] ?? '';
$pageSize = $_GET['pageSize'] ?? '';

// Si la page n'est pas indiquée, on repart à 1
// à completer 
if($page == null || $page == '') $page = 1;


// Si le nombre de musique par page n'est pas indiqué, on choisit 8
// à completer 
if($pageSize == null || $pageSize == '') $pageSize = 8;



// Creation de l'instance DAO
$jukebox = new MusicDAO();

// Récupération de l'objet musique correspondant à l'id
// à completer
$music = $jukebox->get($id);

///////// AJOUTE POUR MVC
$view = new View();

// Passage des paramètres à la vue: music, page et pagesize
// à completer
$view->assign('music', $music);
$view->assign('page', $page);
$view->assign('pageSize', $pageSize);


// Appel de la vue
// à completer
$view->display('playId.view.php');
?>
