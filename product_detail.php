<?php
session_start();
require_once('product.php');
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
							<li><a href="cart.html">Your Cart</a></li>
							<li><a href="checkout.html">Checkout</a></li>
							<li><a href="register.php">Login</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">
					<div class="goodtimelogo">
					<a href="index.html" class="logo pull-left">GOODTIME</a>
				</div>
					<nav id="menu" class="pull-right">
						<ul>
							<li><a href="./miniatureList.html">MINIATURE HOUSE</a></li>
							<li><a href="./nendoroidList.php">NENDOROID</a></li>
							<li><a href="./funkoList.html">FUNKO</a>	</li>
						</ul>
					</nav>
				</div>
			</section>
			<section class="header_text sub">
				<?php $pid = $_GET['pid'];
				$product = new product;
				$product->selectProduct($pid);
				if ($product->getCategory()==2) {
					$imgbanner = "themes/images/nendoroidImage/0.jpg";
				}
				echo	"<img class='pageBanner' src='$imgbanner' alt='New products' >
				<h4><span>".$product->getName()."</span></h4>"?>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span9">
						<div class="row">
							<div class="span4">
								<?php
								$pid = $_GET['pid'];
								$product = new product;
								$product->selectProduct($pid);
								$img1 = $product->getImage();
								$img1 = $img1[0];
								$img1 = $img1['ProductImage'];
								echo "<a href=$img1 class='thumbnail' data-fancybox-group='group1' ><img alt='' src='$img1'></a>";
								echo "<ul class='thumbnails small'>";
								$imgall = $product->getImage();
								unset($imgall[0]);
								foreach ($imgall as $img) {
									$img = $img['ProductImage'];
									echo "<li class='span1'> <a href='$img' class='thumbnail' data-fancybox-group='group1' > <img src='$img' ></a></li>";
								}
								 ?>

								</ul>
							</div>
							<div class="span5">
								<form class="form-inline">
									<label><strong><font size="4">Quantity:&nbsp&nbsp</strong></font></label>
									<input type="text" class="span1" placeholder="1">
									&nbsp&nbsp<button class="btn btn-inverse" type="submit">Add to cart</button>
								</form>
								<address>
									<?php
									$pid = $_GET['pid'];
									$product = new product;
									$product->selectProduct($pid);
									 echo "<strong><font size='4'>Availability: </strong><br>".$product->getStock()."<br><br><strong>Price: </strong><br>".$product->getPrice()." BAHT
									 <br><br><strong>Description: </strong></font><br><br><font size='3'>".$product->getDecs()."</font>";
									?>
								</address>
							</div>
						</div>
					</div>
				</div>
			</section>

		</div>
		<script src="themes/js/common.js"></script>
		<script>
			$(function () {
				$('#myTab a:first').tab('show');
				$('#myTab a').click(function (e) {
					e.preventDefault();
					$(this).tab('show');
				})
			})
			$(document).ready(function() {
				$('.thumbnail').fancybox({
					openEffect  : 'none',
					closeEffect : 'none'
				});

				$('#myCarousel-2').carousel({
                    interval: 2500
                });
			});
		</script>
    </body>
</html>
