<?php


  class product {

    private $id,$name,$price,$category,$image,$stock,$decs;

    public function __construct($id,$name,$price,$category,$image,$stock,$decs) {
      $this->id = $id;
      $this->name = $name;
      $this->price = $price;
      $this->category = $category;
      $this->image = $image;
      $this->stock = $stock;
      $this->decs = $decs;
    }

    public function getprice() {
      return $this->price;
    }

    public function getStock() {
      return $this->stock;
    }

    public function getID() {
      return $this->ID;
    }

  }

?>
