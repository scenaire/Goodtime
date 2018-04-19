<?php

$servername = "localhost";
$serverusername = "root";
$serverpassword = "";
$db = "goodtime";

// Create connection
$con = mysqli_connect($servername, $serverusername, $serverpassword,$db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
  mysqli_set_charset($con,"utf8");
}



?>
