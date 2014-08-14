<?php

require_once("data/productdao.php");

class productservice {

    public function getproductenOverzicht() {
        $ProductDAO = new ProductDAO();
        $lijst = $ProductDAO->getAll();
        return $lijst;
    }

    public function voegNieuwProductToe($naam, $soortId) {
        $ProductDAO = new ProductDAO();
        $ProductDAO->create($naam, $soortId);
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

    public function updateProduct($id, $naam, $soortId) {
        $SoortDAO = new SoortDAO();
        $ProductDAO = new ProductDAO();
        $soort = $soortDAO->getById($soortId);
        $product = $productDAO->getById($id);
        $product->setNaam($naam);
        $product->setGenre($soort);
        $productDAO->update($product);
    }
}
