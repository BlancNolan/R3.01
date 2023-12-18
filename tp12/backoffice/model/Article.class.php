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
  const distantURL =  "http://www-info.iut2.upmf-grenoble.fr/intranet/enseignements/ProgWeb/data/bricomachin/img/";
  const localURL = "../data/img";

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
    
    if($this->image[0] =="/")
      return self::localURL.$this->image;
    else
      return self::distantURL.$this->image;
  }

  // Setter
  public function setLibelle($lib)  {
    $this->libelle = $lib; 
  }

  public function setCategorie($cat) {
    $this->categorie = $cat;
  }

  public function setPrix($prix) {
    $this->prix = $prix; 
  }

  public function setImage($image) {
    $this->image = $image;
  }

  // NB: on n'a pas le droit de changer la référence car cela devient un autre objet

  // 
  ///////////////////////////////////////////////////////
  //  A COMPLETER
  ///////////////////////////////////////////////////////
  // ////////////////////////////////////////////////////////////////////////////
  // Gestion de la persistance, Acces CRUD
  // CRUD = Create Read Update Delete
  //////////////////////////////////////////////////////////////////////////////

  // Retourne le nombre total d'articles dans la base
  // Est utilisé pour calculer le nombre de pages
  public static function count() : int {
    $dao = DAO::get();
    $table = $dao->query("SELECT count(*) FROM article");
    return $table[0][0]; 
  }



  /////////////////////////// CREATE /////////////////////////////////////


  // Création d'un nouvel article dans la base de données
  // Si le résultat de excec sur la base de donnée ne retourne pas 1
  // alors lève une exception pour signaler que l'insertion a échoué
  public function create() {
    $dao = DAO::get();
    $ref = $this->ref;
    $libelle = $this->libelle;
    $cat = $this->categorie->getId();
    $prix = $this->prix;
    $img = $this->image;

    $res = $dao->exec("INSERT INTO article values($ref, '$libelle', $cat, $prix, '$img')");
    if($res != 1)
      throw new Exception ("Erreur avec insert");
  }

  /////////////////////////// READ /////////////////////////////////////

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
      // Recupération de la catégorie qui doit être un objet
      $categorie = Categorie::read($row['categorie']);
      // Ajoute un article à la liste
      $articles[] = new Article($row['ref'],$row['libelle'],$categorie,$row['prix'],$row['image']);
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
      // Recupération de la catégorie qui doit être un objet
      $categorie = Categorie::read($row['categorie']);
      // Ajoute un article à la liste
      $articles[] = new Article($row['ref'],$row['libelle'],$categorie,$row['prix'],$row['image']);
    
    }

    return $articles;

  }

  /////////////////////////// UPDATE /////////////////////////////////////

  // Mise à jour d'un article
  public function update() {
    $dao = DAO::get();
    $ref = $this->ref;
    $libelle = $this->libelle;
    $cat = $this->categorie->getId();
    $prix = $this->prix;
    $img = $this->image;

    $res = $dao->exec("UPDATE article set (libelle, categorie, prix, image) =('$libelle', $cat, $prix, '$img')  where ref = $ref");
    if($res != 1)
      throw new Exception ("Erreur avec update");
  }

  /////////////////////////// DELETE /////////////////////////////////////

  // Suppression d'un article
  public function delete() {
    $dao = DAO::get();
    $ref = $this->ref;

    $res = $dao->exec("DELETE FROM article where ref = $ref");
    if($res != 1)
      throw new Exception ("Erreur avec delete");
  }



}
?>
