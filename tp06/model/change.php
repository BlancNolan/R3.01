<?php
include (dirname(__FILE__).'/../helper/readCSV.php');

// Classe chargée de réaliser un change entre deux monnaies
Class Change {
  // Liste des taux indexés par deux IDF de taux séparé par un espace
  private array $rates = array();
  // Liste des IDF des devises
  // Est utile pour afficher les devises que l'on peut choisir
  private array $devises = array();

  // Constructeur
  function __construct(string $filename) {
    // Lecture des taux
    $this->load($filename);
  }

  // Charge la liste des Taux et des idf de devises
  private function load(string $filename) {
    $tab = array();
    $tab = readCSV($filename);

    $lenght = count($tab);
    $i = 0;
    $indexDev = 0;
    while($i < $lenght){
      $this->rates[$tab[$i][0].' '.$tab[$i][1]] = $tab[$i][2];
      $devises[$indexDev] = $tab[$i][0];
      $devises[++$indexDev] = $tab[$i][1];
      $i++;
      $indexDev++;
    }
    $this->devises = array_unique($devises);


  }

  // Calcul du taux entre deux IDF de devises
  function getRate(string $from,string $to) : float {

    if($from == $to) return 1;

    if(isset($this->rates[$from.' '.$to])){
      return $this->rates[$from.' '.$to];
    }else if (isset($this->rates[$to.' '.$from])){
      return 1/($this->rates[$to.' '.$from]);
    }else{
      throw new ErrorException("ERREUR : taux de EUR vers ".$to." inconnu");
    }

  }

  // Retourne toutes les devises disponibles dans un tableau de strings
  function getDevises() : array {
    return $this->devises;
  }

  // Calcul une conversion
  // Arrondit à 2 après la virgule
  function change(string $from, string $to,float $amount) : float {

    return $this->getRate($from, $to)*$amount;
  }
}

?>
