<?php

require_once("data/dbconfig.php");
require_once("entities/soort.php");

class soortDAO {

    public function getAll() {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, omschrijving from soort";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $soort = soort::create($rij["id"], $rij["omschrijving"]);
            array_push($lijst, $soort);
        }
        $dbh = null;
        return $lijst;
    }

    public function getById($id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select omschrijving from soort
                where id = " . $id;
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $soort = soort::create($id, $rij["omschrijving"]);
        $dbh = null;
        return $soort;
    }
}
