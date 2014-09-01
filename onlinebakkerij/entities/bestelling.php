<?php

class bestelling {
    private $bestellingid;
    private $gebruikerid;
    private $datum;
    private $aantalser;
    
    private function __construct($bestellingid,$gebruikerid,$datum,$aantalser) {
        $this->bestellingid=$bestellingid;
        $this->gebruikerid=$gebruikerid;
        $this->datum=$datum;
        $this->aantalser=$aantalser;
    }
    
    public static function create($bestellingid,$gebruikerid,$datum,$aantalser){
        $bestelling = new bestelling($bestellingid,$gebruikerid,$datum, $aantalser);
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
    
    public function getAantal(){
        $aantalser = $this->aantalser;
    }

    public function setAantal($aantalser){
        $this->aantalser=$aantalser;
    }
}

