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

$ref = (int)$_GET['ref']??null;

// demarrage de la session et verification de la connexion
session_start();
$connected = (isset($_SESSION['login']) && $_SESSION['login'] == 'invite');

$view = new View();

if (!$connected){
    $view->display("login.view.php");
}else{

    switch ($methode) {
        case 'article':
            if ($viewType == "create" || $viewType == "read"){
                $viewType = "article.".$viewType;
                $view->assign('ref', $ref);
                $view->assign('libelle', null);
                $view->assign('categorie', null);
                $view->assign('prix', 0);
                $view->assign('image', null);
            }else{
                if(is_numeric($ref) && $ref > 0){
                    $article = Article::read($ref);
                    if($article == null && $viewType == "update"|| $viewType == "delete")
                        $viewType = "main";
                    else{
                        $viewType = "article.".$viewType;
                        $view->assign('ref', $article->getRef());
                        $view->assign('libelle', $article->getLibelle());
                        $view->assign('categorie', $article->getCategorie()->getNom());
                        $view->assign('prix', $article->getPrix());
                        $view->assign('image', $article->getImageURL());
                    }
                }else{
                    $viewType = "main";
                }
            }
            break;
        case 'access':
            if ($viewType == "login")
                $viewType = "connected";
            else{
                session_destroy();
            }
            break;
        default:
            $viewType = "login";
            break;
    }


    $view->display("{$viewType}.view.php");
}



// 
?>
