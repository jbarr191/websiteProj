<!DOCTYPE>
<?php

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
		 <p class="w3-left" style="padding:8px; font-size:20px">All Products</p>
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
	  <div class="w3-display-container w3-container" style = "text-align:center;">
	    		
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
							
							
							<a href = 'index.php? style = 'float:center;height:42px'>&nbsp Go Back &nbsp</a>
						
	
						</div>			
					";
					
					}
					?>
	  </div>


	  <!-- Product grid -->
	  <?php cart(); ?>

	  <div class="w3-row w3-grayscale">
	 
		
		<h3 style="text-align:left;"><u>COMMENTS</u></h3>
				<ul style ="text-align:center;">
				
				
				<?php
					
					if(isset($_GET['pro_id'])){
					$product_id = $_GET['pro_id'];
					getComments($product_id);
					}
					
					
				?>
				</ul>
					
		
	  </div>
			<div>

			<?php
					
					if(isset($_GET['pro_id'])){
					$product_id = $_GET['pro_id'];
					echo "<form action= 'details.php?pro_id=$product_id' method = 'post' enctype = 'multipart/form-data'>
					";
					}
			?>
					<table  bgcolor="white">
			<!-- insert into table  -->			
			<tr>
				<!-- column 1 -->
				<td><b>INSERT COMMENT</b></td>
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
		
			</div>

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
