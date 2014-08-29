<?php

require_once("data/dbconfig.php");
require_once("entities/soort.php");
require_once("entities/product.php");

class productDAO {

    public function getAll() {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select product.id as productid, naam, prijs,
                soortid, omschrijving from product,
                soort where soortid =
                soort.id";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $soort = soort::create($rij["soortid"], $rij["omschrijving"]);
            $product = product::create($rij["productid"], $rij["naam"], $rij{"prijs"}, $soort);
            array_push($lijst, $product);
        }
        $dbh = null;
        return $lijst;
    }

    public function getById($id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select product.id as productid, naam, prijs, soortid,
                omschrijving from product, soort where
                soortid = soort.id and
                product.id = " . $id;
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $soort = soort::create($rij["soortid"], $rij["omschrijving"]);
        $product = product::create($rij["productid"], $rij["naam"], $rij["prijs"], $soort);
        $dbh = null;
        return $lijst;
    }
    
    public function getidbyname($naam){
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql ="select product.id as productid from product where naam='".$naam."' limit 1";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $productid = $rij["productid"];
        print($productid);
        return $productid;
    }
    
    public function getnamebyid($id){
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql ="select naam from product where id='".$id."' limit 1";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $productnaam = $rij["naam"];
        return $productnaam;
    }
    
    public function getprijsbyid($id){
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql ="select prijs from product where id='".$id."' limit 1";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $productprijs = $rij["prijs"];
        return $productprijs;
    }

    public function getBySoortid($soortid) {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select product.id as productid, naam, prijs, soortid, omschrijving
                from product, soort where soortid = soort.id
                and soortid = '" . $soortid . "'";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij){
        $soort = soort::create($rij["soortid"], $rij["omschrijving"]);
        $product = product::create($rij["productid"], $rij["naam"], $rij["prijs"], $soort);
        array_push($lijst, $product);
        }
        $dbh = null;
        return $lijst;
    }

    public function create($naam, $soortId) {
        $bestaandproduct = $this->getByNaam($naam);
        if (isset($$bestaandproduct))
            throw new NaamBestaatException();
        $sql = "insert into product (naam, soortid)
                values ('" . $naam . "', " . $soortId . ")";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $productId = $dbh->lastInsertId();
        $dbh = null;
        $soortDAO = new soortDAO();
        $soort = $soortDAO->getById($soortId);
        $product = product::create($productId, $naam, $soort);
        return $product;
    }

    public function delete($id) {
        $sql = "delete from product where id = " . $id;
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }

    public function update($product) {
        $bestaandproduct = $this->getByNaam($product->getNaam());
        if (isset($bestaandproduct) && $bestaandproduct->getId() != $product->getId())
            throw
            new NaamBestaatException();
        $sql = "update product set naam='" . $product->getNaam() .
                "', soortid=" . $product->getSoort()->getId() .
                " where id = " . $product->getId();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }

}
