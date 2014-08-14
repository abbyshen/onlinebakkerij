<?php

class product {

    private static $idMap = array();
    private $id;
    private $naam;
    private $soort;
    private $prijs;

    private function __construct($id, $naam, $soort,$prijs) {
        $this->id = $id;
        $this->naam = $naam;
        $this->soort = $soort;
        $this->prijs = $prijs;
    }

    public static function create($id, $naam, $soort,$prijs) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new product($id, $naam, $soort,$prijs);
        }
        return self::$idMap[$id];
    }

    public function getId() {
        return $this->id;
    }

    public function getNaam() {
        return $this->naam;
    }

    public function getSoort() {
        return $this->soort;
    }

    public function getPrijs () {
        return $this->prijs;
    }

    public function setNaam($naam) {
        $this->titel = $naam;
    }

    public function setSoort($soort) {
        $this->genre = $soort;
    }
    
    public function setPrijs($prijs){
        $this->prijs = $prijs;
    }
}
