<?php

class gebruiker {

    private static $idMap = array();
    private $id;
    private $naam;
    private $voornaam;
    private $wachtwoord;
    private $telefoonnummer;
    private $emailadres;
    private $woonplaats;
    private $postcode;
    private $straat;

    private function __construct($id, $naam, $voornaam, $wachtwoord, $telefoonnummer, $emailadres
                                ,$woonplaats, $postcode, $straat, $nummer) {
        $this->id = $id;
        $this->naam = $naam;
        $this->voornaam = $voornaam;
        $this->wachtwoord = $wachtwoord;
        $this->telefoonnummer = $telefoonnummer;
        $this->emailadres = $emailadres;
        $this->woonplaats = $woonplaats;
        $this->postcode = $postcode;
        $this->straat = $straat;
        $this->nummer = $nummer;
    }

    public static function create($id, $naam,$voornaam, $wachtwoord, $telefoonnummer, $emailadres
                                  , $woonplaats, $postcode, $straat, $nummer) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new gebruiker($id, $naam, $voornaam, $wachtwoord, $telefoonnummer
                                             ,$emailadres,$woonplaats,$postcode,$straat,$nummer);
        }
        return self::$idMap[$id];
    }

    public function getId() {
        return $this->id;
    }

    public function getNaam() {
        return $this->naam;
    }
    
    public function getVroonaam(){
        return $this->voornaam;
    }

    public function getWachtwoord() {
        return $this->wachtwoord;
    }

    public function getTelefoonnummer() {
        return $this->telefoonnummer;
    }

    public function getEmailadres() {
        return $this->emailadres;
    }

    public function getWoonplaats(){
        return $this->woonplaats;
    }

    public function getPostcode(){
        return $this->postcode;
    }
    
    public function getStraat() {
        return $this->straat;
    }

    public function getNummer(){
        return $this->nummer;
    }

    public function setNaam($naam) {
        $this->naam = $naam;
    }
    
    public function setVoornaam($voornaam){
        $this->voornaam = $voornaam;
    }

    public function setWachtwoord($wachtwoord) {
        $this->wachtwoord = $wachtwoord;
    }

    public function setTelefoonnummer($telefoonnummer) {
        $this->telefoonnummer = $telefoonnummer;
    }

    public function setEmailadres($emailadres){
        $this->emailadres = $emailadres;
    }
    
    public function setWoonplaats($woonplaats){
        $this->woonplaats = $woonplaats;
    }
    
    public function setPostcode($postcode){
        $this->postcode = $postcode;
    }
    
    public function setStraat($straat){
        $this->straat = $straat;
    }
    
    public function setNummer($nummer){
        $this->nummer = $nummer;
    }
}
