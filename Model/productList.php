<?php

class productlist {

  public function getProductFromCategory($categoryWord) {
    require "product.php";
    require "db.php";
    $categoryID = $this->findCategoryID($categoryWord);
    $sql = "SELECT * FROM product WHERE ProductCategoryID = '$categoryID'";
    $result = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($result)) {
      $arr[] = $data;
    }
    return $arr;
  }

  public function getAllProduct() {
    require "db.php";
    $sql = "SELECT * FROM product";
    $result = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($result)) {
      $arr[] = $data;
    }
    return $arr;
  }

  public function newCatagory($CatName) {
    require "db.php";
    $sql = "INSERT INTO productcategories (CategoryName)
    VALUES('$CatName')";
  }

}

 ?>
