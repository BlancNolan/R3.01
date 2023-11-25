<?php

require_once(__DIR__."/Categorie.class.php");
require_once(__DIR__."/Article.class.php");

// Le Data Access Object 
// Il représente la base de donnée
class DAO {
  // le singleton de la classe : l'unique objet
  private static $instance = null;

  // L'objet local PDO de la base de donnée
  private PDO $db;

  // Le type, le chemin et le nom de la base de donnée
  private string $database = 'sqlite:'.__DIR__.'/../data/backoffice.db';

  // Constructeur chargé d'ouvrir la BD
  private function __construct() {
    try {
      $this->db = new PDO($this->database);
      //var_dump($this);
      if (!$this->db) {
        throw new Exception("Impossible d'ouvrir ".$this->database);
        ("Database error");
      }
      // Positionne PDO pour lancer les erreurs sous forme d'exeptions
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      throw new Exception("Erreur PDO : ".$e->getMessage().' sur '.$this->database);
    }

  }

  // Méthode statique pour acceder au singleton
  public static function get() : DAO {
    // Si l'objet n'a pas encore été crée, le crée
    if(is_null(self::$instance)) {
      self::$instance = new DAO();
    }
    return self::$instance;
  }


  // Lance une requête sur la BD, et retourne une table
  public function query(string $query) : array {
    try {
      $r = $this->db->query($query);
    } catch (Exception $e) {
      throw new PDOException(implode('|',$this->db->errorInfo())." Query: ".$query);
    }

    // Affiche en clair l'erreur PDO si la requête ne peut pas s'exécuter
    if ($r === false) {
      throw new PDOException(implode('|',$this->db->errorInfo())." Query: ".$query);
    }
    $table = $r->fetchAll();
    return $table;
  }

  // Exécute une requête sur la BD, et retourne le nombre de lignes modifiées
  public function exec(string $query) : int {
    try {
      $r = $this->db->exec($query);
    } catch (Exception $e) {
      throw new PDOException(implode('|',$this->db->errorInfo())." Exec: ".$query);
    }

    // Affiche en clair l'erreur PDO si la requête ne peut pas s'exécuter
    if ($r === false) {
      throw new PDOException(implode('|',$this->db->errorInfo())." Exec: ".$query);
    }
    return $r;
  }

}

?>
