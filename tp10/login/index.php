<?php


 //recuperation de variable dans post
$login = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;
$submit = $_POST['submit'] ?? '';

//demarage de la session
session_start();

//insertion de login dans $_SESSION
$_SESSION['login'] = $login;
session_write_close();


switch($submit){

    case "login":
        if(isset($_SESSION['login']) && $_SESSION['login'] != '' && $login == "jak" & $password == "j") include("view/main.php");
        else include("view/login.html");
    case "new":
        include("view/not_implemented.html");
    default:
    // Envoit sur le login
    include("view/login.html");

}







?>
