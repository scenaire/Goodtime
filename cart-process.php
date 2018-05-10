<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

  session_start();
  require_once('product.php');
  require_once('productdb.php');
  require_once('cart.php');
  require_once('cartdb.php');
  require_once('order.php');
  require_once('orderdb.php');
  require_once('wishlist.php');
  require_once('wishlistdb.php');
  require_once('shipping.php');
  require_once('promotiondb.php');
  require_once('userdb.php');
  require_once('user.php');
  require_once('slip.php');

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

  } elseif (isset($_POST["updatecoupon"])) {
    if (isset($_POST['coupon'])) {
      $promotiondb = new promotiondb;
      $promotion = $promotiondb->getPromotionfromCode($_POST['coupon']);
      if (!empty($promotion)) {
        $code = $_POST['coupon'];
        $promotion = $promotion[0];
        $product = new product;
        $cart = new cart($_SESSION['uid']);
        $total = 0;

        foreach ($cart->getCart() as $key) {
          $product->selectProduct($key['ProductID']);
          $eachprice = $product->getPrice();
          $eachprice = $eachprice * $key['Quantity'];
          $total += $eachprice;
        }

        if (isset($promotion['PromotionCondition'])) {
          if ($total >= $promotion['PromotionCondition']) {
            header("location:cart-site.php?promotion=$code");
          }
          else {
            header("location:cart-site.php");
          }
        } else {
          header("location:cart-site.php?promotion=$code");
        }
      } else {
        header("location:cart-site.php");
      }
    }
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
      header("location:cart-site.php");
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

  } elseif (isset($_POST["checkout"])) {
    $order = new order;
    $cart = new cart($_SESSION['uid']);
    $order->newOrder($cart);
    $trx = $order->getTrxID();

    foreach ($cart->getCart() as $key) {
      $qty = $key['Quantity'];
      $pid = $key['ProductID'];
      $product = new product;
      $product->selectProduct($pid);
      $product->setStock($product->getStock()-$qty);
    }

    $cart->removeAllItem();
    $cart->updatecart();
    $_SESSION['C_qty'] = count($cart->getCart());

    header("location:checkout.php?trx=$trx");

  } elseif (isset($_POST["checkoutwithshipping"])) {
    $trx = isset($_GET['trx']) ? $_GET['trx'] : '';
    if (empty($_POST['payment']) || empty($_POST['name']) || empty($_POST['address'])) {
      header("location:checkout.php?trx=$trx");
    } else {
      $order = new order;
      $order->getOrderbyTrxID($trx);
      $order->setPaymentMethod($_POST['payment']);
      $shipping = new shipping($trx);
      $shipping->addNewShipping($_POST['name'],$_POST['address']);
      header("location:order-profile.php");
    }

  } elseif (isset($_POST['confirmpayment'])) {

    $order = new order;
    $trx = isset($_GET['trx']) ? $_GET['trx'] : '';
    $order->getOrderbyTrxID($trx);
    $order->updatePaymentStatus();

    $user = new user;
    $user->selectUser($order->getCustomer());

    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);
    $mail->setFrom('tempesta-psyzeoul@hotmail.com', 'Erianecs');
    $mail->addAddress($user->getEmail(), $user->getUsername());

    $slip = new slip($trx);

    $mail->Subject  = "ใบเสร็จรับเงินหมายเลขใบสั่งซื้อที่# ".$order->getTrxID();
    $mail->Body     = $slip->getBody();

    if(!$mail->send()) {
      echo 'Message was not sent.';
      echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
      header("location:order-profile.php");
    }

  } elseif (isset($_POST['updatetrack'])) {

    $orderdb = new orderdb;
    $orderList = $orderdb->getAllSuccessPaymentOrder();

    $arr = array();

    foreach ($orderList as $key) {
        $ship = new shipping($key['trxID']);
        if (!$ship->getStatus()) {
          array_push($arr,$key);
        }
    }


    for ($i = 0; $i<count($arr); $i++) {
      $temp = $arr[$i];
      $key = $_POST['track'][$i];
      print_r($temp);
      echo "<br>";
      echo $key."<br><br>";
      $ship = new shipping($temp['trxID']);
      if (!empty($key)) {
        $ship->updateShippingStatus($key);
      }
      header("location:updatetrack.php");
    }
  } elseif (isset($_POST['newPromotion'])) {
      $promotiondb = new promotiondb;
      $name = $_POST['prName'];
      $code = $_POST['prCode'];
      $type = $_POST['prGroup'];
      $condition = $_POST['prCondition'];
      $discount = $_POST['prDiscount'];
      $promotiondb->addPromotion($name,$discount,$code,$type,$condition);
      header("location:promotion-site.php");
  } elseif (isset($_POST['removepromotion'])) {
    $promotiondb = new promotiondb;
    $prid = isset($_GET['prid']) ? $_GET['prid'] : '';
    $promotiondb->removePromotion($prid);
    header("location:promotion-site.php");
  } elseif (isset($_POST['newmail'])) {

    $userdb = new userdb;
    $allcustomer = $userdb->getAllCustomer();

    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);
    $mail->setFrom('tempesta-psyzeoul@hotmail.com', 'Erianecs');
    $mail->Subject  = $_POST['eName'];
    $mail->Body     = $_POST['eBody'];

    foreach ($allcustomer as $customer) {
      if ($customer['sendpromotion']) {
        $Cmail = $customer['CustEmail'];
        $Cname = $customer['username'];
        $mail->clearAddresses();
        $mail->addAddress($Cmail, $Cname);
        if(!$mail->send()) {
          echo 'Message was not sent.';
          echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
          header("location:sendmail.php");
        }
      }
    }



  }



 ?>
