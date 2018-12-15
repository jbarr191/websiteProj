<!DOCTYPE>
<?php
session_start();
include("functions/functions.php");
$con = mysqli_connect("localhost","root","","onlinebookstore");
?>

<html>
	<head>
		<title>My Online Shop</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!--<link rel="stylesheet" href="styles/style.css" media="all" />-->
		<style>
			.w3-sidebar a {font-family: "Roboto", sans-serif}
			body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
		</style>
	</head>
<body class="w3-content" style="max-width:1200px">

	<!-- Sidebar/menu -->
	<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
		<div class="w3-container w3-display-container w3-padding-16">
			<i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
		 	<a href="index.php">
		 		<img id="logo" src="images/logo.jpg" width="240" height="120" />
			</a>
	  	</div>
	  <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">

	    <a href="bestsellers.php" class="w3-bar-item w3-button">Best-Sellers</a>
	    <a href="topranked.php" class="w3-bar-item w3-button">Top-Rated</a>

	    <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">
	      Genres <i class="fa fa-caret-down"></i>
	    </a>
	    <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">

		  <a href = 'genre.php?pro_genre=Sci-fi' class="w3-bar-item w3-button:42px">Sci-fi</a>
		  <a href = 'genre.php?pro_genre=Fiction' class="w3-bar-item w3-button:42px">Fiction</a>
		  <a href = 'genre.php?pro_genre=Fantasy' class="w3-bar-item w3-button:42px">Fantasy</a>
		  <a href = 'genre.php?pro_genre=Drama' class="w3-bar-item w3-button:42px">Drama</a>
		  <a href = 'genre.php?pro_genre=Poetry' class="w3-bar-item w3-button:42px">Poetry</a>


	    </div>
	  </div>
	  <a href="contact_us.php" class="w3-bar-item w3-button w3-padding">Contact Us</a>
	</nav>

	<!--Main Container starts here-->
	<!-- Overlay effect when opening sidebar on small screens -->
	<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

	<!-- !PAGE CONTENT! -->
	<div class="w3-main" style="margin-left:250px">

	  <!-- Push down content on small screens -->
	  <div class="w3-hide-large" style="margin-top:83px"></div>

	  <!-- Top header -->
	  <header class="w3-container w3-xlarge">
		  <p class="w3-left" style="padding:8px; font-size:20px; padding-left:10px"><a href="index.php">Home</a></p>
 		 <?php
 		 if (isset($_SESSION['customer_email'])){

 			 echo "<p class='w3-left' style='padding:8px; font-size:20px; padding-left:20px'><a href='customer/customer_account.php'>My Account</a></p>";
 			 echo "<p class='w3-left' style='padding:8px; font-size:20px; padding-left:20px'><a href='customer_logout.php'>Log out</a></p>";
 		 } else {

 			 echo "<p class='w3-left' style='padding:8px; font-size:20px; padding-left:20px'><a href='customer_login.php'>Log In</a></p>";
 			 echo "<p class='w3-left' style='padding:8px; font-size:20px; padding-left:20px'><a href='customer_register.php'>Register</a></p>";
 		 }
 		 ?>
 		 <p class="w3-left" style="padding:8px; font-size:20px; padding-left:20px"><a href="cart.php">Shopping Cart </a><span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php total_items(); ?></b></span></p>
	    <p class="w3-right">
			 <div id="form" style="line-height:20px; padding-top:24px; float:right">
	 			<form method="get" action="results.php" enctype="multipart/form-data">
	 				<input type="text" name="user_query" placeholder="Search for stuff" style="width:200" />
	 				<input type="submit" name="search" value="Search" />
					<input type = "hidden" name="page" value = "1" />
					<input type = "hidden" name="refine_search" value = "0" />
					<input type = "hidden" name="order" value = "0" />
					<input type = "hidden" name="booklimit" value = "10" />
	 			</form>
	 		</div>
	      <!--<i class="fa fa-search"></i>-->
	    </p>
	  </header>

	  <!-- Image header -->
	  <div class="w3-display-container w3-container">
	    <img src="images/harrypottercover.jpg" alt="Books" style="width:100%">
	    <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
	      <h1 class="w3-jumbo w3-hide-small">Welcome</h1>
	      <h1 class="w3-hide-large w3-hide-medium">Welcome</h1>
	      <h1 class="w3-hide-small">CHECK OUT OUR STARTING SELECTION</h1>
	      <p><a href="#books" class="w3-button w3-black w3-padding-large w3-large">SHOP NOW</a></p>
	    </div>
	  </div>

	  <div class="w3-container w3-text-grey" id="books">
	    <p>20 items</p>
	  </div>

	  <!-- Product grid -->
	    <?php cart(); ?>

	  <div class="w3-container w3-grayscale">
	  <?php
		$get_pro = "select * from products";
		$run_pro = mysqli_query($con, $get_pro);
		while($row_pro=mysqli_fetch_array($run_pro)){
			$pro_id = $row_pro['product_id'];
			$pro_title = $row_pro['product_title'];
			$pro_image = $row_pro['product_image'];
			$pro_author = $row_pro['product_author'];
			$pro_desc= $row_pro['product_desc'];
			$pro_price = $row_pro['product_price'];
			$pro_bio = $row_pro['product_bio'];
			$pro_gen = $row_pro['product_genre'];
			$pro_release = $row_pro['product_release'];
	  ?>
		<div class="w3-col l3 s6">
			<div class="w3-container-topleft">
				<div class="w3-display-container">
					<img src="admin_area/product_images/<?php echo $pro_image; ?>" style="width:95%;height:320px">
					<span class="w3-tag w3-display-topleft">New</span>
					<div class="w3-display-middle w3-display-hover">
						<a href="index.php?add_cart=<?php echo $pro_id; ?>"><button class="w3-button w3-black">Buy now <i class="fa fa-shopping-cart"></i></button>
					</div>
				</div>
				<p><?php echo
				"<a href = 'details.php?pro_id=$pro_id' style = 'float:center;width:42px;height:42px'>&nbsp $pro_title &nbsp</a>"; ?>
					<br><b>$<?php echo $pro_price; ?></b></p>
			</div>


	    </div>


	  <?php
		}
	  ?>
	  </div>
