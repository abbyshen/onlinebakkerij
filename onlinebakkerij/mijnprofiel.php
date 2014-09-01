<?php

session_start();
require_once ("business/productservice.php");
require_once ("business/gebruikerservice.php");
require_once ("business/bestellingservice.php");
$productsvc = new productservice();
$alleproducten = $productsvc->getproductenOverzicht();
$gebruikerSvc = new gebruikerservice();
$bestellingsvc = new bestellingservice();
$name = 0;
$gelukt = gebruikerservice::logincheck();
if ($gelukt == "loggedin") {
    $logged = "in";
    $emailadres = $_SESSION["emailadres"];
    $gebruiker1 = $gebruikerSvc->haalgebruikeropemailadres($emailadres);
    $gebruikerid = $gebruiker1->getId();
    $naam = $gebruiker1->getNaam();
    $voornaam = $gebruiker1->getVoornaam();
    $telefoonnummer = $gebruiker1->getTelefoonnummer();
    $woonplaats = $gebruiker1->getWoonplaats();
    $postcode = $gebruiker1->getPostcode();
    $straat = $gebruiker1->getStraat();
    $nummer = $gebruiker1->getNummer();
    $bestellingen = $bestellingsvc->bestellingterug($gebruikerid);
    $maxbestellingen = count($bestellingen);
    $maxaantal = count($alleproducten);
    $i = 1;$j = 1;
} else {
    $logged = "out";
    $emailadres = "";
    header("location:process_login.php");
}

if (!isset($_GET["action"])) {
    $action = null;
} else
    $action = $_GET["action"];
if ($action == "updateprofiel") {
    $gebruikerSvc->updateGebruiker($_POST["txtNaam"], $_POST["txtVoornaam"], $_POST["txtTelefoonnummer"], $emailadres, $_POST["txtWoonplaats"], $_POST["txtPostcode"], $_POST["txtStraat"], $_POST["txtNummer"]);
    header("location:process_login.php");
}
if ($action == "updatewachtwoord") {
    $pass1 = sha1($_POST["nieuwwachtwoord1"]);
    $pass2 = sha1($_POST["nieuwwachtwoord2"]);
    $wachtwoord = sha1($_POST["oudwachtwoord"]);
    if ($pass1 == $pass2 and $pass1 == $wachtwoord) {
        header("location:mijnprofiel.php?error=foutinw8woord");
    }
    if ($pass1 != $pass2){header("location:mijnprofiel.php?error=foutinw8woord12");}
    if ($pass1 == $pass2 and $wachtwoord != $_SESSION["wachtwoord"]){header("location:mijnprofiel.php?error=foutinoudw");}
    else{
        $gebruikerSvc->updateWachtwoord($_SESSION["emailadres"], $pass1);
        header("location:logout.php");
    }
} else {
    if (!isset($_GET["error"])) {
        $error = null;
    } else
        $error = $_GET["error"];
    include("presentation/mijnprofielpresentation.php");
}

