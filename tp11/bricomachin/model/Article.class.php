<?php
require_once(__DIR__.'/DAO.class.php');
require_once(__DIR__.'/Categorie.class.php');

// Un article en vente 
class Article {
  private int     $ref;         // Référence unique
  private string  $libelle;     // Nom de l'article
  private Categorie  $categorie; // La catégorie de cet attribut
  private float   $prix;        // Le prix
  private string  $image;       // Nom du fichier image
  // URL absolue pour les images
  private const URL = "https://www-info.iut2.univ-grenoble-alpes.fr/intranet/enseignements/ProgWeb/data/bricomachin/img/";

  // Constructeur
  public function __construct(int $ref=-1, string $libelle='',Categorie $categorie=NULL,
  float $prix=0.0, string  $image='') {
    $this->ref = $ref;
    $this->libelle = $libelle;
    // On ne peux pas affecter NULL à un attribut de type Categorie
    if ($categorie === NULL) {
      $this->categorie = new Categorie();
    } else {
      $this->categorie = $categorie;
    }
    $this->prix = $prix;
    $this->image = $image;
  }

  // Getters
  public function getRef() : int {
    return $this->ref;
    }

  public function getLibelle() : string {
    return $this->libelle;

  }

  public function getCategorie() : Categorie {
    return $this->categorie; 
  }

  public function getPrix() : float {
    return $this->prix;
  }

  public function getImage() : string {
    return $this->image; 
  }

  // Retourne l'URL complete de l'image pour une utilisation dans la vue.
  public function getImageURL() : string {
    return self::URL.$this->image; 
  }

  ////////////// Gestion de la persistance (méthodes CRUD) ////////////////

  // Retourne le nombre total d'articles dans la base
  // Est utilisé pour calculer le nombre de pages
  public static function count() : int {
    $dao = DAO::get();
    $table = $dao->query("SELECT count(*) FROM article");
    return $table[0][0];
  }

  ////////////// READ /////////////////////////////////////////////

  // Acces à un article connaissant sa référence
  // $ref : la référence de l'article
  public static function read(int $ref): Article {
    // Acces au DAO
    $dao = DAO::get();
    $table = $dao->query("SELECT * FROM article WHERE ref = $ref");
    // Il ne doit y avoir qu'un seul résultat dans la table
    if (count($table) == 0) {
      throw new Exception("Erreur:  article $ref non trouvée");
    }
    // Il ne peux pas y avoir plus d'une instance avec cet id
    if (count($table) > 1) {
      throw new Exception("Incohérence:  article $ref existe en ".count($table)." exemplaires");
    }
    // Les données de cette catégorie
    $row = $table[0];
    // Crée l'instance
    $article = new Article($row['ref'],$row['libelle'],Categorie::read($row['categorie']),$row['prix'],$row['image']);
    return $article;
  }

  // Récupère des articles étant donné un No de page
  // Les articles sont triés par No de référence
  // $page : le No de page qui débute à 1
  // $pageSize : le nombre de référence d'articles par pages
  public static function readPage(int $page,int $pageSize) : array {
    
    $dao = DAO::get();
    $offset = ($page-1) * $pageSize;
    $table = $dao->query("SELECT * FROM article order by ref LIMIT $offset, $pageSize");
    $articles = array();
    foreach($table as $article){
      $articles[] = Article::read($article['ref']);
    }

    return $articles;
  }

  // Récupère des articles étant donné un No de page et une catégorie
  // Les articles sont triés par No de référence
  // $page : le No de page qui débute à 1
  // $pageSize : le nombre de référence d'articles par pages
  // $categorie : la categorie qui sert de filtre
  public static function readPageCategorie(int $page,int $pageSize, Categorie $categorie) : array {
    
    $dao = DAO::get();
    $offset = ($page-1) * $pageSize;
    $id = $categorie->getId();
    $table = $dao->query("SELECT * FROM article WHERE categorie = $id order by ref LIMIT $offset, $pageSize");
    $articles = array();
    foreach($table as $article){
      $articles[] = Article::read($article['ref']);
    }

    return $articles;
  }
}
?>
