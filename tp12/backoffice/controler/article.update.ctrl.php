<?php
// Controleur pour l'action sur les articles
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
// Inclusion du modèle
include_once(__DIR__."/../model/Article.class.php");


// 
//
///////////////////////////////////////////////////////////////////////////////
// Partie récupération des données
///////////////////////////////////////////////////////////////////////////////

$ref = $_GET['ref'];
$libelle = $_GET['libelle'] ?? '';
$prix = $_GET['prix'] ??0;


///////////////////////////////////////////////////////////////////////////////
// Partie calculs avec le modèle
///////////////////////////////////////////////////////////////////////////////

$error = array();
$imageURL = '';
//test pour afficher les erreurs :
if($libelle == ''){
    $error[] = "Le libelle doit être non vide !";
}
if($prix == 0){
    $error[] = "Le prix doit être non nul !";
}

// s'il n'y a pas d'erreur on fait le mise à jour
if(count($error) == 0){
    try{
        $article = Article::read($ref);
        //mise a jour du libelle et du prix
        $article->setLibelle($libelle);
        $article->setPrix($prix);
        //sauvegarde dans la base
        $article->update();
    }catch(Exception $e){
        $error[] = $e->getMessage();
    }
}

// Si finalement aucune erreur, on envois le message Ok
if (count($error)==0) {
    $message = "L'article a correctement été mise à jour dans la base";
} else {
    $message = '';
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
$view->assign('message',$message);
$view->display('article.update.view.php')

// 
?>
