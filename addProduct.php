<?php

session_start();
require_once('product.php');
require_once('productdb.php');

unset($_SESSION['messageE']);
unset($_SESSION['messageS']);
unset($_SESSION['messageC']);

if (isset($_POST["addP"])) {
		$pName = ($_POST["pName"]);
		$pPrice = ($_POST["pPrice"]);
		$pCategory = ($_POST["pGroup"]);
		$pStock = ($_POST["pStock"]);
		$pDecs = ($_POST["pDecs"]);

		$img = array();

		if (!empty($_POST['pic'])) {
			foreach ($_POST['pic'] as $key) {
				array_push($img,"Product_image/".$key);
			}
		}

		if(empty($pName) || empty($pPrice) || empty($pCategory) || empty($pStock) || empty($img)) {
	    $_SESSION['messageE'] = "Please input all box";
	  } elseif ($pStock < 0) {
			$_SESSION['messageE'] = "Stock cannot less than 0";
		} elseif ($pPrice< 0){
			$_SESSION['messageE'] = "Price cannot less than 0";
		} else {
			$product = new product;
			$_SESSION['messageS'] = $product->addItem($pName,$pPrice,$img,$pCategory,$pStock,$pDecs);
		}
} elseif (isset($_POST["newCatagory"])) {
	$productdb = new productdb;
	$cName = $_POST["cName"];
	$cheader = "Product_image/".$_POST["cheader"];
	$_SESSION['messageC'] = $productdb->newCatagory($cName,$cheader);
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
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span9">
						<div class="row">

							<div class="span3 col">
                  <h4 class="title"><span class="text"><strong>Category</strong> Form</span></h4>
                  <form action="addProduct.php" method="post" class="form-stacked">
                    <fieldset>
											<?php

											if (isset($_SESSION['messageC'])) {
												if ($_SESSION['messageC'] == true) {
													echo "<div class='alert alert-success'> <strong>Congratulations!</strong> this product has been added. </div>";
												} else {
													echo "<div class='alert alert-error'> <strong>ข้อผิดพลาด!</strong> ไม่สามารถเพิ่มสินค้าได้ อาจมีสินค้าชนิดนี้อยู่แล้ว </div>";
												}
											}

											 ?>
                      <div class="control-group">
                        <label class="control-label">Name:</label>
                        <div class="controls">
                          <input type="text" name="cName">
                        </div>
                      </div>

                        <from action="/action_page.php">
													<label>Header : </label>
                          <input type="file" name="cheader" accept="image/*" value="Browse..">
                        </from>
                      <hr>
                        <div class="actions"><input tabindex="9" name="newCatagory" class="btn btn-inverse large" type="submit" value="Save"></div>
                  </fieldset>
                </form>
							</div>

							<div class="span5">
                <div class="span7">
                  <h4 class="title"><span class="text"><strong>Product</strong> Form</span></h4>
                  <form action="addProduct.php" method="post" class="form-stacked">
                    <fieldset>
											<?php

											if (!empty($_SESSION['messageE'])) {
												echo "<div class='alert alert-error'>".$_SESSION['messageE']."</div>";
											} elseif (isset($_SESSION['messageS'])) {
												if ($_SESSION['messageS'] == true) {
													echo "<div class='alert alert-success'> <strong>Congratulations!</strong> this product has been added. </div>";
												} else {
													echo "<div class='alert alert-error'> <strong>ข้อผิดพลาด!</strong> ไม่สามารถเพิ่มสินค้าได้ อาจมีสินค้าชนิดนี้อยู่แล้ว </div>";
												}
											}

											 ?>
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
															<?php
															$db = new productdb;
															$list = $db->getAllCategory();

															foreach ($list as $key) {
																$val = $key['CategoryName'];
																echo "<option value='$val'>$val</option>";
															}

															 ?>

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

												<div class="controls" align="left">
           									<textarea name="pDecs" class="ckeditor" cols="69" rows="5"></textarea>
          						</div>
                      </div>
                        <from action="/action_page.php">

													<?php

													for ($i=0; $i<5; $i++) {
														echo "<input type='file' name='pic[]' accept='image/*' onchange='readURL(this);' value='Browse..'>";
													}

													 ?>
                        </from>
                      <hr>
                        <div class="actions"><input tabindex="9" name="addP" class="btn btn-inverse large" type="submit" value="Save"></div>
                  </fieldset>
                </form>
              </div>
						</div>
						</div>
					</div>
				</div>
			</section>
		</div>
    </body>
</html>
