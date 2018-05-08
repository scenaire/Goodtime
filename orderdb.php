<?php

class orderdb {

  public function newOrder(cart $cart) {
    include "db.php";
    $this->cart = $cart;

    $customer = $cart->getCustomerID();
    $status = false;
    $allItem = $cart->getCart();

    $sql = "SELECT trxID FROM orders ORDER BY OrderID DESC LIMIT 1";
    $run_query = mysqli_query($con,$sql);
    $result = mysqli_fetch_array($run_query);
    $result = $result[0]+1;
    $trxid = "$result";

    foreach ($allItem as $key) {

      $product = $key['ProductID'];
      $quan = $key['Quantity'];
      $sql = "INSERT INTO orders (username,ProductID,Quantity,Status,trxID,OrderDate)
      VALUES('$customer','$product','$quan','$status','$trxid',NOW())";

      if ($con->query($sql)===true) {
        echo "successfully";
      }
      else {
        echo "Error: ". $sql . "<br>" .$con->error;
      }

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
