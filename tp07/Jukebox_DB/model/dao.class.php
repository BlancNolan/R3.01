<?php
require_once(__DIR__.'/music.class.php');

// Le Data Access Objet
class DAO {
  private $db;

  // Constructeur chargé d'ouvrir la BD
  function __construct() {
    $database = 'sqlite:'.__DIR__.'/../data/music.db';
    $this->db = new PDO($database);
    
  }

  // Accès à une musique
  function get(int $id) : Music {
    $pdoSth = $this->db->query("SELECT * FROM music where id='$id'");
    $data = $pdoSth->fetchall();
    if (count($data) != 1) {
      throw new Exception("id '$id' n'est pas unique");
    }
    return new music($data[0]['id'], $data[0]['author'],$data[0]['title'],$data[0]['cover'],$data[0]['mp3'],$data[0]['category']);
  }

  // Retourne l'idf minimum
  function minId() : int {
    $pdoSth = $this->db->query("SELECT min(id) as id FROM music");
    $data = $pdoSth->fetchall();
    if (count($data) != 1) {
      throw new Exception("id '$id' n'est pas unique");
    }
    return $data[0]['id'];
  }

  // Retourne l'idf maximum
  function maxId() : int {
    $pdoSth = $this->db->query("SELECT max(id) as id FROM music");
    $data = $pdoSth->fetchall();
    if (count($data) != 1) {
      throw new Exception("id '$id' n'est pas unique");
    }
    return $data[0]['id'];
  }
}

?>
