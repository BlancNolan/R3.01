<?php
// Controleur pour l'action sur les articles
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
// Inclusion du modèle
include_once(__DIR__."/../model/Article.class.php");
// Nom du répertoire ou stocker les images téléchargées
$imgPath = __DIR__."/../data/img/";

// 
//
///////////////////////////////////////////////////////////////////////////////
// Partie récupération des données
///////////////////////////////////////////////////////////////////////////////

$ref = $_GET['ref'];



///////////////////////////////////////////////////////////////////////////////
// Partie calculs avec le modèle
///////////////////////////////////////////////////////////////////////////////

$error = array();
$imageURL = '';
//test pour afficher les erreurs :
if($ref == 0){
    $error[] = "Le référence doit être non nul !";
}

// s'il n'y a pas d'erreur on fait le mise à jour
if(count($error) == 0){
    try{
        $article = Article::read($ref);
    }catch(Exception $e){
        $error[] = $e->getMessage();
    }
}



////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new view();
$view->assign('ref',$article->getRef());
$view->assign('libelle',$article->getLibelle());
$view->assign('categorie',$article->getCategorie()->getNom());
$view->assign('prix',$article->getPrix());
$view->assign('imageURL',$article->getImageURL());
$view->assign('error',$error);
$view->display('article.read.view.php')

// 
?>
