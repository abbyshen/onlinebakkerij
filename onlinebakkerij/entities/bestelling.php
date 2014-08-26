<?php

class bestelling {
    private $bestellingid;
    private $productid = array();
    private $aantal = array();
    
    private function __construct($bestellingid,$gebruikerid,$productid,$aantal) {
        $this->bestellingid=$bestellingid;
        $this->gebruikerid=$gebruikerid;
        $this->productid=$productid;
        $this->aantal=$aantal;
    }
    
    public static function create($bestellingid,$gebruikerid,$productid,$aantal){
        $bestelling = self::create($bestellingid,$gebruikerid, $productid, $aantal);
        return $bestelling;
    }
    
    public function getBestellingID(){
        $bestellingid = $this->bestellingid;
    }
    
    public function getGebruikerID(){
        $gebruikerid = $this->gebruikerid;
    }
    
    public function getProductID(){
        $gebruikerid = $this->productid;
    }
    
    public function getAantal(){
        $aantal = $this->aantal;
    }
    
    public function setAantal($aantal){
        $this->aantal=$aantal;
    }
}

