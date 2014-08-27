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
if (!isset($_GET["action"])) {
    $action = null;
} else
    $action = $_GET["action"];
if ($action == "bestellingfase1") {
    $i = 5;
    print($_GET["aantal[$i]"]);
    /*if ($i<=$maxaantal){
        $aantal = $_POST["aantal[$i]"];
        $aantalarray =array_push($lijst, $aantal); 
        $i++;
    }
    print_r($aantalarray);
    */}
 else {
    if (!isset($_GET["error"])) {
        $error = null;
    } else
        $error = $_GET["error"];
    include("presentation/bestellingpresentation.php");
}
