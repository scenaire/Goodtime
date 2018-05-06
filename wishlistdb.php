<?php

class wishlistdb {

  public function addItem($uid,$pid) {
    require "db.php";

    $uid = mysqli_real_escape_string($con,$uid);

    $sql = "INSERT INTO wishlist(Username,ProductID)
    VALUES('$uid','$pid')";

    if ($con->query($sql)===true) {
      return true;
    } else {
      return "Error: ". $sql . "<br>" .$con->error;
    }

    $con->close();
  }

  public function getItemList($uid) {
    require "db.php";

    $uid = mysqli_real_escape_string($con,$uid);

    $sql = "SELECT * FROM wishlist WHERE Username = '$uid'";
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
    $sql = "DELETE FROM wishlist WHERE Username = '$uid' AND ProductID = '$pid'";
    $run_query = mysqli_query($con,$sql);
  }


}

 ?>
