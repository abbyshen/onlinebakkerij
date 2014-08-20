<?php
require_once("business/productservice.php");
$productSvc1 = new productservice();
$productenLijst = $productSvc1->getproductenOverzicht();
include("presentation/productenlijst.php");
?>