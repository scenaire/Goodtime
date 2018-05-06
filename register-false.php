<?php
session_start();
require_once('user.php');
require_once('userdb.php');
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
					<!--<form method="POST" class="search_form">
						<input type="text" class="input-block-level search-query" Placeholder="eg. T-sirt">
					</form>-->
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">
              <li><a href='register.php'>Login</a></li>
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
					<div class="span5">
						<h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
						<form action="login.php" name="login" method="post" >
							<input type="hidden" name="next" value="/">
							<fieldset>
								<div class="control-group">
                  <?php

                  if(!empty($_SESSION['messageL'])) {
                    echo "<div class='alert alert-error'>". $_SESSION['messageL']."</div>";
                  }

                   ?>
									<label class="control-label">Username</label>
									<div class="controls">
										<input type="text" name="user" placeholder="Enter your username" id="username" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Password</label>
									<div class="controls">
										<input type="password" name="pass" placeholder="Enter your password" id="password" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<input tabindex="3" class="btn btn-inverse large" name="login" type="submit" value="Login">
									<hr>
								</div>
							</fieldset>
						</form>
					</div>
					<div class="span7">
						<h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
						<form action="login.php" method="post" class="form-stacked">
							<fieldset>
								<div class="control-group">
                  <?php

                  if(!empty($_SESSION['messageR'])) {
                    echo "<div class='alert alert-error'>". $_SESSION['messageR']."</div>";
                  }

									elseif(isset($_SESSION['messageRC'])) {
										if ($_SESSION['messageRC']) {
											echo "<div class='alert alert-success'> <strong>Congratulation!</strong> Your Registration is Successful! Please login! </div>";
										} else {
											echo "<div class='alert alert-error'> Username or Email is already register! </div>";
										}

									}


                   ?>
									<label class="control-label">Name:</label>
									<div class="controls">
										<input type="text" placeholder="Enter your name" name="name" class="input-xlarge">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">Lastname:</label>
									<div class="controls">
										<input type="text" placeholder="Enter your lastname" name="lastname" class="input-xlarge">
									</div>
								</div>

								<div class="control-group">
										<label class="control-label">Username:</label>
										<div class="controls">
												<input type="text" placeholder="Enter your username" name="username" class="input-xlarge">
											</div>
								</div>

								<div class="control-group">
									<label class="control-label">Password:</label>
									<div class="controls">
										<input type="password" placeholder="Enter your password" name="password" class="input-xlarge">
									</div>
								</div>

                <div class="control-group">
									<label class="control-label">Re-Password:</label>
									<div class="controls">
										<input type="password" placeholder="Enter your password" name="repassword" class="input-xlarge">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">Email:</label>
									<div class="controls">
										<input type="email" placeholder="Enter your email" name="email" class="input-xlarge">
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">Address:</label>
									<div class="controls">
										<input type="text" placeholder="Enter your address" name="address" class="input-xlarge">
									</div>
								</div>

								<div class="checkbox">
  								<label><input type="checkbox" name="sendletter" value="1">send a Newsletter</label>
								</div>

								<hr>
								<div class="actions"><input tabindex="9" name="register" class="btn btn-inverse large" type="submit" value="Create Account"></div>
							</fieldset>
						</form>
					</div>
				</div>
			</section>
			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigation</h4>
						<ul class="nav">
							<li><a href="./index.html">Homepage</a></li>
							<li><a href="./about.html">About Us</a></li>
							<li><a href="./contact.html">Contac Us</a></li>
							<li><a href="./cart.html">Your Cart</a></li>
							<li><a href="./register.html">Login</a></li>
						</ul>
					</div>
					<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Order History</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Newsletter</a></li>
						</ul>
					</div>
					<div class="span5">
						<p class="logo"><img src="themes/images/goodtimelogo.png" class="site_logo" alt=""></p>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. the  Lorem Ipsum has been the industry's standard dummy text ever since the you.</p>
						<br/>
						<span class="social_icons">
							<a class="facebook" href="#">Facebook</a>
							<a class="twitter" href="#">Twitter</a>
							<a class="skype" href="#">Skype</a>
							<a class="vimeo" href="#">Vimeo</a>
						</span>
					</div>
				</div>
			</section>
			<section id="copyright">
				<span>Copyright 2013 bootstrappage template  All right reserved.</span>
			</section>
		</div>
    </body>
</html>
