<?php

session_start();

unset($_SESSION["uid"]);
unset($_SESSION["C_qty"]);
unset($_SESSION["W_qty"]);

header("location:index.php");

?>
