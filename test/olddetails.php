<!DOCTYPE>

<?php
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
			<li><a href="">All Products</a></li>
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
					
						Welcome Guest! <b style="color:yellow">Shopping Cart -</b> Total Items: <?php total_items();?> 
						Total Price: <?php total_price(); ?> <a href="cart.php" style="color:yellow">Go to Cart</a>
					
						</span>
				
				</div>
			
				<div id="products_box">
						
					<?php 
					if(isset($_GET['pro_id'])){
					$product_id = $_GET['pro_id'];
					
					$get_pro = "select * from products where product_id = '$product_id'";
					
					$run_pro = mysqli_query($con, $get_pro);
					
					$row_pro=mysqli_fetch_array($run_pro);
					
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
							
							<img src='admin_area/product_images/$pro_image' width='180' height='277' />
							
							<p><b> Price: $ $pro_price  </b></p>
							
							<br><b>Author : $pro_author</b><br>
							<br><b>Book Description : </b>
							<p align='center'>$pro_desc</p>
							<br><b>Author Biography : </b>
							<p align='center'>$pro_bio</p>
							<br><b>Genre : </b>
							<p align='center'>$pro_gen</p>
						
							<br>
					
							
							<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
							
							
							<a href = 'index.php? style = 'float:left;height:42px'>&nbsp Go Back &nbsp</a>
						
	
						</div>			
					";
					
					}
					?>	
								
										
			
				
		
				</div>
				
				<div id= "comment_insert">

			<?php
					
					if(isset($_GET['pro_id'])){
					$product_id = $_GET['pro_id'];
					echo "<form action= 'details.php?pro_id=$product_id' method = 'post' enctype = 'multipart/form-data'>
					";
					}
			?>
					<table align ="center"  bgcolor="orange">
			<!-- insert into table  -->			
			<tr>
				<!-- column 1 -->
				<td align = "right"><b>INSERT COMMENT</b></td>
				<!-- column 2 -->
				<td><input type="text" name="comment_text" size="20"/></td>
			</tr>
		
		
			<tr>
				<td align = "right"><b>USER</b></td>
				<td>
					<select name = "anonymous">
						
						<option>Select</option>
					
						<option value='0'>Use Username</option>
						
						<option value = '1'>Post Anonymous</option>
												
				
					</select>
				
				
				</td>
			</tr>
				<tr>
				<td align = "right"><b>RATING</b></td>
				<td>
					<select name = "rating">
						
						<option>Select</option>
					
						<option value='1'>1</option>
						
						<option value = '2'>2</option>
						
						<option value = '3'>3</option>
						
						<option value = '4'>4</option>
						
						<option value = '5'>5</option>
												
				
					</select>
				
				
				</td>
			</tr>
		
			<!--insert button -->
			<tr align="right">
				<td colspan="7"><input type="submit" name="comment_post" value= "Insert Now"/></td>
			</tr>
			
			
		
			</div>
			
			
			<div id = "comment_text">	
			<h3 style="text-align:center;">COMMENTS</h3>
				<ul id="comments">
				
				
				<?php
					
					if(isset($_GET['pro_id'])){
					$product_id = $_GET['pro_id'];
					getComments($product_id);
					}
					
					
				?>
				</ul>
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


<?php
					
							//if something is submitted insert using post(), then execute
					
			
					if(isset($_POST['comment_post']) && isset($_GET['pro_id'])&& isset($_SESSION['customer_email'])){
					//get text data from fields
					$rating= $_POST['rating'];
					$anonymous= $_POST['anonymous'];
					$comment_text= $_POST['comment_text'];
					$product_id = $_GET['pro_id'];
					$user_id = getUserID();
				
					$run = mysqli_query($con, "select * from purchase where user_id ='$user_id' and book_id = '$product_id'" );
					$purchased = mysqli_num_rows($run);
					if($purchased != 0) {
					
					$insert_comments = "insert into comments(book_id, anonymous, comment_text,rating, user_id) 
											values('$product_id','$anonymous','$comment_text','$rating',$user_id)";
					$insert_com = mysqli_query($con, $insert_comments);
					if($insert_com)
					{
					echo "<script>alert('Comment has been inserted!')</script>";
					//refresh page to avoid duplicate data
					echo "<script>window.open('details.php?pro_id=$product_id','_self')</script>";
					
					}
					}
					else echo "<script>alert('You cannot comment on books you have not purchased')</script>";
					
					
					}
					else if(!(isset($_SESSION['customer_email']))&& isset($_POST['comment_post'])){
						echo "<script>alert('Please log in to comment')</script>";
					}
					
					
?>