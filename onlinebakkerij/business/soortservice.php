<?php

require_once("data/soortdao.php");

class Soortenservice {

    public function getSoortenOverzicht() {
        $SoortDAO = new SoortDAO();
        $lijst = $SoortDAO->getAll();
        return $lijst;
    }
    
    public function getSoortbyId($id){
        $soortDAO = new soortDAO();
        $soort = $soortDAO->getById($id);
        return $soort;
    }
}

