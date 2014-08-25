<?php

require_once("data/productdao.php");

class productservice {

    public function getproductenOverzicht() {
        $ProductDAO = new ProductDAO();
        $lijst = $ProductDAO->getAll();
        return $lijst;
    }
    
    public function getproductenpersoort($soortid){
        $ProductDAO = new productDAO();
        $lijst = $ProductDAO->getBySoortid($soortid);
        return $lijst;
    }

    public function voegNieuwProductToe($naam, $prijs, $soortId) {
        $ProductDAO = new ProductDAO();
        $ProductDAO->create($naam, $prijs, $soortId);
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
    
    public function haalProductOpMetSoort($soortid){
        $productDAO = new productDAO();
        $product = $productDAO->getBySoortid($soortid);
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
