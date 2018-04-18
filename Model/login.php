<<?php

class login {

  private $CUsername,$CPassword;

  public function check_login($CUsername,$CPassword) {
    include "db.php";

    $CUsername = mysqli_real_escape_string($con,$CUsername);
    $CPassword = mysqli_real_escape_string($con,$CPassword);

    $sql = "SELECT * FROM customer WHERE username = '$CUsername' AND password = '$CPassword'";
    $run_query = mysqli_query($con,$sql);
    $count = mysqli_num_rows($run_query);

    if ($count==1) {
      echo "successfully";
      return true;
    } else {
      return false;
    }
  }

}

 ?>
