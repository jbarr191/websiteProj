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

						Welcome Guest! <b style="color:yellow">Shopping Cart -</b> Total Items: <?php total_items();?>
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

					<form action="" method="post" enctype="multipart/form-data">
				
						<table align="center" width="700" bgcolor="skyblue">
						
							<tr align="center">
								<th>Remove</th>
								<th>Product(s)</th>
								<th>Quantity</th>
								<th>Total Price</th>
							</tr>
							
							<?php
							$total = 0;
							
							global $con;
	
							$ip = getIp();
	
							// query the db to retrieve all items that belong to an ip
							$sel_price = "select * from cart where ip_add='$ip'";
	
							// run the above query
							$run_price = mysqli_query($con, $sel_price);
	
							// while there's additional rows to fetch from the query results
							while($p_price=mysqli_fetch_array($run_price)){
		
								// get the product id from the cart
								$pro_id = $p_price['p_id'];
		
								// retrieve the product with the matching id from products table
								$pro_price = "select * from products where product_id = '$pro_id'";
		
								// run the above query
								$run_pro_price = mysqli_query($con, $pro_price);
		
								// while there's additional rows to fetch from the query results
								while ($pp_price = mysqli_fetch_array($run_pro_price)){
			
									// store the details of each item
									$product_price = array($pp_price['product_price']);
									
									$product_title = $pp_price['product_title'];
									
									$product_image = $pp_price['product_image'];
									
									$single_price = $pp_price['product_price'];
									
									$values = array_sum($product_price);
									
									$total += $values;
							
							?>
							
							<tr align="center">
								<td><input = type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
								<td><?php echo $product_title; ?><br>
								<img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60" />
								</td>
								<td><input type="text" size="4" name="qty"/></td>
								<td><?php echo "$" . $single_price; ?></td>
							</tr>
										
						<?php      } 
							    }  // close brackets of above while loops 
						?>
						
							<tr>
								<td colspan="4" align="right"><b>Sub Total:</b></td>
								<td><?php echo "$" . $total;?></td>
							</tr>
							
							<tr align="center">
								<td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
								<td><input type="submit" name="continue" value="Continue Shopping"/></td>
								<td><button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></td>
							</tr>
					
						</table>
				
					</form>
					
					<?php

						$ip = getIp();
						
						// if update cart button is clicked
						if(isset($_POST['update_cart'])){
							// delete relevant items from the cart database
							foreach($_POST['remove'] as $remove_id){
								
								$delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
								
								$run_delete = mysqli_query($con, $delete_product);
								
								if($run_delete){
									
									echo "<script>window.open('cart.php','_self')</script>";
								}
							}					
						}
						// if continue shopping button is clicked, go to index.php
						if(isset($_POST['continue'])){
							
							echo "<script>window.open('index.php','_self')</script>";					
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
