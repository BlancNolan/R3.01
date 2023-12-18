<?php
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
// Inclusion du modèle
include_once(__DIR__."/../model/contact.class.php");

// Les contacts à afficher
$contacts = [];
// Le pattern à récuperer de la session
$pattern = '';

////////////////////////////////////////////////////////////////////////////
// Récupération des données
////////////////////////////////////////////////////////////////////////////
$id = intval($_GET['id']) ?? -1;

session_start();
$pattern = $_SESSION['pattern'] ?? '';



////////////////////////////////////////////////////////////////////////////
// Activation du modèle
////////////////////////////////////////////////////////////////////////////
$contact = Contact::read($id);

if(isset($_GET['nom'])){
    $contact->setNom($_GET['nom']);
}
if(isset($_GET['prenom'])){
    $contact->setPrenom($_GET['prenom']);
}
if(isset($_GET['mobile'])){
    $contact->setMobile($_GET['mobile']);
}

// Mise à jours de l'objet
$contact->update();

// Recherche à nouveaux tous les contacts en fonction du pattern
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
