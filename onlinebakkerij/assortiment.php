<?php
session_start();
require_once("business/productservice.php");
require_once("business/soortservice.php");
require_once "business/gebruikerservice.php";
$soortsvc = new Soortenservice();
$soortenLijst = $soortsvc->getSoortenOverzicht();
$productenSvc1 = new productservice();
$alleproducten = $productenSvc1->getproductenOverzicht();
$productLijst = array();
$aantalarray = array();
include("presentation/assortimentlijst.php");
?>