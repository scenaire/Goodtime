<?php

class action {

  public function addProduct($name,$price,$image,$category,$stock,$decs) {
    require_once('db.php');
    $categoryID = $this->findCategoryID($category);

    if ($categoryID === null) {
      echo "Error";
    }

    $sql = "INSERT INTO product (ProductName,ProductPrice,ProductCategoryID,ProductStock,ProductDecs)
    VALUES('$name','$price','$categoryID','$stock','$decs')";

    if ($con->query($sql)===true) {
      echo "successfully";
      $name = mysqli_real_escape_string($con,$name);
      $user = $this->findID($name);
      $addpic = $this->addPicture($image,$user);
    }
    else {
      echo "Error: ". $sql . "<br>" .$con->error;
    }

    $con->close();
  }

  public function findID($name) {
    require "db.php";
    $name = mysqli_real_escape_string($con,$name);
    $sql = "SELECT ProductID FROM product WHERE ProductName = '$name'";
    $run_query = mysqli_query($con,$sql);
    $ID = mysqli_fetch_array($run_query);
    return $ID[0];
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

}

 ?>
