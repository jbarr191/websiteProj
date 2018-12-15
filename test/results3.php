<!DOCTYPE>
<?php

session_start();

include("functions/functions.php");
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
	    <a href="#" class="w3-bar-item w3-button">Best-Sellers</a>
	    <a href="#" class="w3-bar-item w3-button">Top-Rated</a>
	    <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">
	      Genres <i class="fa fa-caret-down"></i>
	    </a>
	    <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">
	      <a href="#" class="w3-bar-item w3-button">Sci-fi</a>
	      <a href="#" class="w3-bar-item w3-button">Fiction</a>
	      <a href="#" class="w3-bar-item w3-button">Genre 3</a>
	    </div>
	  </div>
	  <a href="#footer" class="w3-bar-item w3-button w3-padding">Contact Us</a>
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
	    <p class="w3-left" style="padding:8px; font-size:20px"><a href="index.php">Home</a></p>
		
		 <?php
		 if (isset($_SESSION['customer_email'])){

			 echo "<p class='w3-left' style='padding:8px; font-size:20px'><a href='customer/customer_account.php'>My Account</a></p>";

		 } else {

			 echo "<p class='w3-left' style='padding:8px; font-size:20px'><a href='customer_login.php'>Log In</a></p>";
			 echo "<p class='w3-left' style='padding:8px; font-size:20px'><a href='customer_register.php'>Register</a></p>";
		 }
		 ?>
		 <p class="w3-left" style="padding:8px; font-size:20px"><a href="cart.php">Shopping Cart</a></p>
	    <p class="w3-right">
			 <div id="form" style="line-height:20px; padding-top:24px; float:right">
	 			<form method="get" action="results.php" enctype="multipart/form-data">
	 				<input type="text" name="user_query" placeholder="Search for stuff" style="width:200" />
	 				<input type="submit" name="search" value="Search" />
	 			</form>
	 		</div>
	      <!--<i class="fa fa-search"></i>-->
	    </p>
	  </header>


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

					<?php getPro(); ?>

				</div>

			</div>

		</div>
