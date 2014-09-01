<?php
require_once ("data/DBconfig.php");
require_once ("entities/bestelling.php");
require_once ("entities/product.php");
require_once ("entities/gebruiker.php");

class bestellingDAO{
    public function create($gebruikerid,$datum,$productid,$aantal){
        $bestaandebestelling = $this->getbestelling($gebruikerid, $datum);
        if(!isset($bestaandebestelling)){
            $sql = "insert into bestelling (gebruikerid, datum, productid, aantal) values('".$gebruikerid."', '".$datum."', '".$productid."','".$aantal."')";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->exec($sql);
            $dbh = null;
            return true;
        }
        return false;
    }
    
    public function getbestelling($gebruikerid,$datum){
         $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select bestellingid, productid, aantal from bestelling where gebruikersid ='$gebruikerid' and datum ='$datum' limit 1";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $dbh->exec($sql);
        $dbh=null;
        $bestelling = bestelling::create($rij["bestellingid"], $gebruikerid, $datum, $rij["productid"], $rij["aantal"]);
        return $bestelling;
        }
}

