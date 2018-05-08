<?php

  session_start();
  require_once('product.php');
  require_once('productdb.php');
  require_once('cart.php');
  require_once('cartdb.php');
  require_once('order.php');
  require_once('orderdb.php');
  require_once('wishlist.php');
  require_once('wishlistdb.php');

  if (isset($_POST["addcart"])) {
    $qty = $_POST["quantity"];
    $pid = isset($_GET['pid']) ? $_GET['pid'] : '';

    if ($qty != 0) {

      $product = new product;
      $product->selectProduct($pid);

      if ($qty > $product->getStock()) {
        echo "<script type='text/javascript'>alert('ไม่สามารถเพิ่มสินค้าได้');</script>";
        echo "<script type='text/javascript'> window.location = 'product_detail.php?pid=$pid'</script>";

      } else {

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
      header("location:cart-site.php");
    } else {
      header("location:product_detail.php?pid=$pid");
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
  } elseif (isset($_POST["updatecart"])) {
    $cart = new cart($_SESSION['uid']);
    $temp = $cart->getCart();
    $product = new product;
    $check = true;

    for ($i = 0; $i<count($temp); $i++) {
      $key = $_POST['quantity'][$i];
      if ($key == 0) {
        $temp2 = $temp[$i];
        $cart->removeItem($temp2['ProductID']);
      }
      elseif ($key > 0) {
        $temp2 = $temp[$i];
        $product->selectProduct($temp2['ProductID']);
        if ($key > $product->getStock()) {
          $check = false;
        }
        else {
          $cart->updateItem($temp2['ProductID'],$key);
        }
      }
    }

    if (isset($_POST['checkremove'])) {
      foreach ($_POST['checkremove'] as $key) {
        $cart->removeItem($key);
      }
    }

    $cart->updatecart();
    $_SESSION['C_qty'] = count($cart->getCart());

    if ($check == false) {
      echo "<script type='text/javascript'>alert('ไม่สามารถเพิ่มสินค้าได้ กรุณาตรวจสอบจำนวนสินค้า');</script>";
      echo "<script type='text/javascript'> window.location = 'cart-site.php'</script>";
    }

  } elseif (isset($_POST["addtocart"])) {
    $cart = new cart($_SESSION['uid']);
    $wishlist = new wishlist($_SESSION['uid']);
    $pid = isset($_GET['pid']) ? $_GET['pid'] : '';

    $key = array_search($pid,array_column($cart->getCart(),'ProductID'));

    if ($key === false) {
      $cart->addItem($pid,1);
      $wishlist->removeItem($pid);
      $cart->updatecart();
      $wishlist->updateWishlist();
      $_SESSION['C_qty'] = count($cart->getCart());
      $_SESSION['W_qty'] = count($wishlist->getWishlist());
    }

    header("location:cart-site.php");

  } elseif (isset($_POST["removewishlist"])) {
    $wishlist = new wishlist($_SESSION['uid']);
    $pid = isset($_GET['pid']) ? $_GET['pid'] : '';
    $wishlist->removeItem($pid);
    $wishlist->updateWishlist();
    $_SESSION['W_qty'] = count($wishlist->getWishlist());

    header("location:wishlist-page.php");

  }



 ?>
