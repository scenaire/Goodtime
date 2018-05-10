<?php

session_start();
require_once('product.php');
require_once('productdb.php');
require_once('order.php');
require_once('orderdb.php');
require_once('shipping.php');

 ?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>GOODTIME</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->

		<!-- bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>

		<!-- global styles -->
		<link href="themes/css/main.css" rel="stylesheet"/>
		<link href="themes/css/jquery.fancybox.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="themes/js/superfish.js"></script>
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<script src="themes/js/jquery.fancybox.js"></script>
		<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4">
				<!--	<form method="POST" class="search_form">
						<input type="text" class="input-block-level search-query" Placeholder="eg. T-sirt">
					</form>-->
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">
              <?php
                if (isset($_SESSION['uid'])) {
                  if ($_SESSION['uid'] == "admin") {
                    echo "<b>Hey! ".$_SESSION['uid']."</b>
     							<li><a href='addProduct.php'>Add Product</a></li>
                  <li><a href='updatetrack.php'>อัพเดทแทรค</a></li>
                  <li><a href='promotion-site.php'>อัพเดทโปรโมชั่น</a></li>
     							<li><a href='logout.php'>Logout</a></li>";
                  }
                  else {
                    echo "<b>Hey! ".$_SESSION['uid']."</b>";
                    if ($_SESSION['W_qty'] > 0){
                      echo "<li><a href='wishlist-page.php'>Wishlist (".$_SESSION['W_qty'].")</a></li>";
                    }
                  if ($_SESSION['C_qty'] > 0){
                    echo "<li><a href='cart-site.php'>Your Cart (".$_SESSION['C_qty'].")</a></li>";
                  }
                  echo "<li><a href='order-profile.php'>ประวัติการสั่งซื้อ</a></li>";
                  echo "<li><a href='logout.php'>Logout</a></li>";
                  }
                } else {
                  echo "<li><a href='register.php'>Login</a></li>";
                }
                ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">
					<div class="goodtimelogo">
					<a href="index.php" class="logo pull-left">GOODTIME</a>
				</div>
					<nav id="menu" class="pull-right">
						<ul>
							<?php
							$productdb = new productdb;
							$list = $productdb->getAllCategory();

							foreach ($list as $val) {
								$key = $val['CategoryID'];
								$cat = $val['CategoryName'];
								echo "<li><a href='./product_list.php?pl=$key'>$cat</a></li>";
							}

							 ?>
						</ul>
					</nav>
				</div>
			</section>
			<section class="header_text sub">
			<img class="pageBanner" src="Product_image/nekopara.jpg" alt="New products" >
      <h4><span>ประวัติการสั่งซื้อ</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span9">
						<div class="row">
              <div class="span8">

                <?php
                $order = new order;
                $orderList = $order->getOrderbyUsername($_SESSION['uid']);
                $num = 1;

                $check = array();

                foreach ($orderList as $key) {
                  if (!$key['Status']) {
                    array_push($check,1);
                  }
                }

                if (!empty($check)) {
                  echo "

                  <h4 class='title'><span class='text'><strong>Waiting</strong> For Confirm</span></h4>

                  <table class='table table-striped'>
      							<thead>
      								<tr>
                        <th>   </th>
      									<th>Order No.</th>
      									<th>TotalPrice</th>
      									<th>Net Price</th>
      									<th>Status</th>
                        <th>แจ้งชำระเงิน</th>
      								</tr>
      							</thead>";
                }

                unset($check);

                foreach ($orderList as $key) {
                  if (!$key['Status']) {
                    echo "<tr>";

                    $trxID = $key['trxID'];
                    $total = $key['TotalPrice'];
                    $net = $key['TotalNetPrice'];
                    $date = $key['OrderDate'];

                    echo "<td>$num</td>
                    <td><a href='checkout-history.php?trx=$trxID'>หมายเลขใบสั่งซื้อที่ ".$trxID."</a></td>
                    <td>$total</td>
                    <td>$net</td>
                    <td>รอการแจ้งชำระเงิน</td>
                    <td><form class='form-inline' action='cart-process.php?trx=".$trxID."' method='POST'>
                      <button class='btn' name='confirmpayment' type='submit'>แจ้งชำระเงิน</button></form></td>
                    </tr>";

                    $num += 1;

                  }
                }

              echo "</tbody></table>";


              $checkShiping = array();
              $checkSuccess = array();

              foreach ($orderList as $key) {
                if ($key['Status']) {
                  $ship = new shipping($key['trxID']);
                  if ($ship->getStatus()) {
                    array_push($checkSuccess,$key);
                  } else {
                    array_push($checkShiping,$key);
                  }
                }
              }

              if (!empty($checkShiping)) {
                echo "
                <h4 class='title'><span class='text'><strong>Waiting</strong> For Shipping</span></h4>

                <table class='table table-striped'>
                 <thead>
                   <tr>
                      <th>   </th>
                     <th>Order No.</th>
                     <th>TotalPrice</th>
                     <th>Net Price</th>
                     <th>Status</th>
                   </tr>
                 </thead>";
              }

                 $num = 1;

                 foreach ($checkShiping as $key) {
                     echo "<tr>";

                     $trxID = $key['trxID'];
                     $total = $key['TotalPrice'];
                     $net = $key['TotalNetPrice'];
                     $date = $key['OrderDate'];

                     echo "<td>$num</td>
                     <td><a href='checkout.php?trx=$trxID'>หมายเลขใบสั่งซื้อที่ ".$trxID."</a></td>
                     <td>$total</td>
                     <td>$net</td>
                     <td>ชำระเงินเรียบร้อย</td>
                     </tr>";

                     $num += 1;
                 }

                   echo "</tbody></table>";

                   if (!empty($checkSuccess)) {
                     echo "
                     <h4 class='title'><span class='text'><strong>Already</strong> Success</span></h4>

                     <table class='table table-striped'>
                      <thead>
                        <tr>
                           <th>   </th>
                          <th>Order No.</th>
                          <th>TotalPrice</th>
                          <th>Net Price</th>
                          <th>Status</th>
                          <th>Track ID.</th>
                        </tr>
                      </thead>";
                   }

                      $num = 1;

                      foreach ($checkSuccess as $key) {
                          echo "<tr>";

                          $trxID = $key['trxID'];
                          $total = $key['TotalPrice'];
                          $net = $key['TotalNetPrice'];
                          $date = $key['OrderDate'];

                          $shipping = new shipping($trxID);
                          $post = $shipping->getPosttrack();

                          echo "<td>$num</td>
                          <td><a href='checkout.php?trx=$trxID'>หมายเลขใบสั่งซื้อที่ ".$trxID."</a></td>
                          <td>$total</td>
                          <td>$net</td>
                          <td>ทำการส่งสินค้าเรียบร้อย</td>
                          <td>$post</td>
                          </tr>";

                          $num += 1;
                      }

                        echo "</tbody></table>";

                  ?>

                  <br><br><br>

              </div>
              </div>
						</div>
						</div>
					</div>
				</div>
			</section>
		</div>
    </body>
</html>