-->
		<!--content_wrapper ends here-->
				
				<div id="sort_select">
					<form method="get" action="results.php" enctype="multipart/form-data">
						<input type="text" name="user_query" placeholder="Advanced Search" />
						<td>
							<select name = "refine_search">
						
								<option>Sort By:</option>
								<!--query to get genres from database -->
								<?php
									//query copied from getGen() in functions.php 
									$get_search = "select * from search";
							
									$run_search = mysqli_query($con, $get_search);
							
						
									while ($row_search = mysqli_fetch_array($run_search))
									{
										$search_id = $row_search['search_id'];
										$search_cat = $row_search['search_cat'];
							
									echo "<option value='$search_id'>$search_cat</option>";
									}
												
								?>
							</select>
				
				
						</td>
						<input type="submit" name="search_asc" value="Search Ascending" />
						<input type="submit" name="search_desc" value="Search Descending" />
						
					</form>
				</div>
			
				<div id="products_box">
				
					<?php
					$search_query = $_GET['user_query'];
					
					if(isset($_GET['search']))
					{
						
						$search_query = $_GET['user_query'];
						
						if($search_query == '')
						{
								echo "<h2 style='padding:20px;'>Your search was empty!</h2>";
								
						}
							
						else
						{
							$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'";
							
							$run_pro = mysqli_query($con, $get_pro);
							
							$count_pro = mysqli_num_rows($run_pro);
							
							if($count_pro == 0){
								echo "<h2 style='padding:20px;'>No search results found!</h2>";
								}
									
							else 
									
								while($row_pro = mysqli_fetch_array($run_pro))
								{
								
									$pro_id = $row_pro['product_id'];
									$pro_title = $row_pro['product_title'];
									$pro_image = $row_pro['product_image'];
									$pro_author = $row_pro['product_author'];
									$pro_desc= $row_pro['product_desc'];
									$pro_price = $row_pro['product_price'];
									$pro_bio = $row_pro['product_bio'];
									$pro_gen = $row_pro['product_genre'];
									$pro_release = $row_pro['product_release'];
								
								
									echo "
										
										<div id='single_product'>
						
											<h3>$pro_title</h3>
						
											<img src='admin_area/product_images/$pro_image' width='180' height='180' />
						
											<p><b> Price: $ $pro_price </b></p>
						
											<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
											<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
					
										</div>";
		
								}	
						}
					}
					
					elseif(isset($_GET['search_asc']))
					{
						
						$search_query = $_GET['user_query'];
						
						if($search_query == '')
						{
								echo "<h2 style='padding:20px;'>Your search was empty!</h2>";
								
						}
							
						else
						{
							$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'
																	//order by product_title asc";
							
							if($_GET['refine_search'] == 1)
							{
								$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'
																	order by product_title asc";
							}
							
							elseif($_GET['refine_search'] == 2)
							{
								$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'
																	order by product_author asc";
							}
							
							elseif($_GET['refine_search'] == 3)
							{
								$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'
																	order by product_price asc";
							}
							
							elseif($_GET['refine_search'] == 4)
							{
								$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'
																	order by product_pub asc";
							}
							
							elseif($_GET['refine_search'] == 5)
							{
								$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'
																	order by product_release asc";
							}
							
							$run_pro = mysqli_query($con, $get_pro);
							
							$count_pro = mysqli_num_rows($run_pro);
							
							if($count_pro == 0){
								echo "<h2 style='padding:20px;'>No search results found!</h2>";
								}
									
							else 
									
								while($row_pro = mysqli_fetch_array($run_pro))
								{
								
									$pro_id = $row_pro['product_id'];
									$pro_title = $row_pro['product_title'];
									$pro_image = $row_pro['product_image'];
									$pro_author = $row_pro['product_author'];
									$pro_desc= $row_pro['product_desc'];
									$pro_price = $row_pro['product_price'];
									$pro_bio = $row_pro['product_bio'];
									$pro_gen = $row_pro['product_genre'];
									$pro_release = $row_pro['product_release'];
								
								
									echo "
										
										<div id='single_product'>
						
											<h3>$pro_title</h3>
						
											<img src='admin_area/product_images/$pro_image' width='180' height='180' />
						
											<p><b> Price: $ $pro_price </b></p>
						
											<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
											<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
					
										</div>";
		
								}	
						}
					}
				   
					elseif(isset($_GET['search_desc']))
					{
						
						$search_query = $_GET['user_query'];
						
						if($search_query == '')
						{
								echo "<h2 style='padding:20px;'>Your search was empty!</h2>";
								
						}
							
						else
						{
							if($_GET['refine_search'] == 1)
							{
								$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'
																	order by product_title desc";
							}
							
							elseif($_GET['refine_search'] == 2)
							{
								$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'
																	order by product_author desc";
							}
							
							elseif($_GET['refine_search'] == 3)
							{
								$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'
																	order by product_price desc";
							}
							
							elseif($_GET['refine_search'] == 4)
							{
								$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'
																	order by product_pub desc";
							}
							
							elseif($_GET['refine_search'] == 5)
							{
								$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'
																	order by product_release desc";
							}
							
							$run_pro = mysqli_query($con, $get_pro);
							
							$count_pro = mysqli_num_rows($run_pro);
							
							if($count_pro == 0){
								echo "<h2 style='padding:20px;'>No search results found!</h2>";
								}
									
							else 
								
									
								while($row_pro = mysqli_fetch_array($run_pro))
								{
								
									$pro_id = $row_pro['product_id'];
									$pro_title = $row_pro['product_title'];
									$pro_image = $row_pro['product_image'];
									$pro_author = $row_pro['product_author'];
									$pro_desc= $row_pro['product_desc'];
									$pro_price = $row_pro['product_price'];
									$pro_bio = $row_pro['product_bio'];
									$pro_gen = $row_pro['product_genre'];
									$pro_release = $row_pro['product_release'];
								
								
									echo "
										
										<div id='single_product'>
						
											<h3>$pro_title</h3>
						
											<img src='admin_area/product_images/$pro_image' width='180' height='180' />
						
											<p><b> Price: $ $pro_price </b></p>
						
											<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
											<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
					
										</div>";
		
								}	
						}
					}
				
							
					?>
				
				
		<!--content_wrapper ends here-->


		<div class="w3-black w3-center w3-padding-24">&copy; 2018 by Software Engineering TEAM 1</div>
	</div>

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

		// Click on the "Jeans" link on page load to open the accordion for demo purposes
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
