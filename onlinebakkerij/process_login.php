<?php
include_once ("data/DBconfig.php");
include_once ("business/gebruikerservice.php");
$gebruikersvc = new gebruikerservice();

//$gebruikersvc->sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_GET["action"], $_POST['email'], $_POST['p']) and $_GET["action"] == "inloggen") {
    $emailadres = $_POST['email'];
    $wachtwoord = $_POST['p']; // The hashed password.
    if ($gebruikersvc->loggebruikerin($emailadres, $wachtwoord) == true) {
        header("location:home.php");
    } else {
        // Login failed 
        header("location:process_login.php?error=loginfailed");
    }
} else {
    if(!isset($_GET["error"])){
        $error = null;
    }else
    $error = $_GET["error"];
    include("presentation/gebruikerinloggen.php");
}