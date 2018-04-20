<?php
session_start();
require_once('user.php');
require_once('userdb.php');

    $username = $_POST["user"];
    $password = $_POST["pass"];

    if($username==null || $password==null){
      header("location:register-false.php");
    } else {
      $user = new user;
      if ($user->login($username,$password)) {
        header("location:index.php");
      } else {
        header("location:register-false.php");
      }
    }

?>
