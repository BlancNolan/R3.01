<?php
     
    function bonjour() { // variable locale à la fonction elle ne connais pas $nom du main
      if (isset($nom)) {
        echo "Bonjour $nom</br>";
      } else {
        echo "Mais qui êtes vous ?</br>";
      }
    }

    function hello() {
      global $nom;      //variable globale elle c'est donc celle du main
      if (isset($nom)) {
        echo "Hello $nom</br>";
      } else {
        echo "Mais qui êtes vous ?</br>";
      }
    }

    function salut() {
      static $nom;  //varible local qui possède une durée de vie plus importante que sa fonction
        if (isset($nom)) {
        echo "Salut $nom</br>";
        } else {
        echo "Mais qui êtes vous ?</br>";
        }
        $nom = "Cyprien";
    }

    bonjour();
    $nom="Arthur";
    bonjour();

    hello();
    $nom="Marcel";
    hello();

    salut();
    $nom="Mohamed";
    salut();
?>