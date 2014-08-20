<?php
require_once("data/dbconfig.php");
require_once("entities/gebruiker.php");

class gebruikerDAO{
    public function getById($id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, naam, voornaam, wachtwoord, telefoon, emailadres, woonplaats, postcode
                , straat and nummer from gebruiker where
                gebruiker.id = " . $id;
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $gebruiker = product::create($rij["id"], $rij["naam"], $rij["voornaam"], $rij["wachtwoord"]
                    ,$rij["telefoonnummer"], $rij["emailadres"], $rij["woonplaats"], $rij["postcode"]
                    ,$rij["straat"],$rij["nummer"],$rij["geblokkeerd"]);
        $dbh = null;
        return $gebruiker;
    }

    public function getByemailadres($emailadres) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, naam, voornaam, wachtwoord, telefoon, emailadres, woonplaats, postcode
                , straat and nummer from gebruiker where
                gebruiker.emailadres = " . $emailadres;
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        if (!$rij) {
            return null;
        } else {
            $gebruiker = product::create($rij["id"], $rij["naam"], $rij["voornaam"], $rij["wachtwoord"]
                    ,$rij["telefoonnummer"], $rij["emailadres"], $rij["woonplaats"], $rij["postcode"]
                    ,$rij["straat"],$rij["nummer"],$rij["geblokkeerd"]);
            $dbh = null;
            return $boek;
        }
    }

    public function create($naam, $voornaam, $wachtwoord, $telefoonnummer, $emailadres
                                ,$woonplaats, $postcode, $straat, $nummer) {
        $bestaandemailadres = $this->getByemailadres($emailadres);
        if (isset($$bestaandemailadres))
            throw new EmailadresBestaatException();
        $sql = "insert into product (naam, voornaam, wachtwoord, telefoonnummer, emailadres
                                ,woonplaats, postcode, straat, nummer)
                values (" . $naam . ", " . $voornaam . ",". $wachtwoord .",". $telefoonnummer.","
                . $emailadres .",".$woonplaats.",".$postcode.",".$straat.",".$nummer.")";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $gebruikerId = $dbh->lastInsertId();
        $dbh = null;
        $gebruiker = gebruiker::create($naam, $voornaam, $wachtwoord, $telefoonnummer, $emailadres
                                ,$woonplaats, $postcode, $straat, $nummer);
        return $gebruiker;
    }

    public function delete($id) {
        $sql = "delete from gebruiker where id = " . $id;
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }

    public function update($gebruiker) {
        $bestaandgebruiker = $this->getByemailadres($gebruiker->getEmailadres());
        if (isset($bestaandgebruiker) && $bestaandgebruiker->getId() != $gebruiker->getId())
            throw
            new EmailadresBestaatException();
        $sql = "update gebruiker set naam='" . $gebruiker->getNaam() .
                "', voornaam='" . $gebruiker->getVoornaam() .
                "', wachtwoord='" . $gebruiker->getWachtwoord() .
                "', telefoonnummer='" . $gebruiker->getTelefoonnummer() .
                "', emailadres='" . $gebruiker->getEmailadres() .
                "', woonplaats='" . $gebruiker->getWoonplaats() .
                "', postcode='" . $gebruiker->getPostcode() .
                "', straat='" . $gebruiker->getStraat() .
                "', nummer'" . $gebruiker->getNummer() .
                "' where id = " . $gebruiker->getId();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
}

