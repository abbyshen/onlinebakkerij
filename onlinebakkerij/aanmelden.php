<?php

require_once ("business/gebruikerservice.php");
$gebruikersvc = new gebruikerservice;
require_once ("exceptions/EmailadresBestaatException.php");
if (!isset($_GET["action"])){
    $action = null;
}else
$action=$_GET["action"];
if ($action == "process") {
    try {
        $gebruikersvc->voegNieuwGebruikerToe($_POST["txtNaam"], $_POST["txtVoornaam"]
                , $_POST["txtTelefoonnummer"], $_POST["txtEmailadres"], $_POST["txtWoonplaats"]
                , $_POST["txtPostcode"], $_POST["txtStraat"], $_POST["txtNummer"]);
        header("location:home.php");
        exit(0);
    } catch (EmailadresBestaatException $ebe) {
        header("location:aanmelden.php?error=emailexists");
        exit(0);
    } catch (mailmisluktException $mme) {
        header("location:aanmelden.php?error=fail2mail");
        exit(0);
    }
} else {
    if(!isset($_GET["error"])){
        $error = null;
    }else
    $error = $_GET["error"];
    include("presentation/gebruikeraanmelden.php");
}

