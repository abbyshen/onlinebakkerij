<?php
session_start();
require_once ("business/gebruikerservice.php");
$gebruikerSvc = new gebruikerservice();

$name = 0;
$gelukt = gebruikerservice::logincheck();
if ($gelukt == "loggedin") {
    $logged = "in";
    $emailadres = $_SESSION["emailadres"];
    $gebruiker1 = $gebruikerSvc->haalgebruikeropemailadres($emailadres);
    $naam = $gebruiker1->getNaam();
    $voornaam = $gebruiker1->getVoornaam();
    $telefoonnummer = $gebruiker1->getTelefoonnummer();
    $woonplaats = $gebruiker1->getWoonplaats();
    $postcode = $gebruiker1->getPostcode();
    $straat = $gebruiker1->getStraat();
    $nummer = $gebruiker1->getNummer();
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
    print_r($gebruiker1);
    print($emailadres);
    $gebruikerSvc->updateGebruiker($_POST["txtNaam"], $_POST["txtVoornaam"], $_POST["txtTelefoonnummer"], $emailadres,
                                    $_POST["txtWoonplaats"],$_POST["txtPostcode"],$_POST["txtStraat"],$_POST["txtNummer"]);
    print("wordt doorgestuurd");
    }
 else {
    if (!isset($_GET["error"])) {
        $error = null;
    } else
        $error = $_GET["error"];
    include("presentation/mijnprofielpresentation.php");
}

