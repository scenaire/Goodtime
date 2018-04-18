<?php

public function register($username,$password,$address1,$address2,$email,$UFname,$ULname) {
  require "db.php";

  $sql = "INSERT INTO customer (CustFname,CustLName,CustAddress1,CustAddress2,CustEmail,username,password)
  VALUES('$UFname','$ULname','$address1','$address2','$email','$username','$password')";

  if ($con->query($sql)===true) {
    echo "successfully";
  }
  else {
    echo "Error: ". $sql . "<br>" .$con->error;
  }

  $con->close();
}

public function getCustomer() {
  require "db.php";
  $sql = "SELECT * FROM customer";
  $run_query = mysqli_query($con,$sql);
  $arr = array();
  while ($data = mysqli_fetch_array($run_query)) {
    $arr[] = $data;
  }

  return $arr;
}

public function findIDbyUsername($username) {
  require "db.php";
  $sql = "SELECT CustomerID FROM customer WHERE username = '$username'";
  $run_query = mysqli_query($con,$sql);
  $ID = mysqli_fetch_array($run_query);
  return $ID[0];
}

 ?>
