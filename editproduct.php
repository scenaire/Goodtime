<?php

session_start();
require_once('product.php');
require_once('productdb.php');

unset($_SESSION['messageE']);
unset($_SESSION['messageS']);

if (isset($_POST["update"])) {
		$pName = ($_POST["pName"]);
		$pPrice = ($_POST["pPrice"]);
		$pCategory = ($_POST["pGroup"]);
		$pStock = ($_POST["pStock"]);
		$pDecs = ($_POST["pDecs"]);

		$img = array();

    for ($x = 0; $x < 5; $x++) {
      $i = "pic".($x+1);
      if(!empty($_POST[$i])) {
        array_push($img,"Product_image/".$_POST[$i]);
      } else {
        array_push($img,null);
      }
    }

		if(empty($pName) || empty($pPrice) || empty($pCategory) || empty($pStock)) {
	    $_SESSION['messageE'] = "Please enter all box";
	  } elseif ($pStock < 0) {
			$_SESSION['messageE'] = "Stock cannot less than 0";
		} elseif ($pPrice< 0){
			$_SESSION['messageE'] = "Price cannot less than 0";
		} else {
			$product = new product;
      $pid = $_GET['pid'];
      $product->selectProduct($pid);
			$_SESSION['messageS'] = $product->updateProduct($pName,$pPrice,$img,$pCategory,$pStock,$pDecs);
      header("location:product_detail.php?pid=$pid");
    }
} elseif (isset($_POST["remove"])) {
  $pid = $_GET['pid'];
  $product = new product;
  $product->selectProduct($pid);
  $cat = $product->getCategory();
  $product->removeProduct();
  header("location:product_list.php?pl=$cat");
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
							echo "<b>Hey! ".$_SESSION['uid']."</b>
						<li><a href='addProduct.php'>Add Product</a></li>
						<li><a href='logout.php'>Logout</a></li>";
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

							<div class="span5">

                <div class="span7">
                  <h4 class="title"><span class="text"><strong>Product</strong> Form</span></h4>
                  <?php

                  echo "<form action='editproduct.php?pid=".$_GET['pid']."' method='post' class='form-stacked'>";

                   ?>

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

                          <?php

                          $pid = $_GET['pid'];
          								$product = new product;
          								$product->selectProduct($pid);
                          $name = $product->getName();
                          //$name = str_replace("+","&nbsp;",urlencode($name));
                          //$name = str_replace("%2F","/",$name);
                          echo "<input type='text' name='pName' value='$name'>";

                           ?>

                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Price:</label>
                        <div class="controls">
                          <?php

                          $pid = $_GET['pid'];
                          $product = new product;
                          $product->selectProduct($pid);
                          $price = $product->getPrice();
                          echo "<input type='text' name='pPrice' value=$price>";

                           ?>
                        </div>
                      </div>

                      <div class="control-group">
                          <label class="control-label">Category:</label>
                          <div class="controls">
														<select name="pGroup">
															<?php

                              $pid = $_GET['pid'];
                              $product = new product;
                              $product->selectProduct($pid);
                              $cat = $product->getCategoryWord();

															$db = new productdb;
															$list = $db->getAllCategory();

															foreach ($list as $key) {
																$val = $key['CategoryName'];
                                if ($cat == $val) {
                                  echo "<option selected value='$val'>$val</option>";
                                } else {
                                  echo "<option value='$val'>$val</option>";
                                }

															}

															 ?>

														</select>
                            </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Stock:</label>
                        <div class="controls">
                          <?php

                          $pid = $_GET['pid'];
                          $product = new product;
                          $product->selectProduct($pid);
                          $stock = $product->getStock();
                          echo "<input type='text' name='pStock' value=$stock>";

                           ?>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Description:</label>

												<div class="controls" align="left">

                          <?php

                          $pid = $_GET['pid'];
                          $product = new product;
                          $product->selectProduct($pid);
                          $decs = $product->getDecs();
                          echo "<textarea name='pDecs' class='ckeditor' cols='69' rows='5'>$decs</textarea>";

                           ?>


          						</div>
                      </div>



                      <hr>
                        <div class="actions"><input tabindex="9" name="update" class="btn btn-inverse large" type="submit" value="Save"></div>
                  </fieldset>
                </form>
              </div>
						</div>
						</div>
					</div>
          <div class="span3 col">
            <?php

            $pid = $_GET['pid'];
            $product = new product;
            $product->selectProduct($pid);
            $image = $product->getImage();

            echo "<div class='col-sm-6 col-sm-offset-3'>";

            for ($x = 0; $x < 5; $x++) {
              $i = $x+1;
              if(isset($image[$x])) {
                $img = $image[$x];
                $img = $img['ProductImage'];
                echo "
                <from>
                <div class='form-group'>";
                echo "<img style='max-height:100px; width:auto;' src='$img'>";
                echo "<input type='file' name='pic$i' accept='image/*'' value='Browse..'>
                </div></from><hr>";
              } else {
                echo "<from>
                <div class='form-group'>";
                echo "<input type='file' name='pic$i' accept='image/*'' value='Browse..'></div></from>";
              }
            }

             ?>

        </div>
					</div>
				</div>
			</section>
		</div>
    </body>
</html>
