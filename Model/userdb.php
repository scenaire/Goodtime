<?php

class userdb {

  public function register(user $user) {
    require "db.php";

    $UFname = $user->getFName();
    $ULname = $user->getLname();
    $address = $user->getAddress();
    $email = $user->getEmail();
    $username = $user->getUsername();
    $password = $user->getPassword();

    $sql = "INSERT INTO users (CustFname,CustLName,CustAddress,CustEmail,username,password)
    VALUES('$UFname','$ULname','$address','$email','$username','$password')";

    if ($con->query($sql)===true) {
      echo "successfully";
    }
    else {
      echo "Error: ". $sql . "<br>" .$con->error;
    }

    $con->close();
  }

  public function check_login($CUsername,$CPassword) {
    include "db.php";

    $CUsername = mysqli_real_escape_string($con,$CUsername);
    $CPassword = mysqli_real_escape_string($con,$CPassword);

    $sql = "SELECT * FROM users WHERE username = '$CUsername' AND password = '$CPassword'";
    $run_query = mysqli_query($con,$sql);
    $result = mysqli_fetch_array($run_query);
    if (!$result) {
       printf("Error: %s\n", mysqli_error($con));
       return false;
    } else {
      return true;
    }
  }

  public function getAllCustomer() {
    require "db.php";
    $sql = "SELECT * FROM users";
    $run_query = mysqli_query($con,$sql);
    $arr = array();
    while ($data = mysqli_fetch_array($run_query)) {
      $arr[] = $data;
    }
    return $arr;
  }

  public function getCustomer($username) {
    require "db.php";
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $run_query = mysqli_query($con,$sql);
    $ID = mysqli_fetch_array($run_query);
    return $ID;
  }

}

 ?>
