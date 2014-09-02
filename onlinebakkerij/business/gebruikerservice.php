<?php
require_once ("data/gebruikerDAO.php");

class gebruikerservice {
    public function voegNieuwGebruikerToe($naam, $voornaam, $telefoonnummer
                                        ,$emailadres, $woonplaats, $postcode, $straat, $nummer){
        $gebruikerDao= new gebruikerDAO();
        $wachtwoord= $gebruikerDao->randomPassword($emailadres);
        $geblokkeerd = false;
        return $gebruikerDao->create($naam, $voornaam,$wachtwoord,$telefoonnummer,$emailadres,$woonplaats
                                ,$postcode,$straat,$nummer,$geblokkeerd);
    }

    public function verwijderGebruiker($id) {
        $GebruikerDAO = new gebruikerDAO();
        $gebruikerDAO->delete($id);
    }

    public function haalGebruikerOpId($id) {
        $gebruikerDAO = new gebruikerDAO();
        $gebruiker = $gebruikerDAO->getById($id);
        return $gebruiker;
    }
    
    public function haalGebruikerOpemailadres($emailadres) {
        $gebruikerDAO = new gebruikerDAO();
        $gebruiker = $gebruikerDAO->getByemailadres($emailadres);
        return $gebruiker;
    }

    public function updateGebruiker($naam, $voornaam, $telefoonnummer,$emailadres
                                ,$woonplaats, $postcode, $straat, $nummer) {
        $gebruikerDAO = new gebruikerDAO();
        $gebruiker1 = self::haalGebruikerOpemailadres($emailadres);
        $gebruiker1->setNaam($naam);
        $gebruiker1->setVoornaam($voornaam);
        $gebruiker1->setTelefoonnummer($telefoonnummer);
        $gebruiker1->setWoonplaats($woonplaats);
        $gebruiker1->setPostcode($postcode);
        $gebruiker1->setStraat($straat);
        $gebruiker1->setNummer($nummer);
        $gebruikerDAO->update($gebruiker1);
    }
    
    public function updateWachtwoord($emailadres,$pass1){
        $gebruikerDAO = new gebruikerDAO();
        $gebruiker1 = self::haalGebruikerOpemailadres($emailadres);
        $gebruiker1->setWachtwoord($pass1);
        $gebruikerDAO->update($gebruiker1);
    }

    public function loggebruikerin($emailadres,$wachtwoord){
        $gebruikerDAO = new gebruikerDAO();
        //$gebruikerDAO->checkbrute($gebruikerid);
        $gelukt=$gebruikerDAO->login($emailadres, $wachtwoord);
        return $gelukt;
    }

    public function logincheck(){
        $gebruikerDAO = new gebruikerDAO();
        $gelukt=$gebruikerDAO->login_check();
        return $gelukt;
    }
    
    public function logout(){
        session_start();
        unset($_SESSION['gebruikerid']);
        unset($_SESSION['emailadres']);
        unset($_SESSION['wachtwoord']);
        session_destroy();
    }
}

