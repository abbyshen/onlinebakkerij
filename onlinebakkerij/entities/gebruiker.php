<?php

class gebruiker {

    private static $idMap = array();
    private $id;
    private $gebruiker;
    private $wachtwoord;
    private $telefoonnummer;
    private $emailadres;

    private function __construct($id, $gebruiker, $wachtwoord, $telefoonnummer, $emailadres) {
        $this->id = $id;
        $this->gebruiker = $gebruiker;
        $this->wachtwoord = $wachtwoord;
        $this->telefoonnummer = $telefoonnummer;
        $this->emailadres = $emailadres;
    }

    public static function create($id, $gebruiker, $wachtwoord, $telefoonnummer, $emailadres) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new gebruiker($id, $gebruiker, $wachtwoord, $telefoonnummer,$emailadres);
        }
        return self::$idMap[$id];
    }

    public function getId() {
        return $this->id;
    }

    public function getGebruiker() {
        return $this->gebruiker;
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

    public function setGebruiker($gebruiker) {
        $this->gebruiker = $gebruiker;
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
}
