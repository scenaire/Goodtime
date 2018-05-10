<?php
session_start();
require_once('product.php');
require_once('productdb.php');
require_once('order.php');
require_once('orderdb.php');
require_once('user.php');
require_once('userdb.php');
require_once('promotiondb.php');
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
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="themes/js/superfish.js"></script>
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="themes/js/respond.min.js"></script>
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
                  <li><a href='sendmail.php'>ส่งอีเมล์</a></li>
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
				<h4><span>Checkout</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span10">
            <div class="span8">

              <h4> หมายเลขใบสั่งซื้อที่ # <?php echo $_GET['trx']; ?> </h4><br><br>

						<h4 class="title"><span class="text"><strong>Your</strong> Cart</span></h4>
						<table class="table table-striped">
							<thead>
								<tr>
                  <th>  </th>
									<th>Image</th>
									<th>Product Name</th>
									<th>Quantity</th>
									<th>Unit Price</th>
                  <th>Total Price</th>
								</tr>
							</thead>
							<tbody>
                  <?php

                  $order = new order;
                  $trx = isset($_GET['trx']) ? $_GET['trx'] : '';
                  $order->getOrderbyTrxID($trx);
                  $promotion = $order->getPromotion();
                  $num = 0;

                  foreach ($order->getProduct() as $key) {
                    echo "<tr>";
                    $product = new product();
                    $product->selectProduct($key['ProductID']);
                    $pid = $product->getID();
                    $pimg = $product->getImage();
                    $pimg = $pimg[0];
                    $pimg = $pimg['ProductImage'];
                    $pname = $product->getName();
                    $pprice = $product->getPrice();
                    $qty = $key['Quantity'];
                    $ttl = $qty*$pprice;

                    $num += 1;

                    echo "<td>$num</td>
                    <td><a href='product_detail.php?pid=$pid'><img style='max-height:100px; width:auto;' src='$pimg'></a></td>
                    <td>$pname</td>
                    <td>$qty</td>

                    <td>$pprice THB</td>
                    <td>$ttl THB</td>
                    </tr>";
                  }

                  $total = $order->getPrice();
                  $vat = ($total*7)/100;
                  $net = $order->getNetPrice();



                  if(!empty($promotion)) {
                    $promotiondb = new promotiondb;
                    $pr = $promotiondb->getPromotionfromID($promotion);
                    $type = $pr['PromotionType'];
                    $discount = $pr['PromotionDiscount'];
                    if ($type == "fix") {
                      $pd = $discount;
                    } elseif ($type == "percent") {
                      $pd = $total * ($discount/100);
                    }
                  } else {
                    $pd = 0;
                  }

                  echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
                  echo "<td><h5><strong>$total THB</strong></h5></td>";



                echo "</tbody>
                </table>

                <hr>
                <p class='cart-total left'>
                <strong>Sub-Total</strong>:	$total THB<br>
                <strong>VAT (7%)</strong>: $vat THB<br>
                <strong>Promotion Discount</strong>: $pd THB<br>
                <strong>Total</strong>: $net THB<br></p><hr/>";

                ?>
            </div>
					</div>
          <div class="span10">
            <div class="span8">
						<h4 class="title"><span class="text"><strong>Your</strong> Address</span></h4>

            <?php

            $trx = isset($_GET['trx']) ? $_GET['trx'] : '';
            echo "<form method='POST' action='cart-process.php?trx=$trx'>";
           ?>

            <div class="control-group">
              <label class="control-label">Name:</label>
              <div class="controls">
                <?php
                $user = new user;
                $user->selectUser($_SESSION['uid']);
                $first = $user->getFName()." ".$user->getLname();
                echo "<input type='text' value='$first' name='name' class='input-xlarge'>";
                ?>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Address:</label>
              <div class="controls">
                <?php
                $user = new user;
                $user->selectUser($_SESSION['uid']);
                $address = $user->getAddress();
                echo "<textarea name='address' style='height:100px; width:350px;' rows='5' cols='69'>".$address."</textarea>";
                ?>
                <br><br>
              </div>
            </div>


            <h4 class="title"><span class="text"><strong>Payment</strong> method</span></h4>

            <h5>Option</h5>

            <h5>
            <input type="radio" name="payment" value="paypal"> Paypal &nbsp;&nbsp;
            <input type="radio" name="payment" value="credit"> Credit-Card &nbsp;&nbsp;
            <input type="radio" name="payment" value="bank"> โอนผ่านธนาคาร &nbsp;&nbsp;
            <br><br>
          </h5>

          <br>

          <input tabindex="9" name="checkoutwithshipping" class="btn btn-inverse large" type="submit" value="Save">

          <br><br>

        </form>

          </div>
					</div>
				</div>
			</section>

		</div>
    </body>
</html>
