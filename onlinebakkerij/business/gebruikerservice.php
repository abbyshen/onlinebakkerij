<?php
require_once ("entities/gebruiker.php");

class gebruikerservice {
    public function voegNieuwGebruikerToe($naam, $voornaam, $wachtwoord, $telefoonnummer
                                        ,$emailadres, $woonplaats, $postcode, $straat, $nummer) {
        $gebruikerDAO = new gebruikerDAO();
        $gebruikerDAO->create($naam, $voornaam,$wachtwoord,$telefoonnummer,$emailadres,$woonplaats
                                ,$postcode,$straat,$nummer);
    }

    public function verwijderProduct($id) {
        $ProductDAO = new ProductDAO();
        $ProductDAO->delete($id);
    }

    public function haalProductOp($id) {
        $ProductDAO = new ProductDAO();
        $product = $ProductDAO->getById($id);
        return $product;
    }

    public function updateProduct($id, $naam,$prijs, $soortId) {
        $SoortDAO = new SoortDAO();
        $ProductDAO = new ProductDAO();
        $soort = $soortDAO->getById($soortId);
        $product = $productDAO->getById($id);
        $product->setNaam($naam);
        $product->setPrijs($prijs);
        $product->setGenre($soort);
        $productDAO->update($product);
    }
}

