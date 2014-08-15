<?php

require_once ("data/gebruikerdao.php");

class gebruikerservice {
    public function voegNieuwGebruikerToe($gebruiker, $wachtwoord ,$telefoonnummer, $emailadres) {
        $gebruikerDAO = new gebruikerDAO();
        $gebruikerDAO->create($gebruiker, $wachtwoord, $telefoonnummer,$emailadres);
    }
    
    public function verwijderGebruiker($id) {
        $GebruikerDAO = new GebruikerDAO();
        $GebruikerDAO->delete($id);
    }
    
    public function haalGebruikerOp($id) {
        $gebruikerDAO = new gebruikerDAO();
        $gebruiker = $gebruikerDAO->getById($id);
        return $gebruiker;
    }
    
    public function updategebruiker($id, $gebruiker, $wachtwoord, $telefoonnummer, $emailadres) {
        $gebruikerDAO = new gebruikerDAO();
        $gebruiker = $gebruikerDAO->getById($id);
        $gebruiker->setgebruiker($gebruiker);
        $gebruiker->setwachtwoord($wachtwoord);
        $gebruiker->settelefoonnummer($telefoonnummer);
        $gebruiker->setemailadres($emailadres);
        $gebruikerDAO->update($gebruiker);
    }
}
