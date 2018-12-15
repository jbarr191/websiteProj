<!DOCTYPE>
<?php

session_start();

include("includes/db.php");
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

			/* Style the button that is used to open and close the collapsible content */
			.collapsible {
			  background-color: #eee;
			  color: #444;
			  cursor: pointer;
			  padding: 18px;
			  width: 850px;
			  border: none;
			  text-align: left;
			  outline: none;
			  font-size: 15px;
			}
			/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
			.active, .collapsible:hover {
			  background-color: #ccc;
			}
			/* Style the collapsible content. Note: hidden by default */
			.collapseContent {
			  width: 850px;
			  padding: 0 18px;
			  display: none;
			  overflow: hidden;
			  background-color: #f1f1f1;
			}
			#sidebar {
				width:200px;
				float:right;
			}
			#sidebar_title{
				background:white;
				color:black;
				font-size:22px;
				font-family:arial;
				text-align:center;
			}

		</style>
	</head>
	<body class="w3-content" style="max-width:1200px">

		<nav class="w3-bar-block w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
			<div class="w3-container w3-display-container w3-padding-16">
			 	<a href="../index.php">
			 		<img id="logo" src="../images/logo.jpg" width="240" height="120" />
				</a>
		  	</div>
		</nav>

		<!--Main Container starts here-->
		<!-- Overlay effect when opening sidebar on small screens -->
		<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

		<!-- !PAGE CONTENT! -->
		<div class="w3-main" >

		  <!-- Push down content on small screens -->
		  <div class="w3-hide-large" style="margin-top:83px"></div>

		  <!-- Top header -->
		  <header class="w3-container w3-xlarge" style="margin-left:250px">
		    <p class="w3-left" style="padding:8px; font-size:20px; padding-left:10px"><a href="../index.php">Home</a></p>
			 <?php
			 if (isset($_SESSION['customer_email'])){

				 echo "<p class='w3-left' style='padding:8px; font-size:20px; padding-left:20px'><a href='customer_account.php'>My Account</a></p>";
				 echo "<p class='w3-left' style='padding:8px; font-size:20px; padding-left:20px'><a href='../customer_logout.php'>Log out</a></p>";
			 } else {

				 echo "<p class='w3-left' style='padding:8px; font-size:20px; padding-left:20px'><a href='../customer_login.php'>Log In</a></p>";
				 echo "<p class='w3-left' style='padding:8px; font-size:20px; padding-left:20px'><a href='../customer_register.php'>Register</a></p>";
			 }
			 ?>
			 <p class="w3-left" style="padding:8px; font-size:20px; padding-left:20px"><a href="../cart.php">Shopping Cart </a><span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php total_items(); ?></b></span></p>
		    <p class="w3-right">
				 <div id="form" style="line-height:20px; padding-top:24px; float:right">
		 			<form method="get" action="../results.php" enctype="multipart/form-data">
		 				<input type="text" name="user_query" placeholder="Search for stuff" style="width:200" />
		 				<input type="submit" name="search" value="Search" />
		 			</form>
		 		</div>
		      <!--<i class="fa fa-search"></i>-->
		    </p>
		  </header>


		<!--content_wrapper starts here-->
		<div class="content_wrapper">

			<div id="sidebar" style="background-color: #eee">

				<div id="sidebar_title" style="background-color: #eee; padding-top: 10px;"> My Account: </div>


						<?php
						$user = $_SESSION['customer_email'];
						$get_img = "select * from accounts where email = '$user'";
						$run_img = mysqli_query($con, $get_img);
						$row_img = mysqli_fetch_array($run_img);

						$c_image = $row_img['user_image'];
						$c_name = $row_img['first_name'];

						echo "<div style='text-align:center'>$user</div>";
						if($c_image == ''){
							echo "<p style='padding-left: 25px'><img src='customer_images/default_pic.png'
							width='150' height='150'/></p>";
						} else {
							echo "<p style='padding-left: 25px'><img src='customer_images/$c_image'
							width='150' height='150'/></p>";
						}

						?>
				<div id="sidebar_title" style="background-color: #eee; font-size:18px; text-align:left; padding-left:3px">Account Financials: </div>
				<li style=padding-left:13px;><a href="../customer_cards.php">Credit Cards</a></li>
				<li style=padding-left:13px;><a href="../addresses.php">Addresses</a></li>

				</div>

				<div id="content_area">

					<?php cart(); ?>

					<!-- Old logout and cart section
					<div id="shopping_cart">

						<span style="float:right; font-size:18px; padding:5px; line-height:40px; font-size:15px">

							<?php
							//if (isset($_SESSION['customer_email'])){

								//$user = $_SESSION['customer_email'];

								//$result = mysqli_query($con,"select first_name from accounts where email = '$user'");
								//$row_img = mysqli_fetch_array($result);
								//$name = $row_img['first_name'];
								//echo "Welcome $name!";

							//} else {

								//echo "Welcome Guest!";
							//}
							?>
							<b style="color:orange">Shopping Cart -</b> Total Items: <?php total_items();?>
							- Total Price: <?php total_price(); ?> <a href="../cart.php" style="color:orange">Go to Cart</a>

							<?php
							//if (!isset($_SESSION['customer_email'])){

								//echo "<a href='customer_login.php' style='color:orange'>Login</a>";

							//} else {

								//echo "<a href='../customer_logout.php' style='color:orange'>Logout</a>";
							//}

							?>
						</span>
					</div>
					-->

					<br><br><br>
					<div id="products_box">

						<!--Collapsible section of html for changing account details-->
						<button class="collapsible">Change my username</button>
						<div class="collapseContent">
							<br>
							<form action="customer_account.php" method="post" enctype="multipart/form-data">

								<table align="center" width="600">
									<tr>
										<td align="right">New username: </td>
										<td><input type="text" name="c_username" /></td>
									</tr>
									<tr>
										<td align="right">Password: </td>
										<td><input type="password" name="c_upass" /></td>
									</tr>
								</table>

								<input type="submit" name="change_username" value="Submit"/>
								<?php

								if (isset($_POST['change_username'])){

									$user = $_SESSION['customer_email'];
									$c_username = $_POST['c_username'];
									$c_password = $_POST['c_upass'];

									//Checks if the given username is the same to any other one already registered
									$usernameQuery = sprintf("select * from accounts where lower(username)= '%s' ", $c_username);
									$result = mysqli_query($con, $usernameQuery);
									$num_rows = mysqli_num_rows($result);

									//Tests if any matches were found when looking for already-registed username
									if($num_rows > 0)
									{
										echo "<script>alert('That username is already being used')</script>";

									} else {

										//Checks if the given password is correct
										$sel_customer = "select * from accounts where password = '$c_password' AND email = '$user'";
										$run = mysqli_query($con, $sel_customer);
										$check_customer = mysqli_num_rows($run);

										if($check_customer == 0) {

											echo "<script>alert('Password is incorrect; cannot change username')</script>";

										} else {
											//If the username is available and the password is correct, the username change goes through
											$update_c = "update accounts set username='$c_username' where email='$user'";
											$run_c = mysqli_query($con, $update_c);

											if($run_c) {
												echo "<script>alert('Username changed succesfully')</script>";
												echo "<script>window.open('customer_account.php','_self')</script>";
											} else {
												echo "<script>alert('Change was not succesful. Likely to character size')</script>";
											}
										}
									}

								}
								?>

							</form>
							<br>
						</div>

						<button class="collapsible">Change my email</button>
						<div class="collapseContent">
							<br>
							<form action="customer_account.php" method="post" enctype="multipart/form-data">

								<table align="center" width="600">
									<tr>
										<td align="right">New email: </td>
										<td><input type="text" name="c_email" /></td>
									</tr>
									<tr>
										<td align="right">Password: </td>
										<td><input type="password" name="c_epass" /></td>
									</tr>
								</table>

								<input type="submit" name="change_email" value="Submit"/>
								<?php

								if (isset($_POST['change_email'])){

									$user = $_SESSION['customer_email'];
									$c_email = $_POST['c_email'];
									$c_password = $_POST['c_epass'];

									//Checks if the given email is valid
									if(!(filter_var($c_email, FILTER_VALIDATE_EMAIL))){

										echo "<script>alert('Please enter a valid email')</script>";

									} else {
										//Checks if the given email is the same to any other one already registered
										$emailQuery = sprintf("select * from accounts where lower(email)= '%s' ", $c_email);
										$result = mysqli_query($con, $emailQuery);
										$num_rows = mysqli_num_rows($result);

										//Tests if any matches were found when looking for already-registed emails
										if($num_rows > 0)
										{
											echo "<script>alert('The given email is already being used')</script>";

										} else {
											//Lastly, checks if password was correct
											$sel_customer = "select * from accounts where password = '$c_password' AND email = '$user'";
											$run = mysqli_query($con, $sel_customer);
											$check_customer = mysqli_num_rows($run);

											if($check_customer == 0) {
												echo "<script>alert('Password is incorrect; cannot change email')</script>";

											} else {
												//updates the user's email
												$update_c = "update accounts set email='$c_email' where email='$user'";
												$run_c = mysqli_query($con, $update_c);

												if($run_c) {
													echo "<script>alert('Email changed succesfully')</script>";
													echo "<script>window.open('../customer_logout.php','_self')</script>";
												} else {
													echo "<script>alert('Change was not succesful. Likely to character size')</script>";
												}

											}

										}

									}
								}

							 	?>


							</form>
							<br>
						</div>

						<button class="collapsible">Change my password</button>
						<div class="collapseContent">
							<br>
							<form action="customer_account.php" method="post" enctype="multipart/form-data">

								<table align="center" width="600">
									<tr>
										<td align="right">Current password: </td>
										<td><input type="password" name="c_pass" /></td>
									</tr>
									<tr>
										<td align="right">New password: </td>
										<td><input type="password" name="c_npass" /></td>
									</tr>
									<tr>
										<td align="right">Confirm new password: </td>
										<td><input type="password" name="c_cnpass" /></td>
									</tr>
								</table>

								<input type="submit" name="change_pass" value="Submit"/>
								<?php

								if (isset($_POST['change_pass'])){

									$user = $_SESSION['customer_email'];
									$c_password = $_POST['c_pass'];
									$c_npassword = $_POST['c_npass'];
									$c_cnpassword = $_POST['c_cnpass'];

									//first, check if the given password is correct
									$sel_customer = "select * from accounts where password = '$c_password' AND email = '$user'";
									$run = mysqli_query($con, $sel_customer);
									$check_customer = mysqli_num_rows($run);

									if($check_customer == 0) {
										echo "<script>alert('Password is incorrect; cannot change password')</script>";

									} else {

										$correctNewPass = true;

										//Checks if the two given passwords are the same
										if($c_npassword != $c_cnpassword){
											$correctNewPass = false;
										}
										//checks if the password is of the correct length
										if((strlen($c_npassword) < 8) || (strlen($c_npassword) > 16) ){
											$correctNewPass = false;
										}
										//checks if the password is strong
										if((!preg_match("#[0-9]+#", $c_npassword)) || (!preg_match("#[a-z]+#", $c_npassword)) || (!preg_match("#[A-Z]+#", $c_npassword))){
											$correctNewPass = false;
										}

										if(!($correctNewPass == true))
										{
												echo "<script>alert('Please make sure the passwords match, and that they have at least one number, and one lower case and capital letter')</script>";
										} else {
											//If the password meets all the criteria, then the password is changed
											$update_c = "update accounts set password='$c_npassword' where email='$user'";
											$run_c = mysqli_query($con, $update_c);

											if($run_c) {
												echo "<script>alert('Password changed succesfully')</script>";
												echo "<script>window.open('customer_account.php','_self')</script>";
											}
										}

									}
								}
								?>

							</form>
							<br>
						</div>

						<button class="collapsible">Change my picture</button>
						<div class="collapseContent">
							<br>
							<form action="customer_account.php" method="post" enctype="multipart/form-data">
								<td align="right">Profile Image: </td>
								<td><input type="file" name="c_image" /></td>
								<input type="submit" name="change_pic" value="Change picture"/>

								<?php
								if (isset($_POST['change_pic'])){

									$user = $_SESSION['customer_email'];
									$c_image = $_FILES['c_image']['name'];
									$c_image_tmp = $_FILES['c_image']['tmp_name'];

									move_uploaded_file($c_image_tmp,"customer_images/$c_image");

									$update_c = "update accounts set user_image='$c_image' where email='$user'";

									$run_c = mysqli_query($con, $update_c);

									if($run_c) {
										echo "<script>alert('Changes done succesfully')</script>";
										echo "<script>window.open('customer_account.php','_self')</script>";
									} else {
										echo "<script>alert('Change was not succesful. Likely to character size')</script>";
									}
								}
								?>
							</form>
							<br>
						</div>
						<!--Collapsible section of html for changing account details ends here-->

						<!--script for collapsible sections of html-->
						<script>
							var coll = document.getElementsByClassName("collapsible");
							var i;

							for (i = 0; i < coll.length; i++) {
								 coll[i].addEventListener("click", function() {
									  this.classList.toggle("active");
									  var collapseContent = this.nextElementSibling;
									  if (collapseContent.style.display === "block") {
											collapseContent.style.display = "none";
									  } else {
											collapseContent.style.display = "block";
									  }
								 });
							}
						</script>
						<!--script ends here-->

					</div>

				</div>
		</div>
		<!--content_wrapper ends here-->

		<br><br>
		<div class="w3-black w3-center w3-padding-24">&copy; 2018 by Software Engineering TEAM 1</div>

	</div>
	<!--Main Container ends here-->

</body>
</html>
