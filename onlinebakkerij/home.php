<?php
require_once("business/productservice.php");
require_once("business/soortservice.php");
$productSvc1 = new productservice();
$productenLijst = $productSvc1->getproductenpersoort(2);
include("presentation/homepresentation.php");
?>