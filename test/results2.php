<!DOCTYPE>
<?php

session_start();

include("functions/functions.php");
?>

<html>
	<head>
		<title>My Online Shop</title>

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
			<li><a href="">My Account</a></li>
			<li><a href="customer_login.php">Log In</a></li>
			<li><a href="">Shopping Cart</a></li>
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
							//$get_pro = "select * from products where product_title like '%$search_query%'
																	//or product_author like '%$search_query%'
																	//or product_price like '%$search_query%'
																	//or product_release like '%$search_query%'
																	//or product_pub like '%$search_query%'
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
