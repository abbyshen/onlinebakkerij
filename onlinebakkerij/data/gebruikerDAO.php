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

    public function sec_session_start() {
        $session_name = 'sec_session_id';   // Set a custom session name
        $httponly = true;
        // Forces sessions to only use cookies.
        if (ini_set('session.use_only_cookies', 1) === FALSE) {
            header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
            exit();
        }
        // Gets current cookies params.
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure= false , $httponly);
        // Sets the session name to the one set above.
        session_name($session_name);
        session_start();            // Start the PHP session 
        session_regenerate_id();    // regenerated the session, delete the old one. 
    }

    public function login($emailadres, $password) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select gebruikersid, wachtwoord as db_password, geblokkeerd from gebruiker where emailadres = '$emailadres' LIMIT 1";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $dbh->exec($sql);    // Execute the prepared query.
        $dbh = NULL;
        $gebruikerid = $rij["gebruikersid"];
        $db_password = $rij["db_password"];
        $geblokkeerd = $rij["geblokkeerd"];
        // hash the password
        $password = sha1($password);

        // If the user exists we check if the account is locked
        // from too many login attempts 
        if ($geblokkeerd == true) {
            // Account is locked 
            // Send an email to user saying their account is locked
            return false;
        } else {
            // Check if the password in the database matches
            // the password the user submitted.
            if ($db_password == $password) {
                // Password is correct!
                // Get the user-agent string of the user.
                $user_browser = $_SERVER['HTTP_USER_AGENT'];
                // XSS protection as we might print this value
                $_SESSION['gebruikerid'] = $gebruikerid;
                $_SESSION['emailadres'] = $emailadres;
                $_SESSION['login_string'] = sha1($password . $user_browser);
                // Login successful.
                return true;
            } else {
                return false;
            }
        }
    }

    public function checkbrute($gebruikerid) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        // Get timestamp of current time 
        $now = time();

        // All login attempts are counted from the past 2 hours. 
        $valid_attempts = $now - (2 * 60 * 60);

        $sql = "SELECT time FROM login_attempts WHERE gebruikerid = '$gebruikerid' AND time > '$valid_attempts'";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $dbh->exec($sql);

        // If there have been more than 7 failed logins 
        if ($resultSet > 7) {
            $dbh->exec("update gebruiker set geblokeerd = true where gebruikerid = '$gebruikerid'");
        }
    }

    public function login_check() {
        // Check if all session variables are set 
        if (isset($_SESSION['gebruikerid'], $_SESSION['emailadres'], $_SESSION['login_string'])) {

            $gebruikerid = $_SESSION['gebruikerid'];
            $login_string = $_SESSION['login_string'];
            $emailadres = $_SESSION['emailadres'];

            // Get the user-agent string of the user.
            $user_browser = $_SERVER['HTTP_USER_AGENT'];
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $sql = "SELECT wachtwoord FROM gebruiker WHERE gebruikersid = '$gebruikerid' LIMIT 1";
            $resultSet = $dbh->query($sql);
            $rij = $resultSet->fetch();
            $dbh->exec($sql);   // Execute the prepared query.
            $db_wachtwoord = $rij["wachtwoord"];

            $login_check = $db_wachtwoord.sha1($user_browser);

            if ($login_check == $login_string) {
                // Logged In!!!! 
                return true;
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
       
    }

}
