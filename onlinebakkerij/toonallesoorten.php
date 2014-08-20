<?php
require_once("business/soortservice.php");
$soortSvc1 = new Soortenservice();
$soortenLijst = $soortSvc1->getSoortenOverzicht();
include("presentation/soortenlijst.php");
?>

