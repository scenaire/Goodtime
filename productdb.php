<?php

class productdb {

  public function addItem(product $product) {
    require "db.php";
    $categoryID = $this->findCategoryID($product->getCategoryword());
    if ($categoryID === null) {
      return "Error";
    } else {
      $name = mysqli_real_escape_string($con,$product->getName());
      $price = $product->getPrice();
      $stock = $product->getStock();
      $decs = mysqli_real_escape_string($con,$product->getDecs());
      $image = $product->getImage();

        $sql = "INSERT INTO product (ProductName,ProductPrice,ProductCategoryID,ProductStock,ProductDecs)
        VALUES('$name','$price','$categoryID','$stock','$decs')";

        if ($con->query($sql)===true) {
          $name = mysqli_real_escape_string($con,$name);
          $user = $this->findIDbyName($name);
          $addpic = $this->addPicture($image,$user);
          return "Successful";
        }
        else {
          return "Error: ". $sql . "<br>" .$con->error;
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
    $categoryID = $this->findCategoryID($categoryWord);
    $sql = "SELECT * FROM product WHERE ProductCategoryID = '$categoryID'";
    $result = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($result)) {
      $arr[] = $data;
    }
    return $arr;
  }

  public function getAllCategory() {
    require "db.php";
    $sql = "SELECT CategoryName FROM productcategories";
    $result = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($result)) {
      $arr[] = $data;
    }
    return $arr;
  }

  public function findCategoryID($categoryWord) {
    require "db.php";
    $categoryWord = mysqli_real_escape_string($con,$categoryWord);
    $sql = "SELECT CategoryID FROM productcategories WHERE CategoryName = '$categoryWord'";
    $run_query = mysqli_query($con,$sql);
    $ID = mysqli_fetch_array($run_query);
    return $ID[0];
  }

  public function findCategoryName($categoryid) {
    require "db.php";
    $sql = "SELECT CategoryName FROM productcategories WHERE CategoryID = '$categoryid'";
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

  public function newCatagory($CatName) {
    require "db.php";
    $sql = "INSERT INTO productcategories (CategoryName)
    VALUES('$CatName')";
  }

  function custom_shuffle($list) {
  if (!is_array($list)) return $list;

  $keys = array_keys($list);
  shuffle($keys);
  $random = array();
  foreach ($keys as $key){
    array_push($random,$list[$key]);
  }

  return $random;
}

  public function slice_ar($multid_array = array(),$start,$end) {
    $sliced_array = array();  //setup the array you want with the sliced values.
    //loop though each sub array and slice off the first 5 to a new multidimensional array
    for ($i=$start;$i<$end;$i++) {
      $sliced_array[$i] = $multid_array[$i];
    }
    return $sliced_array;
  }


}

 ?>
