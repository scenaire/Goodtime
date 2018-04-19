<?php

class productdb {

  public function addItem(product $product) {
    require "db.php";
    $categoryID = $this->findCategoryID($product->getCategoryword());
    if ($categoryID === null) {
      echo "Error";
    } else {
      $name = $product->getName();
      $price = $product->getPrice();
      $stock = $product->getStock();
      $decs = $product->getDecs();
      $image = $product->getImage();

        $sql = "INSERT INTO product (ProductName,ProductPrice,ProductCategoryID,ProductStock,ProductDecs)
        VALUES('$name','$price','$categoryID','$stock','$decs')";

        if ($con->query($sql)===true) {
          echo "successfully";
          $name = mysqli_real_escape_string($con,$name);
          $user = $this->findIDbyName($name);
          $addpic = $this->addPicture($image,$user);
        }
        else {
          echo "Error: ". $sql . "<br>" .$con->error;
        }

        $con->close();
    }

  }

  public function getProduct($ProductID) {
    require "db.php";
    $sql = "SELECT * FROM product WHERE ProductID = '$ProductID'";
    $run_query = mysqli_query($con,$sql);
    $Product = mysqli_fetch_array($run_query);
    return $Product;
  }

  public function getProductImage($ProductID) {
    require "db.php";
    $sql = "SELECT * FROM productimage WHERE ProductID = '$ProductID'";
    $run_query = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($run_query)){
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

  public function getProductbyCategory($categoryWord) {
    require "db.php";
    $categoryID = this->findCategoryID($categoryWord);
    $sql = "SELECT * FROM product WHERE ProductCategoryID = '$categoryID'";
    $result = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($result)) {
      $arr[] = $data;
    }
    return $arr;
  }

  protected function findCategoryID($categoryWord) {
    require "db.php";
    $categoryWord = mysqli_real_escape_string($con,$categoryWord);
    $sql = "SELECT CategoryID FROM productcategories WHERE CategoryName = '$categoryWord'";
    $run_query = mysqli_query($con,$sql);
    $ID = mysqli_fetch_array($run_query);
    return $ID[0];
  }

  public function addPicture($img,$ID) {
    include "db.php";
    foreach ($img as $eachImg) {
      $eachImg = mysqli_real_escape_string($con,$eachImg);
      $sql = "INSERT INTO productimage (ProductImage,ProductID)
      VALUES('$eachImg','$ID')";
      $run_query = mysqli_query($con,$sql);
    }
  }

  public function findIDbyName($name) {
    require "db.php";
    $name = mysqli_real_escape_string($con,$name);
    $sql = "SELECT ProductID FROM product WHERE ProductName = '$name'";
    $run_query = mysqli_query($con,$sql);
    $ID = mysqli_fetch_array($run_query);
    return $ID[0];
  }

  public function setStock($pid,$stock) {
    require "db.php";
    $sql = "UPDATE product SET ProductStock = '$stock' WHERE ProductID = '$pid'";
    $run_query = mysqli_query($con,$sql);
  }


}

 ?>
