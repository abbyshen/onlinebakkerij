<?php

require_once("data/soortdao.php");

class Soortenservice {

    public function getSoortenOverzicht() {
        $SoortDAO = new SoortDAO();
        $lijst = $soortDAO->getAll();
        return $lijst;
    }

}

