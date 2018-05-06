<?php

  session_start();
  require_once('cart.php');
  require_once('cartdb.php');
  require_once('order.php');
  require_once('orderdb.php');
  require_once('wishlist.php');
  require_once('wishlistdb.php');

  if (isset($_POST["add"])) {
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

      header("location:cart-site.php");

    }
  } else if (isset($_POST["checkout"])) {
    $cart = new cart($_SESSION['uid']);
    $order = new order();
    $order->newOrder($cart);

    $cart->removeAllItem();
    $_SESSION['C_qty'] = 0;

    header("location:profile.php");

  } elseif (isset($_POST["updatecoupon"])) {
    header("location:cart-site.php");
  } elseif (isset($_POST["addwishlist"])) {
    $pid = isset($_GET['pid']) ? $_GET['pid'] : '';
    $uid = $_SESSION['uid'];
    $wishlist = new wishlist($uid);
    $key = $wishlist->checkItem($pid);
    if ($key === false) {
      $wishlist->addItem($pid);
      $_SESSION['W_qty'] += 1;
    }
    header("location:wishlist-page.php");
  }



 ?>
