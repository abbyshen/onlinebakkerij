<?php
class soort {
    private static $idMap = array();
    private $id;
    private $omschrijving;
    private $extrainfo;

    private function __construct($id, $omschrijving,$extrainfo) {
        $this->id = $id;
        $this->omschrijving = $omschrijving;
        $this->extrainfo=$extrainfo;
    }

    public static function create($id, $omschrijving,$extrainfo) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new soort($id, $omschrijving,$extrainfo);
        }
        return self::$idMap[$id];
    }

    public function getId() {
        return $this->id;
    }

    public function getOmschrijving() {
        return $this->omschrijving;
    }
    
    public function getExtrainfo() {
        return $this->extrainfo;
    }

    public function setOmschrijving($omschrijving) {
        $this->omschrijving = $omschrijving;
    }
    
    public function setExtrainfo($extrainfo) {
        $this->extrainfo = $extrainfo;
    }
}
