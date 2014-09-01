<?php

require_once ("data/bestellingDAO.php");

class bestellingservice{
    public function bestellingplaatsen($gebruikerid,$datum,$productid,$aantal){
        $bestellingdao = new bestellingDAO();
        $gelukt=$bestellingdao->create($gebruikerid, $datum, $productid, $aantal);
        return $gelukt;
    }
}

