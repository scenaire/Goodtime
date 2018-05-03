<?php

class cartdb {

  public function addItem($uid,$pid,$quantity) {
    require "db.php";

    $uid = mysqli_real_escape_string($con,$uid);

    $sql = "INSERT INTO cart(Username,ProductID,Quantity)
    VALUES('$uid','$pid','$quantity')";

    if ($con->query($sql)===true) {

    } else {
      return "Error: ". $sql . "<br>" .$con->error;
    }

    $con->close();
  }

  public function getItemList($uid) {
    require "db.php";

    $uid = mysqli_real_escape_string($con,$uid);

    $sql = "SELECT * FROM cart WHERE Username = '$uid'";
    $run_query = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($run_query)){
      $arr[] = $data;
    }
    return $arr;
  }

  public function removeItem($uid,$pid) {
    require "db.php";

    $uid = mysqli_real_escape_string($con,$uid);
    $sql = "DELETE FROM cart WHERE Username = '$uid' AND ProductID = '$pid'";
    $run_query = mysqli_query($con,$sql);
  }

  public function updateItem($uid,$pid,$quantity) {
    require "db.php";

    $uid = mysqli_real_escape_string($con,$uid);
    $sql = "UPDATE cart SET Quantity = '$quantity' WHERE Username = '$uid' AND ProductID = '$pid'";
    if ($con->query($sql) === true) {
      echo "success";
    } else {
      return "Error: ". $sql . "<br>" .$con->error;
    }

    $con->close();
  }

}

 ?>
