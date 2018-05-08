<?php
session_start();
require_once('product.php');
require_once('productdb.php');
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
          <?php
            $id = $_GET['pl'];
            $p = new productdb;

            echo "	<img class='pageBanner' src='".$p->findCatagoryHeader($id)."' alt='New products'>
        				<h4><span>".$p->findCategoryName($id);
          ?>
      </span></h4>
			</section>
			<section class="main-content">

				<div class="row">
					<div class="span9">
						<ul class="thumbnails listing-products">
							<?php

              if (isset($_GET['pl'])) {
                $id = $_GET['pl'];
                $productList = new productdb;
                $arr = $productList->getProductbyCategory($id);
                $arr = array_reverse($arr);

                foreach ($arr as $a) {
                  $pid = $a["ProductID"];
                  $pname = $a["ProductName"];
                  $pprice = $a["ProductPrice"];
                  $pimage = $productList->getProductImage($pid);
                  $pimage = $pimage[0];
                  $pimage = $pimage["ProductImage"];
                echo "<li class='span3'>
                    <div class='product-box'>
                      <span class='sale_tag'></span>
                      <a href='product_detail.php?pid=$pid'><img alt='' src='$pimage'></a><br/>
                      <a href='product_detail.php?pid=$pid' class='title'>$pname</a><br/>
                      <p class='price'>$pprice BAHT</p>
                    </div>
                  </li>";
                }
              }

							 ?>
						</ul>
						<hr>
					</div>
					<div class="span3 col">
						<div class="block">
							<h4 class="title"><strong>Best</strong> Seller</h4>
							<ul class="small-product">
								<li>
									<a href="#" title="Praesent tempor sem sodales">
										<img src="themes/images/nendoroidImage/1.jpg" alt="Praesent tempor sem sodales">
									</a>
									<a href="#">Productname</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
		</div>
		<script src="themes/js/common.js"></script>
    </body>
</html>
