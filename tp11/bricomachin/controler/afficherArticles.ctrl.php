<?php
// 

// Partie principale

// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");

// Inclusion du modèle
include_once(__DIR__."/../model/Article.class.php");
include_once(__DIR__."/../model/Categorie.class.php");

$page = $_GET["page"] ?? 1;
$idCategorie = $_GET['idCategorie'] ?? 0;


// Numero de page
$pagePrec = ($page == 1) ? 1 : $page-1;

$pageSuiv = ($page == ceil(Article::count()/12)) ? $page : $page+1;

// filtrage par catégorie
if($idCategorie == 0) {
  $nomCategorie = "Tous les produits";
}else{
    $categorie = Categorie::read($idCategorie);
    $nomCategorie = $categorie->getNom();
}
$articles = array();

if($nomCategorie == "Tous les produits") $articles = Article::readPage($page, 12);
else $articles = Article::readPageCategorie($page, 12, $categorie);


// 

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

// Passe les paramètres à la vue
$view->assign('nomCategorie',$nomCategorie);
$view->assign('articles',$articles);
$view->assign('idCategorie',$idCategorie);
$view->assign('page',$page);
$view->assign('pagePrec',$pagePrec);
$view->assign('pageSuiv',$pageSuiv);
// Charge la vue
$view->display("articles.view.php")
?>
