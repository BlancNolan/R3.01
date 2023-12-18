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
session_start();
if (isset($_GET['pattern'])) {
    // Le stocke dans la session
    $pattern = $_GET['pattern'];
    $_SESSION['pattern'] = $pattern;
} else {
    // Le récupère de la session, s'il existe
    $pattern = $_SESSION['pattern'] ?? '';
}
////////////////////////////////////////////////////////////////////////////
// Activation du modèle
////////////////////////////////////////////////////////////////////////////

$contacts = Contact::readFromLike($pattern);

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