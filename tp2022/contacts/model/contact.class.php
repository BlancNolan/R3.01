<?php
require_once(__DIR__ . '/dao.class.php');

// Un contact 
class Contact implements JsonSerializable
{
  private int $id; // Identifiant unique. ATTENTION: à laisser gérer par la BD
  private string $nom; // Nom du contact
  private string $prenom; // Prénom du contact
  private int $mobile; // No de téléphone mobile

  // Constructeur
  public function __construct(string $nom = '', string $prenom = '', int $mobile = 0)
  {
    $this->id = -1; // Indique que cet objet n'est pas (encore) dans la BD
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->mobile = $mobile;
  }

  public function jsonSerialize(): mixed
  {
    return get_object_vars($this);
  }

  // Getters
  public function getId(): int
  { return $this->id; }

  public function getNom(): string
  { return $this->nom; }

  public function getPrenom(): string
  { return $this->prenom; }

  public function getMobile(): int
  { return $this->mobile; }


  // Setter
  // NB: on n'a pas le droit de changer l'id car sinon cela devient un autre contact ou la BD devient incohérente

  public function setNom(string $nom)
  {
    $this->nom = $nom;
  }

  public function setPrenom(string $prenom)
  {
    $this->prenom = $prenom;
  }

  public function setMobile(int $mobile)
  {
    $this->mobile = $mobile;
  }

  //////////////////////////////////////////////////////////////////////////////
  // Gestion de la persistance, Acces CRUD
  // CRUD = Create Read Update Delete
  //////////////////////////////////////////////////////////////////////////////


  /////////////////////////// CREATE /////////////////////////////////////


  // Création d'un nouveau contact dans la base de données
  // ATTENTION : il ne faut pas explicitement gérer les identifiants, 
  // mais laisser faire la BD 
  public function create() : void
  {
    // Cet objet ne doit pas être déjà dans la base donc son id doit être -1
    if ($this->id !== -1) {
      throw new Exception("Create impossible : déjà dans la base avec cet id=" . $this->id);
    }else{
      $query = "INSERT INTO contact (prenom,nom,mobile) VALUES (?,?,?)";
      $data = ["$this->prenom", "$this->nom", $this->mobile];
      $dao = DAO::get();
      $dao->exec($query, $data);
      $this->id = $dao->lastInsertId();
    }
  }

  /////////////////////////// READ /////////////////////////////////////


  // Acces à un Contact connaissant son id
  // Lève une exception si non trouvé
  public static function read(int $id): Contact
  {
    $query = "SELECT * from contact where id = ?";
    $data = [$id];
    $dao = DAO::get();
    
      $tab = $dao->query($query, $data);
      if (count($tab) == 0) {
        throw new Exception("Erreur:  contact $id non trouvée");
      }
      // Il ne peux pas y avoir plus d'une instance avec cet id
      if (count($tab) > 1) {
        throw new Exception("Incohérence:  contact $id existe en ".count($tab)." exemplaires");
      }
      $contact = $tab[0];
      $res = new Contact($contact['nom'], $contact['prenom'], $contact['mobile']);
      $res->id = $id;
      return $res;
  }

  // Recherche d'une liste de contacts dont le nom ou le prénom débute par $pattern
  public static function readFromLike(string $pattern): array
  {
    // Acces au DAO
    $dao = DAO::get();
    $query = "SELECT * FROM contact WHERE nom like ? or prenom like ?";
    $data = ["$pattern%", "$pattern%"];
    $table = $dao->query($query, $data);
    // Récupération des données dans un array
    $contacts = [];
    foreach ($table as $row) {
      $contact = new Contact($row['nom'], $row['prenom'], $row['mobile']);
      // Ajoute l'id, car il n'est pas dans le constructeur
      $contact->id = $row['id'];
      // Ajoute le nouvel objets à la liste
      $contacts[] = $contact;
    }
    return $contacts;
  }

  /////////////////////////// UPDATE /////////////////////////////////////

  // Mise à jour d'un contact
  // Important : le contact doit déjà être dans la base donc avoir un id différent de -1
  public function update(): void
  {
    if ($this->id === -1) {
      throw new Exception("Update impossible : ce contact n'est pas dans la base");
    }else{
      $query = "UPDATE contact set(nom, prenom, mobile) = (?,?,?) where id = ?";
      $data = ["$this->nom", "$this->prenom", $this->mobile, $this->id];
      $dao = DAO::get()->exec($query, $data);
    }
  }

  /////////////////////////// DELETE /////////////////////////////////////

  // Suppression d'un article
  public function delete(): void
  {
    if ($this->id === -1) {
      throw new Exception("Delete impossible : ce contact n'est pas dans la base");
    }else {
      $query = "DELETE from contact where id = ?";
      $data = [$this->id];
      $dao = DAO::get()->exec($query, $data);
      $this->id = -1;
    }
  }
}
?>