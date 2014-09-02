<?php

session_start();
require_once ("business/bestellingservice.php");
require_once ("business/gebruikerservice.php");
require_once ("business/soortservice.php");
require_once ("business/productservice.php");
require_once ("exceptions/EmailadresBestaatException.php");
$soortsvc = new Soortenservice();
$soortenLijst = $soortsvc->getSoortenOverzicht();
$productenSvc1 = new productservice();
$alleproducten = $productenSvc1->getproductenOverzicht();
$bestellingsvc = new bestellingservice();
$maxaantal = count($alleproducten);
$lijst = array();
$productLijst = array();
$aantalarray = array();
$i = 1;
$ingevuldeproducten = 0;
if (!isset($_GET["action"])) {
    $action = null;
} else
    $action = $_GET["action"];
if ($action == "bestellingfase1") {
    while ($i <= $maxaantal) {
        $aantal = $_POST["aantal$i"];
        if ($aantal != 0) {
            $aantalarray[$i] = $aantal;
            $ingevuldeproducten++;
        } else {
            $aantalarray[$i] = null;
        }
        $i++;
    }
    $datum = $_POST["datum"];
    $i = 1;
    $_SESSION['datum'] = $datum;
    $_SESSION['aantalarray'] = $aantalarray;
    if ($ingevuldeproducten != 0) {
        include("presentation/bestellingsoverzicht.php");
    } else {
        header("location:bestellingopnemen.php?error=geenveldeningevult");
    }
} else {
    if ($action == "bestellingfase2") {
        $aantalarray = $_SESSION['aantalarray'];
        $datum = $_SESSION['datum'];
        $gebruikerid = $_SESSION['gebruikerid'];
        if ($datum == "morgen") {
            $datetime = new DateTime();
            $datetime->modify('+1 day');
            $datum = $datetime->format('Y-m-d');
        }
        if ($datum == "overmorgen") {
            $datetime = new DateTime();
            $datetime->modify('+2 day');
            $datum = $datetime->format('Y-m-d');
        }
        if ($datum == "3dagen") {
            $datetime = new DateTime();
            $datetime->modify('+3 day');
            $datum = $datetime->format('Y-m-d');
        }
        $aantalser = serialize($aantalarray);
        $gelukt = $bestellingsvc->bestellingplaatsen($gebruikerid, $datum, $aantalser);
        if ($gelukt != 1) {
            $error = "datumalingebruik";
            header("location:bestellingopnemen.php?error=$error");
        } else {
            header("location:home.php");
        }
    } else {
        if (!isset($_GET["error"])) {
            $error = null;
        } else
            $error = $_GET["error"];
        include("presentation/bestellingpresentation.php");
    }
}

