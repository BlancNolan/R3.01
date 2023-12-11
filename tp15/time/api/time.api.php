<?php
require_once(__DIR__ . "/../model/time.class.php");

// Tableau qui contient la réponse 
$out = [];
// Examine l'action demandée
$action = $_GET['action'] ?? '';

switch ($action) {
    // Lecture de la date sachant la time zone
    case 'read':
        if(isset($_GET['timeZone'])){
            $timeZone = $_GET['timeZone'];
            try{
                $time = new Time($timeZone);
                $out = $time->jsonSerialize();
            }catch(Exception $e){
                $out['error'] = 'timeZone inéxistant';
            }
        }else{
            $out['error'] = 'timeZone missing for read';
        }
        break;
    default:
        $out['error'] = 'incorrect action';
}

// Change le status en cas d'erreur
// 
if(isset($out['error'])){
    http_response_code(400);
}

//  

// Sort la réponse
// Indique dans le header que l'on sort du JSON
header('Content-Type: application/json; charset=utf-8');
print(json_encode($out));
?>