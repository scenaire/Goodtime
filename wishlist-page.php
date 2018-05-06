<?php
session_start();
require_once('product.php');
require_once('productdb.php');
require_once('wishlist.php');
require_once('wishlistdb.php');
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
                if ($_SESSION['uid'] == "admin") {
                  echo "<b>Hey! ".$_SESSION['uid']."</b>
   							<li><a href='addProduct.php'>Add Product</a></li>
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
                echo "<li><a href='logout.php'>Logout</a></li>";
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
				<h4><span>WISHLIST</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span10">
						<h4 class="title"><span class="text"><strong>Your</strong> Wishlist</span></h4>
						<table class="table table-striped">
							<thead>
								<tr>
                  <th>  </th>
									<th>Image</th>
									<th>Product Name</th>
									<th>Unit Price</th>
                  <th>  </th>
                  <th>  </th>
								</tr>
							</thead>
							<tbody>

                  <?php

                    $wishlist = new wishlist($_SESSION['uid']);
                    $num = 0;

                    foreach ($wishlist->getWishlist() as $key) {
                      echo "<tr>";
                      $product = new product();
                      $product->selectProduct($key['ProductID']);
                      $pid = $product->getID();
                      $pimg = $product->getImage();
                      $pimg = $pimg[0];
                      $pimg = $pimg['ProductImage'];
                      $pname = $product->getName();
                      $pprice = $product->getPrice();

                      $num += 1;

                      echo "<td>$num</td>
                      <td><a href='product_detail.php?pid=$pid'><img style='max-height:100px; width:auto;' src='$pimg'></a></td>
                      <td><a href='product_detail.php?pid=$pid'>$pname</a></td>

                      <td>$pprice THB</td>
                      <td><form class='form-inline' action='cart-process.php?pid=".$pid."' method='POST'>
                        <button class='btn' name='addtocart' type='submit'>Add this product to cart</button></form></td>

                        <td><form class='form-inline' action='cart-process.php?pid=".$pid."' method='POST'>
                          <button class='btn' name='removewishlist' type='submit'>Remove</button></form></td>

                      </tr>";
                    }

                    echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";

							echo "</tbody>
						</table>

						<hr>";


              ?>
						</p>
					</div>
				</div>
			</section>

		</div>
    </body>
</html>
