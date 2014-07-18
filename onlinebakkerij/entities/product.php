<?php

class product {

    private static $idMap = array();
    private $id;
    private $naam;
    private $soort;

    private function __construct($id, $naam, $soort) {
        $this->id = $id;
        $this->naam = $naam;
        $this->soort = $soort;
    }

    public static function create($id, $naam, $soort) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new product($id, $naam, $soort);
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

    public function setNaam($naam) {
        $this->titel = $naam;
    }

    public function setSoort($soort) {
        $this->genre = $soort;
    }

}
