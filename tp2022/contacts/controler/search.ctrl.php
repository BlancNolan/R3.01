<?php
// 
// Inclusion du framework
include_once(__DIR__ . "/../framework/view.class.php");
// Inclusion du modèle
include_once(__DIR__ . "/../model/contact.class.php");

// Liste des contacts à passer à la vue
$contacts = [];
// Modif à passer à la vue
$pattern = '';

////////////////////////////////////////////////////////////////////////////
// Récupération des données
////////////////////////////////////////////////////////////////////////////

// 
///////////////////////////////////////////////////////
//  A COMPLETER
///////////////////////////////////////////////////////
// 

////////////////////////////////////////////////////////////////////////////
// Activation du modèle
////////////////////////////////////////////////////////////////////////////


// 
///////////////////////////////////////////////////////
//  A COMPLETER
///////////////////////////////////////////////////////
// 

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

// Place les contacts dans la vue
$view->assign('contacts', $contacts);
// Conserve l'information du pattern
$view->assign('pattern', $pattern);
// Charge la vue
$view->display("main.view.php")
    ?>