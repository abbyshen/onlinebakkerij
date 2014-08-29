<?php

session_start();
require_once ("business/gebruikerservice.php");
require_once ("business/soortservice.php");
require_once ("business/productservice.php");
require_once ("exceptions/EmailadresBestaatException.php");
$soortsvc = new Soortenservice();
$soortenLijst = $soortsvc->getSoortenOverzicht();
$productenSvc1 = new productservice();
$alleproducten = $productenSvc1->getproductenOverzicht();
$maxaantal = count($alleproducten);
$lijst = array();
$productLijst = array();
$aantalarray = array();
$i = 1;
if (!isset($_GET["action"])) {
    $action = null;
} else
    $action = $_GET["action"];
if ($action == "bestellingfase1") {
    while ($i <= $maxaantal) {
        $aantal = $_POST["aantal$i"];
        $aantalarray[$i]=$aantal;
        $i++;
    }
    print_r($aantalarray);
    $datum = $_POST["datum"];
    include ("presentation/bestellingsoverzicht");
}
else {
        if (!isset($_GET["error"])) {
            $error = null;
        } else
            $error = $_GET["error"];
        include("presentation/bestellingpresentation.php");
    }

