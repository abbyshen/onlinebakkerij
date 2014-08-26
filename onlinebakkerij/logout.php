<?php
require_once ("business/gebruikerservice.php");

gebruikerservice::logout();

if($fail = false){
    header("location:logout.php");
} else
header("location:home.php");
