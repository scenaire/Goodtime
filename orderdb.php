<?php

class orderdb {

  public function newOrder(cart $cart) {
    include "db.php";

    $status = false;
    $allItem = $cart->getCart();

    $customer = mysqli_real_escape_string($con,$cart->getCustomerID());
    $total = 0;

    foreach ($allItem as $key) {
      $pid = $key['ProductID'];
      $qty = $key['Quantity'];
      $product = new product;
      $product->selectProduct($pid);
      $price = $product->getPrice()*$qty;
      $total += $price;
    }

      $vatprice = ($total*7)/100;
      $vatprice += $total;

    $sql = "INSERT INTO orders (username,TotalPrice,TotalNetPrice,Status,OrderDate)
    VALUES('$customer','$total','$vatprice','$status',NOW())";

    if ($con->query($sql)===true) {
      $this->addOrderProduct($cart->getCart(),$this->findLasttrx());

      if (isset($_SESSION['promotion'])) {
        $promotiondb = new promotiondb;
        $temp = $promotiondb->getPromotionfromID($_SESSION['promotion']);
        $id = $temp['PromotionID'];
        $discount = $temp['PromotionDiscount'];
        $type = $temp['PromotionType'];
        $trxID = $this->findLasttrx();

        if ($type == "fix") {
          $vatprice = $vatprice - $discount;
        } elseif ($type == "percent") {
          $vatprice = $vatprice * ((100-$discount)/100);
        }

        $sql = "UPDATE orders SET TotalNetPrice = '$vatprice', PromotionID = '$id' WHERE trxID = '$trxID'";
        if ($con->query($sql) === true) {
          unset($_SESSION['promotion']);
        } else {
          return "Error: ". $sql . "<br>" .$con->error;
        }

      }

      return "eee";
    }
    else {
      return "Error: ". $sql . "<br>" .$con->error;
    }

    $con->close();

  }

  public function getOrderbyTrxID($trxid) {
    include "db.php";
    $sql = "SELECT * FROM orders WHERE trxID = '$trxid'";
    $result = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($result)) {
      $arr[] = $data;
    }
    return $arr[0];
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

  public function findLasttrx() {
    require "db.php";
    $sql = "SELECT trxID FROM orders ORDER BY trxID DESC LIMIT 1";
    $run_query = mysqli_query($con,$sql);
    $ID = mysqli_fetch_array($run_query);
    return $ID[0];
  }

  public function getShipping($trxID) {
    require "db.php";
    $sql = "SELECT * FROM shipping WHERE trxID = '$trxID'";
    $run_query = mysqli_query($con,$sql);
    $ID = mysqli_fetch_array($run_query);
    return $ID;
  }

  public function setPaymentMethod($trxID,$value) {
    include "db.php";
    $value = mysqli_real_escape_string($con,$value);
    $sql = "UPDATE orders SET Payment = '$value' WHERE trxID = '$trxID'";
    $result = mysqli_query($con,$sql);
  }

  public function addNewShipping($trxID,$name,$address) {
    include "db.php";
    $status = false;
    $name = mysqli_real_escape_string($con,$name);
    $address = mysqli_real_escape_string($con,$address);
    $sql = "INSERT INTO shipping (trxID,ShippingStatus,Name,Address)
    VALUES('$trxID','$status','$name','$address')";
    $result = mysqli_query($con,$sql);
  }

  public function updateShippingStatus($trxID,$posttrack) {
    include "db.php";
    $status = true;
    $sql = "UPDATE shipping SET ShippingStatus = '$status',Posttrack = '$posttrack' WHERE trxID = '$trxID'";
    $result = mysqli_query($con,$sql);
  }

  public function updatePaymentStatus($trxID) {
    include "db.php";
    $status = true;
    $sql = "UPDATE orders SET Status = '$status',PaymentDate = NOW() WHERE trxID = '$trxID'";
    if ($con->query($sql)===true) {

    }
    else {
      echo "Error: ". $sql . "<br>" .$con->error;
    }
  }

  public function addOrderProduct($itemlist,$trxid) {
    include "db.php";
    foreach ($itemlist as $item) {
      $pid = $item['ProductID'];
      $qty = $item['Quantity'];
      $sql = "INSERT INTO ordersproduct (ProductID,Quantity,trxID)
      VALUES('$pid','$qty','$trxid')";
      if ($con->query($sql)===true) {

      }
      else {
        echo "Error: ". $sql . "<br>" .$con->error;
      }
    }
  }

  public function getAllSuccessPaymentOrder() {
    require "db.php";
    $status = true;
    $sql = "SELECT * FROM orders WHERE Status = '$status'";
    $run_query = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($run_query)) {
      $arr[] = $data;
    }
    return $arr;
  }

  public function getProductbyTrxID($trxid) {
    include "db.php";
    $sql = "SELECT ProductID,Quantity FROM ordersproduct WHERE trxID = '$trxid' ";
    $result = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($result)) {
      $arr[] = $data;
    }
    return $arr;
  }

}

 ?>
