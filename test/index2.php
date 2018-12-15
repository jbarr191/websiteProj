<!DOCTYPE>
<?php

session_start();

include("functions/functions.php");

?>

<html>
	<head>
		<title>My Online  Shop</title>

		<link rel="stylesheet" href="styles/style.css" media="all" />
	</head>
<body>

	<!--Main Container starts here-->
	<div class="main_wrapper">

		<div class="header_wrapper">

			<img id="logo" src="images/logo.jpg" width="375" height="175" />
			<img id="banner" src="images/banner.jpg" width"800" height="175" />


		</div>

	<div class="menubar">

		<ul id="menu">
			<li><a href="index.php">Home</a></li>
			<li><a href="index.php">All Products</a></li>
			<?php
			if (isset($_SESSION['customer_email'])){

				echo "<li><a href='customer/customer_account.php'>My Account</a></li>";

			} else {

				echo "<li><a href='customer_login.php'>Log In</a></li>";
				echo "<li><a href='customer_register.php'>Register</a></li>";
			}
			?>
			<li><a href="cart.php">Shopping Cart</a></li>
			<li><a href="">Contact Us</a></li>
		</ul>

		<div id="form">
			<form method="get" action="results.php" enctype="multipart/form-data">
				<input type="text" name="user_query" placeholder="Search for stuff" />
				<input type="submit" name="search" value="Search" />
			</form>
		</div>

	</div>

		<!--content_wrapper starts here-->
		<div class="content_wrapper">

			<div id ="sidebar">

				<div id="sidebar_title">Genres</div>

				<ul id="gens">

					<?php getGens(); ?>

				</ul>

			</div>

			<div id="content_area">

				<?php cart(); ?>

				<div id="shopping_cart">

					<span style="float:right; font-size:18px; padding:5px; line-height:40px;">

					<?php
					if (isset($_SESSION['customer_email'])){

						$user = $_SESSION['customer_email'];

						$result = mysqli_query($con,"select first_name from accounts where email = '$user'");
						$row_img = mysqli_fetch_array($result);
						$name = $row_img['first_name'];
						echo "Welcome $name!";

					} else {

						echo "Welcome Guest!";
					}
					?>
					<b style="color:yellow">Shopping Cart -</b> Total Items: <?php total_items();?>
					Total Price: <?php total_price(); ?> <a href="cart.php" style="color:yellow">Go to Cart</a>

					<?php
					if (!isset($_SESSION['customer_email'])){

						echo "<a href='customer_login.php' style='color:orange'>Login</a>";

					} else {

						echo "<a href='customer_logout.php' style='color:orange'>Logout</a>";
					}

					?>
					</span>

				</div>

				<div id="products_box">

					<?php getPro(); ?>

				</div>

			</div>

		</div>
		<!--content_wrapper ends here-->


		<div id="footer">

		<h2 style = "text-align:center; padding-top:30px;">&copy; 2018
		by software engineering TEAM 1</h2>

		</div>

	</div>
	<!--Main Container ends here-->

</body>
</html>
