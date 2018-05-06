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
				<?php $pid = $_GET['pid'];
				$product = new product;
				$product->selectProduct($pid);
        $db = new productdb;
        $imgbanner = $db->findCatagoryHeader($product->getCategory());

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
								if (!empty($imgall)){
                  foreach ($imgall as $img) {
  									$img = $img['ProductImage'];
  									echo "<li class='span1'> <a href='$img' class='thumbnail' data-fancybox-group='group1' > <img src='$img' ></a></li>";
  								}
                }
								 ?>

								</ul>
							</div>
							<div class="span5">
							<?php
              if (isset($_SESSION['uid'])) {
                if ($_SESSION['uid'] == "admin") {
                  echo "<form action='editproduct.php?pid=$pid' method='POST'>
                  <button class='btn btn-inverse' name='edit' type='submit'>Edit this product</button>
                  <button class='btn btn-inverse' name='remove' type='submit'>Remove this product</button>
                  </form>";
                } else {
                  echo "<form class='form-inline' action='cart-process.php?pid=".$pid."' method='POST'>
                    <button class='btn' name='addwishlist' type='submit'>Add to your wishlist</button><br><br>
                    <label><strong><font size='4'>Quantity:&nbsp&nbsp</strong></font></label>
                    <input type='text' class='span1' name='quantity' placeholder='0'>
                    &nbsp&nbsp
                    <input class='btn btn-inverse' name='addcart' type='submit' class='btn btn-inverse' value='Add to cart'/>
                  </form>";
                }
              }

               ?>
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

      <section class="main-content">
				<div class="row">
					<div class="span12">
						<div class="row">
							<div class="span12">
								<h4 class="title">
									<span class="pull-left"><span class="text"><span class="line"><strong>Suggest Products</strong></span></span></span>
									<span class="pull-right">

									</span>
								</h4>
								<div id="myCarousel" class="myCarousel carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails">

												<?php
                            $pid = $_GET['pid'];
                            $product = new product;
                            $product->selectProduct($pid);
                            $cat = $product->getCategory();

														$productList = new productdb;
														$arr = $productList->getProductbyCategory($cat);
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
																	<a href='product_detail.php' class='title'>".$pname."</a><br/>
																	<a href='product_list.php?pl=$category' class='category'>".$pcategory."</a>
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
