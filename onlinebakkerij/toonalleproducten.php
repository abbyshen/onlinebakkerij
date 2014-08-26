<?php
require_once("business/productservice.php");
require_once("business/soortservice.php");
require_once "business/gebruikerservice.php";
$productSvc1 = new productservice();
$productenLijst = $productSvc1->getproductenOverzicht();
include("presentation/productenlijst.php");
?>