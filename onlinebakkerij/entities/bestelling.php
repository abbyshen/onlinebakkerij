<?php

class bestelling {
    private $bestellingid;
    private $productid = array();
    private $aantal = array();
    
    private function __construct($bestellingid,$productid,$aantal) {
        $this->bestellingid=$bestellingid;
        $this->productid=$productid;
        $this->aantal=$aantal;
    }
    
    public static function create($bestellingid,$productid,$aantal){
        
    }
}

