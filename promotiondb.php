<?php

class promotiondb {

  public function addPromotion($name,$discount,$code,$type,$condition) {
    require "db.php";

    $name = mysqli_real_escape_string($con,$name);
    $code = mysqli_real_escape_string($con,$code);
    $type = mysqli_real_escape_string($con,$type);

    $sql = "INSERT INTO promotion (PromotionName,PromotionDiscount,PromotionType,PromotionCode,PromotionCondition)
    VALUES('$name','$discount','$type','$code','$condition')";

    if ($con->query($sql)===true) {
      return true;
    } else {
      return "Error: ". $sql . "<br>" .$con->error;
    }

    $con->close();
  }

  public function getPromotionfromCode($code) {
    require "db.php";

    $code = mysqli_real_escape_string($con,$code);

    $sql = "SELECT * FROM promotion WHERE PromotionCode = '$code'";
    $run_query = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($run_query)){
      $arr[] = $data;
    }
    return $arr;
  }

  public function getPromotionfromID($id) {
    require "db.php";

    $sql = "SELECT * FROM promotion WHERE PromotionID = '$id'";
    $run_query = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($run_query)){
      $arr[] = $data;
    }
    return $arr[0];
  }

  public function getPromotionList() {
    require "db.php";
    $sql = "SELECT * FROM promotion";
    $run_query = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($run_query)){
      $arr[] = $data;
    }
    return $arr;

  }

  public function removePromotion($prid) {
    require "db.php";
    $sql = "DELETE FROM promotion WHERE PromotionID = '$prid'";
    $run_query = mysqli_query($con,$sql);
  }

}

 ?>
