<?php

// Description d'une musique
class Music {
  private int $id;
  private string $author;
  private string $title;
  private string $cover;
  private string $mp3;
  private string $category;
  // Chemin URL à ajouter pour avoir l'URL du MP3 et du COVER
  private const URL = 'http://www-info.iut2.upmf-grenoble.fr/intranet/enseignements/ProgWeb/data/musiques/';

  function __construct(int $id,string $author,string $title,string $cover,string $mp3,string $category) {
      $this->id = $id;
      $this->author = $author;
      $this->title = $title;
      $this->cover = $cover;
      $this->mp3 = $mp3;
      $this->category = $category;
  }

  function getId() : int {
    return $this->id;
  }
  function getAuthor() : string {
    return $this->author;
  }
  function getTitle() : string {
    return $this->title;
  }
  function getCover() : string {
    return $this->cover;
  }
  function getMp3() : string {
    return $this->mp3;
  }
  function getCategory() : string {
    return $this->category;
  }




}

?>
