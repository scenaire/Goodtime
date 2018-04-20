<?php


  class product {

    private $id,$name,$price,$category,$image,$stock,$decs,$categoryword;

    public function addItem($name,$price,$image,$categoryword,$stock,$decs) {
      require_once('productdb.php');
      $this->name = $name;
      $this->price = $price;
      $this->categoryword = $categoryword;
      $this->image = $image;
      $this->stock = $stock;
      $this->decs = $decs;
      $productdb = new productdb;
      return $productdb->addItem($this);
    }

    public function selectProduct($productID) {
      require_once('productdb.php');
      $productdb = new productdb;
      $temp = $productdb->getProduct($productID);
      $this->ID = $productID;
      $this->name = $temp['ProductName'];
      $this->price = $temp['ProductPrice'];
      $this->category = $temp['ProductCategoryID'];
      $this->stock = $temp['ProductStock'];
      $this->decs = $temp['ProductDecs'];
      $this->image = $productdb->getProductImage($productID);
      return $this;
    }

    public function getPrice() {
      return $this->price;
    }

    public function getStock() {
      return $this->stock;
    }

    public function getID() {
      return $this->ID;
    }

    public function getName() {
      return $this->name;
    }

    public function getCategory() {
      return $this->category;
    }

    public function getDecs(){
      return $this->decs;
    }

    public function getCategoryWord() {
      return $this->categoryword;
    }

    public function getImage() {
      return $this->image;
    }

    public function setStock($stock) {
      require_once('productdb.php');
      $this->stock = $stock;
      $productdb = new productdb;
      $productdb->setStock($this->ID,$this->stock);
    }

  }

?>