<!--
	<div class="main_wrapper">
-->
		<!--content_wrapper starts here-->
<!--
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
<<<<<<< HEAD
					<?php getPro(); ?>
=======

					<?php
					  $get_pro = "select * from products";

					  $run_pro = mysqli_query($con, $get_pro);

					  while($row_pro=mysqli_fetch_array($run_pro)){
						  $pro_id = $row_pro['product_id'];
						  $pro_title = $row_pro['product_title'];
						  $pro_image = $row_pro['product_image'];
						  $pro_author = $row_pro['product_author'];
						  $pro_desc= $row_pro['product_desc'];
						  $pro_price = $row_pro['product_price'];
						  $pro_bio = $row_pro['product_bio'];
						  $pro_gen = $row_pro['product_genre'];
						  $pro_release = $row_pro['product_release'];
				    ?>

					  <div class="w3-col l3 s6">
						 <div class="w3-container">
							<div class="w3-display-container">
								<img src="admin_area/product_images/<?php echo $pro_image; ?>" style="width:100%">
								<span class="w3-tag w3-display-topleft">New</span>
								<div class="w3-display-middle w3-display-hover">
									<a href="index.php?add_cart=<?php echo $pro_id; ?>"><button class="w3-button w3-black">Buy now <i class="fa fa-shopping-cart"></i></button>
								</div>
							</div>
							<p><?php echo $pro_title; ?><br><b>$<?php echo $pro_price; ?></b></p>
						 </div>
					</div>
	<?php
		}
					?>

>>>>>>> 7d832bc1075f9ba028e323dc7bf435ea2b250dc0
				</div>
			</div>
		</div>
-->
		<!--content_wrapper ends here-->


		<div class="w3-black w3-center w3-padding-24">&copy; 2018 by Software Engineering TEAM 1</div>
	</div>

	<!--Main Container ends here-->

	<script>
		// Accordion
		function myAccFunc() {
		    var x = document.getElementById("demoAcc");
		    if (x.className.indexOf("w3-show") == -1) {
		        x.className += " w3-show";
		    } else {
		        x.className = x.className.replace(" w3-show", "");
		    }
		}
		// Click on the "books" link on page load to open the accordion for demo purposes
		document.getElementById("myBtn").click();
		// Script to open and close sidebar
		function w3_close() {
		    document.getElementById("mySidebar").style.display = "none";
		    document.getElementById("myOverlay").style.display = "none";
		}
		function w3_open() {
		    document.getElementById("mySidebar").style.display = "block";
		    document.getElementById("myOverlay").style.display = "block";
		}
	</script>

</body>
</html>
