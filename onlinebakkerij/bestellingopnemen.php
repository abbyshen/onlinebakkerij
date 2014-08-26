<?php
session_start();
require_once ("business/gebruikerservice.php");
require_once ("business/soortservice.php");
require_once ("business/productservice.php");
$soortsvc = new Soortenservice();
$soortenLijst = $soortsvc->getSoortenOverzicht();
$productSvc1 = new productservice();
foreach ($soortenLijst as $soort){
    $productenLijst = $productSvc1->getproductenpersoort($soort->getId());
}
require_once ("exceptions/EmailadresBestaatException.php");
if (!isset($_GET["action"])){
    $action = null;
}else
$action=$_GET["action"];
if ($action == "bestellingfase1") {
    try {
        Gebruikerservice::voegNieuwGebruikerToe($_POST["txtNaam"], $_POST["txtVoornaam"]
                , $_POST["txtTelefoonnummer"], $_POST["txtEmailadres"], $_POST["txtWoonplaats"]
                , $_POST["txtPostcode"], $_POST["txtStraat"], $_POST["txtNummer"]);
        header("location: toonalleproducten.php");
        exit(0);
    } catch (EmailadresBestaatException $ebe) {
        header("location: aanmelden.php?error=emailexists");
        exit(0);
    } catch (mailmisluktException $mme) {
        header("location: aanmelden.php?error=fail2mail");
        exit(0);
    }
} else {
    if(!isset($_GET["error"])){
        $error = null;
    }else
    $error = $_GET["error"];
    include("presentation/bestellingpresentation.php");
}
