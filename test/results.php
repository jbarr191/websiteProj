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


				<?php
					$user_query = $_GET['user_query'];
					$refine_search = $_GET['refine_search'];
					$page = $_GET['page'] + 1;
					$search = $_GET['search'];
					$order = $_GET['order'];
					$limit = $_GET['booklimit'];
					echo"<a href='results.php?user_query=$user_query&search=$search&refine_search=$refine_search&order=$order&page=$page&booklimit=$limit'>Next Page</a>";



				?>


				<div id="sort_select">
					<form method="get" action="results.php" enctype="multipart/form-data">
						<input type="text" name="user_query" placeholder="Advanced Search" />
						<input type = "hidden" name="search" value = "0" />
						<input type = "hidden" name="page" value = "1" />
					    <input type = "hidden" name="refine_search" value = "0" />
					    <input type = "hidden" name="order" value = "0" />
						<input type = "hidden" name="booklimit" value = "10" />
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
						<input type="submit" name="order" value="Search Ascending" />
						<input type="submit" name="order" value="Search Descending" />
						<input type="checkbox" name="booklimit" value="20" />Set page limit to 20 books<br />


					</form>
				</div>

				<div class="w3-row w3-container">

					<?php
					$search_query = $_GET['user_query'];

					if(isset($_GET['search']) and $_GET['search'] == "Search")
					{

						$search_query = $_GET['user_query'];

						if($search_query == '')
						{
								echo "<h2 style='padding:20px;'>Your search was empty!</h2>";

						}

						else
						{

							$pageoffset = ($_GET['page']-1) *10;


							$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'
																	limit 10 offset $pageoffset";

							$run_pro = mysqli_query($con, $get_pro);

							$count_pro = mysqli_num_rows($run_pro);

							if($count_pro == 0){
								echo "<h2 style='padding:20px;'>No search results found!</h2>";
								}

							else ?>
									<div class="w3-row">
								<?php while($row_pro = mysqli_fetch_array($run_pro))
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


									</div> <?php

								}	?> </div> <?php
						}
					}

					elseif(isset($_GET['order']) and ($_GET['order']== "Search Ascending"))
					{

						$search_query = $_GET['user_query'];

						if($search_query == '')
						{
								echo "<h2 style='padding:20px;'>Your search was empty!</h2>";

						}

						else
						{

							try{

								if($_GET['refine_search'] == 1)
								{
									$search_cat = "product_title";
								}

								elseif($_GET['refine_search'] == 2)
								{
									$search_cat = "product_author";
								}

								elseif($_GET['refine_search'] == 3)
								{
									$search_cat = "product_price";
								}

								elseif($_GET['refine_search'] == 4)
								{
									$search_cat = "product_pub";
								}

								elseif($_GET['refine_search'] == 5)
								{
									$search_cat = "product_release";
								}
								elseif($_GET['refine_search'] == 6)
								{
									$search_cat = "ratings";
								}
								if($_GET['booklimit'] == 20){
									$limit = 20;
								}

								$pageoffset = ($_GET['page']-1) * $limit;

								
								$pageoffset = ($_GET['page']-1) * 10;
								$get_pro = "select * from products where product_title like '%$search_query%'
																	or product_author like '%$search_query%'
																	or product_price like '%$search_query%'
																	or product_release like '%$search_query%'
																	or product_pub like '%$search_query%'
																	order by $search_cat asc
																	limit $limit offset $pageoffset";

								checkSearch(mysqli_query($con, $get_pro));

								$run_pro = mysqli_query($con, $get_pro);

								checkSearch(mysqli_num_rows($run_pro));

								$count_pro = mysqli_num_rows($run_pro);

								if($count_pro == 0){
									echo "<h2 style='padding:20px;'>No search results found!</h2>";
								}

								else ?>
									 <div class="w3-container w3-grayscale">
									<?php while($row_pro = mysqli_fetch_array($run_pro))
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


										</div> <?php

									}	?> </div> <?php
							}
							catch(Exception $e) {
								echo $e->getMessage();
							}
						}
					}

					elseif(isset($_GET['order']) and ($_GET['order']== "Search Descending"))
					{

						$search_query = $_GET['user_query'];

						if($search_query == '')
						{
								echo "<h2 style='padding:20px;'>Your search was empty!</h2>";

						}

						else
						{
							try{

								$search_id = $_GET['refine_search'];

								if($_GET['refine_search'] == 1)
								{
									$search_cat = "product_title";
								}

								elseif($_GET['refine_search'] == 2)
								{
									$search_cat = "product_author";
								}

								elseif($_GET['refine_search'] == 3)
								{
									$search_cat = "product_price";
								}

								elseif($_GET['refine_search'] == 4)
								{
									$search_cat = "product_pub";
								}

								elseif($_GET['refine_search'] == 5)
								{
									$search_cat = "product_release";
								}
								elseif($_GET['refine_search'] == 6)
								{
									$search_cat = "ratings";

								}


								if($_GET['booklimit'] == 20){
									$limit = 20;
								}

			
								$pageoffset = ($_GET['page']-1) * $limit;
								$get_pro = "select * from products where product_title like '%$search_query%'
																		or product_author like '%$search_query%'
																		or product_price like '%$search_query%'
																		or product_release like '%$search_query%'
																		or product_pub like '%$search_query%'
																		order by $search_cat desc
																		limit $limit offset $pageoffset";

								checkSearch(mysqli_query($con, $get_pro));

								$run_pro = mysqli_query($con, $get_pro);

								checkSearch(mysqli_num_rows($run_pro));

								$count_pro = mysqli_num_rows($run_pro);

								if($count_pro == 0){
									echo "<h2 style='padding:20px;'>No search results found!</h2>";
									}

								else ?>
										<div class="w3-container w3-grayscale">
									<?php while($row_pro = mysqli_fetch_array($run_pro))
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


										</div> <?php

									}	?> </div> <?php
							}
							catch(Exception $e) {
									echo $e->getMessage();
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
