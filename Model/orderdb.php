<?php

class orderdb {

  public function newOrder(cart $cart) {
    include "db.php";
    $this->cart = $cart;

    $customer = $cart->getCustomerID();
    $status = "Unsuccess";
    $status = mysqli_real_escape_string($con,$status);
    $allItem = $cart->getCart();

    $sql = "SELECT OrderID FROM orders ORDER BY OrderID DESC LIMIT 1";
    $run_query = mysqli_query($con,$sql);
    $result = mysqli_fetch_array($run_query);
    $result = $result[0]+1;
    $trxid = "$result".''."$customer";

    for ($x=0;$x<count($allItem);$x++) {
      $product = $allItem[$x]['id'];
      $quan = $allItem[$x]['quantity'];
      $sql = "INSERT INTO orders (username,ProductID,Quantity,Status,trxID)
      VALUES('$customer','$product','$quan','$status','$trxid')";
      if ($con->query($sql)===true) {
        echo "successfully";
      }
      else {
        echo "Error: ". $sql . "<br>" .$con->error;
      }

      echo "<br><br>";
    }

  }

  public function getOrderbyTrxID($trxid) {
    include "db.php";
    $sql = "SELECT * FROM orders WHERE trxID = '$trxid'";
    $result = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($result)) {
      $arr[] = $data;
    }
    return $arr;
  }

  public function getOrderbyUsername($customer) {
    include "db.php";
    $sql = "SELECT * FROM orders WHERE username = '$customer'";
    $result = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($result)) {
      $arr[] = $data;
    }
    return $arr;
  }

}

 ?>
