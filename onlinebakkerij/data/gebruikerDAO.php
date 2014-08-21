<?php

require_once("data/dbconfig.php");
require_once("entities/gebruiker.php");

class gebruikerDAO {

    public function randomPassword($emailadres) {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $password = implode($pass);
        $to = "$emailadres";
        $subject = "wachtwoord nieuw account bakkerij vroman";
        $body = "uw wachtwoord voor de bakker vroman is:" . $password . "je kan je wachtwoord aanpassen in je profiel ";
        $headers = "From: root@localhost.com";
        if (mail($to, $subject, $body, $headers)) {
            return sha1($password); //turn the array into a string
        } else
            throw new mailmisluktException();
    }

    public function getById($id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select gebruikersid, naam, voornaam, wachtwoord, telefoon, emailadres, woonplaats, postcode
                , straat and nummer from gebruiker where
                gebruiker.id = " . $id;
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $gebruiker = gebruiker::create($rij["gebruikersid"], $rij["naam"], $rij["voornaam"], $rij["wachtwoord"]
                        , $rij["telefoonnummer"], $rij["emailadres"], $rij["woonplaats"], $rij["postcode"]
                        , $rij["straat"], $rij["nummer"], $rij["geblokkeerd"]);
        $dbh = null;
        return $gebruiker;
    }

    public function getByemailadres($emailadres) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select gebruikersid, naam, voornaam, wachtwoord, telefoonnummer, emailadres, woonplaats, postcode
                , straat and nummer from gebruiker where emailadres = '" . $emailadres . "'";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        if (!$rij) {
            return null;
        } else {
            $gebruiker = gebruiker::create($rij["gebruikersid"], $rij["naam"], $rij["voornaam"], $rij["wachtwoord"]
                            , $rij["telefoonnummer"], $rij["emailadres"], $rij["woonplaats"], $rij["postcode"]
                            , $rij["straat"], $rij["nummer"], $rij["geblokkeerd"]);
            $dbh = null;
            return $gebruiker;
        }
    }

    public function create($naam, $voornaam, $wachtwoord, $telefoonnummer, $emailadres
    , $woonplaats, $postcode, $straat, $nummer, $geblokkeerd) {
        $bestaandemailadres = $this->getByemailadres($emailadres);
        if (isset($bestaandemailadres))
            throw new EmailadresBestaatException();
        $sql = "insert into gebruiker (naam, voornaam, wachtwoord, telefoonnummer, emailadres
                                ,woonplaats, postcode, straat, nummer,geblokkeerd)
                values ('" . $naam . "', '" . $voornaam . "','" . $wachtwoord . "','" . $telefoonnummer . "','"
                . $emailadres . "','" . $woonplaats . "','" . $postcode . "','" . $straat . "','" . $nummer . "','" . $geblokkeerd . "')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        /* $gebruikersId = $dbh->lastInsertId(); */
        $dbh = null;
        $gebruiker = gebruiker::create($naam, $voornaam, $wachtwoord, $telefoonnummer, $emailadres
                        , $woonplaats, $postcode, $straat, $nummer, $geblokkeerd);
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
