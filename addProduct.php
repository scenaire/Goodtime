<?php

session_start();
require_once('product.php');
$_SESSION['message'] = '';
if (isset($_POST["pName"])) {
	$pName = ($_POST["pName"]);
	$pPrice = ($_POST["pPrice"]);
	$pCategory = ($_POST["pGroup"]);
	$pStock = ($_POST["pStock"]);
	$pDecs = ($_POST["pDecs"]);

	$img = array();
	if(!empty($_POST["pic1"])) {
		array_push($img,"Product_image/".$_POST["pic1"]);
	}
	if(!empty($_POST["pic2"])) {
		array_push($img,"Product_image/".$_POST["pic2"]);
	}
	if(!empty($_POST["pic3"])) {
		array_push($img,"Product_image/".$_POST["pic3"]);
	}
	if(!empty($_POST["pic4"])) {
		array_push($img,"Product_image/".$_POST["pic4"]);
	}
	if(!empty($_POST["pic5"])) {
		array_push($img,"Product_image/".$_POST["pic5"]);
	}

	if(empty($pName) || empty($pPrice) || empty($pCategory) || empty($pStock) || empty($img)) {
    $_SESSION['message'] = "Please input all box";
  } elseif ($pStock < 0) {
		$_SESSION['message'] = "Stock cannot less than 0";
	} elseif ($pPrice< 0){
		$_SESSION['message'] = "Price cannot less than 0";
	} else {
		$product = new product;
		$_SESSION['message'] = $product->addItem($pName,$pPrice,$img,$pCategory,$pStock,$pDecs);
	}

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
							<li>Hey! Admin.</li>
							<li><a href="index.php">Log out</a></li>
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
							<li><a href="./miniatureList.php">MINIATURE HOUSE</a></li>
							<li><a href="./nendoroidList.php">NENDOROID</a></li>
							<li><a href="./funkoList.php">FUNKO</a>	</li>
						</ul>
					</nav>
				</div>
			</section>
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/catbanner.png" alt="New products" >
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span9">
						<div class="row">

							<div class="span5">

                <div class="span7">
                  <h4 class="title"><span class="text"><strong>Product</strong> Form</span></h4>
                  <form action="addProduct.php" method="post" class="form-stacked">
                    <fieldset>
											<div class="alert alert-error"><?= $_SESSION['message']?></div>
                      <div class="control-group">
                        <label class="control-label">Name:</label>
                        <div class="controls">
                          <input type="text" name="pName">
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Price:</label>
                        <div class="controls">
                          <input type="text" name="pPrice">
                        </div>
                      </div>

                      <div class="control-group">
                          <label class="control-label">Category:</label>
                          <div class="controls">
														<select name="pGroup">
															<option value="Funko">Funko</option>
															<option value="Nendoroid">Nendoroid</option>
															<option value="Miniature House">Miniature house</option>
														</select>
                            </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Stock:</label>
                        <div class="controls">
                          <input type="text" name="pStock">
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Description:</label>
                        <div class="controls">
                          <textarea name="pDecs" rows="4" cols="50"></textarea>
                        </div>
                      </div>
                        <from action="/action_page.php">
                          <input type="file" name="pic1" accept="image/*" value="Browse..">
													<input type="file" name="pic2" accept="image/*" value="Browse..">
													<input type="file" name="pic3" accept="image/*" value="Browse..">
													<input type="file" name="pic4" accept="image/*" value="Browse..">
													<input type="file" name="pic5" accept="image/*" value="Browse..">
                        </from>
                      <hr>
                        <div class="actions"><input tabindex="9" class="btn btn-inverse large" type="submit" value="Save"></div>
                  </fieldset>
                </form>
              </div>
						</div>
							<div class="span5">
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
