<?php
// Besoin de la classe pour lancer les requêtes 
require_once(__DIR__ . "/../model/contact.class.php");

// Tableau qui contient la réponse
$out = [];
// Examine l'action demandée
$action = $_GET['action'] ?? '';

switch ($action) {
    // Lecture des contacts sachant le nom
    case 'read':
        // Il faut un nom
        $nom = $_GET['nom'] ?? '';
        if ($nom == '') {
            $out['error'] = "nom missing for read";
            break;
        }
        // Lance la demande
        try {
            $contacts = Contact::read($nom);
            // Passe tous les objets en résultat
            $out['contacts'] = $contacts;
            foreach($out['contacts'] as $contact){
                $contact = $contact->jsonSerialize();
            }
        } catch (Exception $e) {
            // Retourne le message d'erreur
            $out['error'] = $e->getMessage();
        }
        break;
    case 'readLike':
        // Il faut un nom
        $pattern = $_GET['pattern'] ?? '';
        if ($pattern == '') {
            $out['error'] = "pattern missing for readLike";
            break;
        }
        // Lance la demande
        try {
            $contacts = Contact::readLike($pattern);
            // Passe tous les objets en résultat
            $out['contacts'] = $contacts;
            foreach($out['contacts'] as $contact){
                $contact = $contact->jsonSerialize();
            }
        } catch (Exception $e) {
            // Retourne le message d'erreur
            $out['error'] = $e->getMessage();
        }
        break;
    default:
        $out['error'] = 'incorrect action';
}

if(isset($out['error'])){
    http_response_code(400);
}

// Sort la réponse
header('Content-Type: application/json; charset=utf-8');
print(json_encode($out));
?>