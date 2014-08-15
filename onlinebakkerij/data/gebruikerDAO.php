<?php

require_once("data/dbconfig.php");
require_once ("entities/gebruiker.php");

class gebruikerDAO {
    
    public function getById($id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select mvc_boeken.id as boekid, titel, genreid,
                omschrijving from mvc_boeken, mvc_genres where
                genreid = mvc_genres.id and
                mvc_boeken.id = " . $id;
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $genre = Genre::create($rij["genreid"], $rij["omschrijving"]);
        $boek = Boek::create($rij["boekid"], $rij["titel"], $genre);
        $dbh = null;
        return $boek;
    }

    public function getByTitel($titel) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select mvc_boeken.id as boekid, titel, genreid, omschrijving
                from mvc_boeken, mvc_genres where genreid = mvc_genres.id
                and titel = '" . $titel . "'";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        if (!$rij) {
            return null;
        } else {
            $genre = Genre::create($rij["genreid"], $rij["omschrijving"]);
            $boek = Boek::create($rij["boekid"], $rij["titel"], $genre);
            $dbh = null;
            return $boek;
        }
    }

    public function create($titel, $genreId) {
        $bestaandBoek = $this->getByTitel($titel);
        if (isset($bestaandBoek))
            throw new TitelBestaatException();
        $sql = "insert into mvc_boeken (titel, genreid)
                values ('" . $titel . "', " . $genreId . ")";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $boekId = $dbh->lastInsertId();
        $dbh = null;
        $genreDAO = new GenreDAO();
        $genre = $genreDAO->getById($genreId);
        $boek = Boek::create($boekId, $titel, $genre);
        return $boek;
    }

    public function delete($id) {
        $sql = "delete from mvc_boeken where id = " . $id;
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }

    public function update($boek) {
        $bestaandBoek = $this->getByTitel($boek->getTitel());
        if (isset($bestaandBoek) && $bestaandBoek->getId() != $boek->getId())
            throw
            new TitelBestaatException();
        $sql = "update mvc_boeken set titel='" . $boek->getTitel() .
                "', genreid=" . $boek->getGenre()->getId() .
                " where id = " . $boek->getId();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
}

