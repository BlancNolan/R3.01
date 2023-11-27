<?php
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");

// 
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////
//creation de variable login password et connected
$login = $_POST["login"]??null;
$password = $_POST["password"]??null;
$connected = false;

//ouverture de la session
session_start();

//insertion de login dans $_SESSION
$_SESSION['login'] = $login;
session_write_close();

if(isset($_SESSION['login']) && $_SESSION['login'] != '' && $login == "invite" & $password == "invite") $connected = true;


////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();


if ($connected) {
  $view->display("connected.view.php");
} else {
  $view->display("main.view.php");
}
// Charge la vue
?>
