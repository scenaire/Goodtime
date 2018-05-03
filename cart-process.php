<?php

  session_start();
  require_once('cart.php');
  require_once('cartdb.php');

  $qty = $_POST["quantity"];
  $pid = isset($_GET['pid']) ? $_GET['pid'] : '';

  if ($qty != 0) {
    $uid = $_SESSION['uid'];

    $cart = new cart($uid);
    $key = array_search($pid,array_column($cart->getCart(),'ProductID'));

    if ($key === false) {
      $cart->addItem($pid,$qty);
      $_SESSION['C_qty'] += 1;
    } else {
      $arr = $cart->getCart();
      $arr = $arr[$key];
      $arr = $arr['Quantity'];
      $qty += $arr;
      $cart->updateItem($pid,$qty);
    }

  }

  header("location:product_detail.php?pid=".$pid);

 ?>
