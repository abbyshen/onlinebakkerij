<?php

require_once ("data/bestellingDAO.php");

class bestellingservice{
    public function bestellingplaatsen($gebruikerid,$datum,$aantalser){
        $bestellingdao = new bestellingDAO();
        $gelukt=$bestellingdao->create($gebruikerid, $datum, $aantalser);
        return $gelukt;
    }
    
    public function bestellingterug($gebruikerid){
        $bestellingdao = new bestellingDAO();
        $bestelling = $bestellingdao->getbestellingmetid($gebruikerid);
        return $bestelling;
    }
}

