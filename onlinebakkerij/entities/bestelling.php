<?php

class bestelling {
    private $bestellingid;
    private $gebruikerid;
    private $datum;
    private $productid;
    private $aantal;
    
    private function __construct($bestellingid,$gebruikerid,$datum,$productid,$aantal) {
        $this->bestellingid=$bestellingid;
        $this->gebruikerid=$gebruikerid;
        $this->datum=$datum;
        $this->productid=$productid;
        $this->aantal=$aantal;
    }
    
    public static function create($bestellingid,$gebruikerid,$datum,$productid,$aantal){
        $bestelling = new bestelling($bestellingid,$gebruikerid,$datum, $productid, $aantal);
        return $bestelling;
    }
    
    public function getBestellingID(){
        $bestellingid = $this->bestellingid;
    }
    
    public function getGebruikerID(){
        $gebruikerid = $this->gebruikerid;
    }
    public function getDatum(){
        $datum = $this->datum;
    }

    public function getProductID(){
        $gebruikerid = $this->productid;
    }
    
    public function getAantal(){
        $aantal = $this->aantal;
    }
    
    public function setProductid($productid){
        $this->productid = $productid;
    }

    public function setAantal($aantal){
        $this->aantal=$aantal;
    }
}

