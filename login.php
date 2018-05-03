<?php
session_start();
require_once('user.php');
require_once('userdb.php');
require_once('cart.php');
require_once('cartdb.php');

    $username = $_POST["user"];
    $password = $_POST["pass"];

    if($username==null || $password==null){
      header("location:register-false.php");
    } else {
      $user = new user;
      if ($user->login($username,$password)) {
        $_SESSION['uid'] = $username;
        $cart = new cart($_SESSION['uid']);
        $_SESSION['C_qty'] = $cart->getCartCount();
        header("location:profile.php");
      } else {
        header("location:register-false.php");
      }
    }

?>
