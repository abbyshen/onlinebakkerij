<?php

require_once ("data/DBconfig.php");
require_once ("entities/bestelling.php");
require_once ("entities/product.php");
require_once ("entities/gebruiker.php");

class bestellingDAO {

    public function create($gebruikerid, $datum, $aantalser) {
        $gelijk = null;
        $bestaandebestelling = $this->getbestelling($gebruikerid, $datum);
        if (isset($bestaandebestelling)) {
            $gelijk = true;
        }
        if ($gelijk != true) {
            $sql = "insert into bestelling (gebruikerid, datum, aantalser) values('" . $gebruikerid . "', '" . $datum . "','" . $aantalser . "')";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->exec($sql);
            $dbh = null;
            return true;
        }
        return false;
    }

    public function getbestelling($gebruikerid, $datum) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select bestellingid from bestelling where gebruikerid ='" . $gebruikerid . "' and datum ='" . $datum . "' limit 1";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $dbh->exec($sql);
        $dbh = null;
        $bestellingid = $rij["bestellingid"];
        return $bestellingid;
    }

    public function getbestellingmetid($gebruikerid) {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select bestellingid,datum,aantalser from bestelling where gebruikerid ='" . $gebruikerid . "'";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $bestelling = bestelling::create($rij["bestellingid"], $gebruikerid, $rij["datum"], $rij["aantalser"]);
            array_push($lijst, $bestelling);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function deletebestelling($date,$gebruikerid){
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "delete from bestelling where gebruikerid ='" . $gebruikerid . "' and datum='".$date."'";
        $dbh->exec($sql);
        $dbh=null;
    }

}
