<?php
session_start();
require_once('productdb.php');

if(isset($_SESSION["uid"])){
	header("location:profile.php");
}

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
				<!--<form method="POST" class="search_form">
						<input type="text" class="input-block-level search-query" Placeholder="eg. T-sirt">
					</form>-->
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">
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
			<section  class="homepage-slider" id="home-slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<img src="themes/images/carousel/totoro.jpg" alt="" />
						</li>
						<li>
							<img src="themes/images/carousel/girl.jpg" alt="" />
						</li>
					</ul>
				</div>
			</section>
			<section class="header_text">
			○	GOODTIME TOGETHER ○
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span12">
						<div class="row">
							<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line"><strong>Products</strong></span></span></span>
									<span class="pull-right">
										<a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel" class="myCarousel carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails">

												<?php
														$productList = new productdb;
														$arr = $productList->getAllProduct();
														$arr2 = $productList->custom_shuffle($arr);
														$arr3 = $productList->slice_ar($arr2,0,4);

														foreach ($arr3 as $a) {
															$pid = $a["ProductID"];
															$pname = $a["ProductName"];
															$pprice = $a["ProductPrice"];
															$category = $a["ProductCategoryID"];
															$pcategory = $productList->findCategoryName($category);
															$pimage = $productList->getProductImage($pid);
															$pimage = $pimage[0];
															$pimage = $pimage["ProductImage"];

															echo "<li class='span3'>
																<div class='product-box'>
																	<span class='sale_tag'></span>
																	<p><a href='product_detail.php?pid=$pid'><img src='$pimage'></a></p>
																	<a href='product_detail.php?=$pid' class='title'>".$pname."</a><br/>
																	<a href='product_list.php?pl=$category'class='category'>".$pcategory."</a>
																	<p class='price'>".$pprice." BAHT</p>
																</div>
															</li>";
														}
													echo "	</ul></div><div class='item'><ul class='thumbnails'>";

													$arr3 = $productList->slice_ar($arr2,4,8);

													foreach ($arr3 as $a) {
														$pid = $a["ProductID"];
														$pname = $a["ProductName"];
														$pprice = $a["ProductPrice"];
														$category = $a["ProductCategoryID"];
														$pcategory = $productList->findCategoryName($category);
														$pimage = $productList->getProductImage($pid);
														$pimage = $pimage[0];
														$pimage = $pimage["ProductImage"];

														switch ($category) {
															case 1:
																$link = "miniatureList.php";
																break;
																case 2:
																	$link = "nendoroidList.php";
																	break;
																	case 3:
																		$link = "funkoList.php";
																		break;
																		default: $link = "product_detail.php";
														}

														echo "<li class='span3'>
															<div class='product-box'>
																<span class='sale_tag'></span>
																<p><a href='product_detail.php?pid=$pid'><img src='$pimage'></a></p>
																<a href='product_detail.php?=$pid' class='title'>".$pname."</a><br/>
																<a href=$link class='category'>".$pcategory."</a>
																<p class='price'>".$pprice." BAHT</p>
															</div>
														</li>";
													}
												 ?>

											</ul>
										</div>
									</div>
								</div>
							</div>

						</div>
						<br/>
					</div>
				</div>
			</section>

		</div>
		<script src="themes/js/common.js"></script>
		<script src="themes/js/jquery.flexslider-min.js"></script>
		<script type="text/javascript">
			$(function() {
				$(document).ready(function() {
					$('.flexslider').flexslider({
						animation: "fade",
						slideshowSpeed: 4000,
						animationSpeed: 600,
						controlNav: false,
						directionNav: true,
						controlsContainer: ".flex-container" // the container that holds the flexslider
					});
				});
			});
		</script>
    </body>
</html>
