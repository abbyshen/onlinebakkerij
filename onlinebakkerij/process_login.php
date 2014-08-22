<?php
include_once ("data/DBconfig.php");
include_once ("business/gebruikerservice.php");
$gebruikersvc = new gebruikerservice();
 
$gebruikersvc->sec_session_start(); // Our custom secure way of starting a PHP session.
 
if (isset($_GET["action"],$_POST['email'], $_POST['p']) and $_GET["action"] == "inloggen") {
    $emailadres = $_POST['email'];
    $wachtwoord = $_POST['p']; // The hashed password.
 
    if ($gebruikersvc->loggebruikerin($emailadres, $wachtwoord) == true) {
        // Login success 
        header('toonalleproducten.php');
    } else {
        // Login failed 
        header('toonallesoorten.php');
    }
} else {
    // The correct POST variables were not sent to this page. 
    include("presentation/gebruikerinloggen.php");
    echo 'Invalid Request';
}