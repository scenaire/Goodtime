<?php

Class order {

  private $cart;

  public function checkOut(cart $cart) {
    include "db.php";
    $this->cart = $cart;

    $customer = $cart->getCustomerID();
    $status = "Unsuccess";
    $status = mysqli_real_escape_string($con,$status);
    $allItem = $cart->getCart();

    for ($x=0;$x<count($allItem);$x++) {
      $product = $allItem[$x]['id'];
      $quan = $allItem[$x]['quantity'];
      $sql = "INSERT INTO orders (CustomerID,ProductID,Quantity,Status)
      VALUES('$customer','$product','$quan','$status')";
      if ($con->query($sql)===true) {
        echo "successfully";
      }
      else {
        echo "Error: ". $sql . "<br>" .$con->error;
      }

      echo "<br><br>";
    }

  }

}

 ?>
