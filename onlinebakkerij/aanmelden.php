<?php

require_once ("business/gebruikerservice.php");
require_once ("exceptions/EmailadresBestaatException.php");
if ($_GET["action"] == "process") {
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
    $error = $_GET["error"];
    include("presentation/gebruikeraanmelden.php");
}

