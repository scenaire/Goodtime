<?php

session_start();
require_once('product.php');
require_once('productdb.php');
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
                  <h4 class="title"><span class="text"><strong>Add</strong> Promotion</span></h4>
                  <form action="cart-process.php" method="post" class="form-stacked">
                    <fieldset>
                      <div class="control-group">
                        <label class="control-label">Name:</label>
                        <div class="controls">
                          <input type="text" name="prName">
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Code:</label>
                        <div class="controls">
                          <input type="text" name="prCode">
                        </div>
                      </div>

											<div class="control-group">
                        <label class="control-label">จะต้องซื้อครบ :</label>
                        <div class="controls">
                          <input type="text" name="prCondition">
                        </div>
                      </div>

                      <div class="control-group">
                          <label class="control-label">Category:</label>
                          <div class="controls">
														<select name="prGroup">
                              <option value="fix">Fix</option>
                              <option value="percent">Percent</option>
														</select>
                            </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Discount :</label>
                        <div class="controls">
                          <input type="text" name="prDiscount">
                        </div>
                      </div>


                      <hr>
                        <div class="actions"><input tabindex="9" name="newPromotion" class="btn btn-inverse large" type="submit" value="Save"></div>
                  </fieldset>
                </form>
							</div>

							<div class="span5">
                <div class="span7">
                  <h4 class="title"><span class="text"><strong>Promotion</strong> List</span></h4>
									<table class="table table-striped">
										<thead>
											<tr>
			                  <th>No. </th>
												<th>Name</th>
												<th>Code</th>
												<th>จะต้องซื้อครบ</th>
												<th>Discount</th>
												<th>Remove</th>
											</tr>
										</thead>
										<tbody>
			                  <?php

			                    $promotiondb = new promotiondb;
			                    $num = 1;

			                    foreach ($promotiondb->getPromotionList() as $key) {
			                      echo "<tr>";

														$prid = $key['PromotionID'];
														$name = $key['PromotionName'];
														$discount = $key['PromotionDiscount'];
														$type = $key['PromotionType'];
														$code = $key['PromotionCode'];
														$condition = $key['PromotionCondition'];

			                      echo "<td>$num</td>
			                      <td>$name</td>
														<td>$code</td>
														<td>$condition</td>";

														if ($type == "percent") {
															echo "<td>".$discount." %</td>";
														} elseif ($type == "fix") {
															echo "<td>-".$discount."</td>";
														}

														echo "<td><form action='cart-process.php?prid=".$prid."' method='POST'>
				                      <button class='btn' name='removepromotion' type='submit'>Remove</button></form></td>
				                    </tr>";


														$num += 1;
			                    }

			                    echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";

										echo "</tbody></table>";

										?>
              </div>
						</div>
						</div>
					</div>
				</div>
			</section>
		</div>
    </body>
</html>
