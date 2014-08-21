<?php
require_once ("data/gebruikerDAO.php");

class gebruikerservice {
    public function voegNieuwGebruikerToe($naam, $voornaam, $telefoonnummer
                                        ,$emailadres, $woonplaats, $postcode, $straat, $nummer){
        $gebruikerDao= new gebruikerDAO();
        $wachtwoord= $gebruikerDao->randomPassword();
        $geblokkeerd = false;
        $gebruikerDAO = new gebruikerDAO();
        $gebruikerDAO->create($naam, $voornaam,$wachtwoord,$telefoonnummer,$emailadres,$woonplaats
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

    public function updateGebruiker($id,$naam, $voornaam, $wachtwoord, $telefoonnummer,$emailadres
                                ,$woonplaats, $postcode, $straat, $nummer) {
        $gebruikerDAO = new gebruikerDAO();
        $gebruiker = $gebruikerDAO->getById($id);
        $gebruiker->setNaam($naam);
        $gebruiker->setVoornaam($voornaam);
        $gebruiker->setWachtwoord($wachtwoord);
        $gebruiker->setTelefoonnummer($telefoonnummer);
        $gebruiker->setEmailadres($emailadres);
        $gebruiker->setWoonplaats($woonplaats);
        $gebruiker->setPostcode($postcode);
        $gebruiker->setStraat($straat);
        $gebruiker->setNummer($nummer);
        $gebruiker->update($gebruiker);
    }
}

