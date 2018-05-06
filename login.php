<?php
session_start();
require_once('user.php');
require_once('userdb.php');
require_once('cart.php');
require_once('cartdb.php');
require_once('wishlist.php');
require_once('wishlistdb.php');

unset($_SESSION['messageL']);
unset($_SESSION['messageR']);
unset($_SESSION['messageRC']);

  if (isset($_POST["login"])) {
    $username = $_POST["user"];
    $password = $_POST["pass"];

    if($username==null || $password==null){
      $_SESSION['messageL'] = "Please input all box";
      header("location:register-false.php");
    } else {
      $user = new user;
      if ($user->login($username,$password)) {
        $_SESSION['uid'] = $username;
        $cart = new cart($_SESSION['uid']);
        $_SESSION['C_qty'] = $cart->getCartCount();
        $wishlist = new wishlist($_SESSION['uid']);
        $_SESSION['W_qty'] = $wishlist->getWishlistCount();
        unset($_SESSION['messageL']);
        header("location:profile.php");
      } else {
        $_SESSION['messageL'] = "Username and Password doesn't match";
        header("location:register-false.php");
      }
    }
  } elseif (isset($_POST["register"])) {

    if (isset($_POST["name"])) {
      $f_name = $_POST["name"];
    	$l_name = $_POST["lastname"];
    	$email = $_POST['email'];
      $username = $_POST['username'];
    	$password = $_POST['password'];
      $repassword = $_POST['repassword'];
    	$address = $_POST['address'];

      if (isset($_POST['sendletter'])) {
        $letter = TRUE;
      } else {
        $letter = FALSE;
      }

    	$name = "/^[a-zA-Z ]+$/";

      if(empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($username) || empty($address)) {
        $_SESSION['messageR'] = "Please input all box";
        header("location:register-false.php");
      } elseif ($password != $repassword){
        $_SESSION['messageR'] = "Password doesn't match";
        header("location:register-false.php");
      } else {
        $user = new user;
        $_SESSION['messageRC'] = $user->register($username,$password,$f_name,$l_name,$address,$email,$letter);
        header("location:register-false.php");
      }

    }
  }

?>
