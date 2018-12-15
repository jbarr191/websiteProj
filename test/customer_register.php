<!DOCTYPE>
<?php

include("functions/functions.php");
include("includes/db.php");
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

		  <?php
		  	if (isset($_POST['register'])){

		  		$isEmail = (boolean) true;
		  		$isNewEmail = (boolean) true;
		  		$correctPass = (boolean) true;
		  		$isNewUsername = (boolean) true;
		  		$c_name = $_POST['c_name'];
		  		$c_last = $_POST['c_last'];
		  		$c_email = strtolower(trim($_POST['c_email']));
		  		$c_username = $_POST['c_username'];
		  		$c_pass = $_POST['c_pass'];
		  		$c_cpass = $_POST['c_cpass'];
		  		$c_image = $_FILES['c_image']['name'];
		  		$c_image_tmp = $_FILES['c_image']['tmp_name'];

		  		//Checks if the given email is a legitimate email
		  		if(!(filter_var($c_email, FILTER_VALIDATE_EMAIL))){
		  			echo "<div style='text-align:center; color:orange'>Please enter a valid email.</div>";
		  			$isEmail = false;
		  		}

		  		//Checks if the given email is the same to any other one already registered
		  		$emailQuery = sprintf("select * from accounts where lower(email)= '%s' ", $c_email);
		  		$result = mysqli_query($con, $emailQuery);
		  		$num_rows = mysqli_num_rows($result);

		  		//Tests if any matches were found when looking for already-registed emails
		  		if($num_rows > 0)
		  		{
		  			echo "<div style='text-align:center; color:orange'>That email is already being used.</div>";
		  			$isNewEmail = false;
		  		}

		  		//Checks if the given username is the same to any other one already registered
		  		$usernameQuery = sprintf("select * from accounts where lower(username)= '%s' ", $c_username);
		  		$result = mysqli_query($con, $usernameQuery);
		  		$num_rows = mysqli_num_rows($result);

		  		//Tests if any matches were found when looking for already-registed username
		  		if($num_rows > 0)
		  		{
		  			echo "<div style='text-align:center; color:orange'>That username is already being used.</div>";
		  			$isNewUsername = false;
		  		}

		  		//Checks if the two given passwords are the same
		  		if($c_pass != $c_cpass){
		  			echo "<div style='text-align:center; color:orange'>Passwords do not match.</div>";
		  			$correctPass = false;
		  		}

		  		//checks if the password is of the correct length
		  		if((strlen($c_pass) < 8) || (strlen($c_pass) > 16) ){
		  			echo "<div style='text-align:center; color:orange'>Password must be between 8 and 16 characters long.</div>";
		  			$correctPass = false;
		  		}

		  		//checks if the password is strong
		  		if((!preg_match("#[0-9]+#", $c_pass)) || (!preg_match("#[a-z]+#", $c_pass)) || (!preg_match("#[A-Z]+#", $c_pass))){
		  			echo "<div style='text-align:center; color:orange'>Password must have a combination of at least one number, and one capital and lower case letter.</div>";
		  			$correctPass = false;
		  		}

		  		//creates a unique ID number for the account
		  		$id = rand(1,999999);
		  		$idQuery = sprintf("select * from accounts where lower(id_number)= '%s' ", $id);
		  		$result = mysqli_query($con, $idQuery);
		  		$num_rows = mysqli_num_rows($result);

		  		while($num_rows > 0)
		  		{
		  			$id = rand(1,999999);
		  			$idQuery = sprintf("select * from accounts where lower(id_number)= '%s' ", $id);
		  			$result = mysqli_query($con, $idQuery);
		  			$num_rows = mysqli_num_rows($result);
		  		}

		  		//Creates an account if all validations go through
		  		if($isEmail && $isNewEmail && $correctPass && $isNewUsername) {

		  			move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

		  			$insert_c = "insert into accounts (email, id_number, first_name, last_name, password, user_image, username) values ('$c_email', '$id', '$c_name','$c_last','$c_pass','$c_image', '$c_username')";

		  			$run_c = mysqli_query($con, $insert_c);

		  			if($run_c) {
		  				echo "<script>alert('registration successful')</script>";
						echo "<script>window.open('customer_login.php','_self')</script>";
		  			}
		  		}
		  	}
		   ?>

		  <div>

				<form action="customer_register.php" method="post" enctype="multipart/form-data">

					<table align="center" width="750">

					<tr align="center">
						<td colspan="6"><h2>Create an Acount</h2></td>
					</tr>
					<tr>
						<td align="right">First Name: </td>
						<td ><input type="text" name="c_name" /></td>
					</tr>
					<tr>
						<td align="right">Last Name: </td>
						<td ><input type="text" name="c_last" /></td>
					</tr>
					<tr>
						<td align="right">Customer Email: </td>
						<td><input type="text" name="c_email" /></td>
					</tr>
					<tr>
						<td align="right">Username: </td>
						<td ><input type="text" name="c_username" /></td>
					</tr>
					<tr>
						<td align="right">Password: </td>
						<td><input type="password" name="c_pass" /></td>
					</tr>
					<tr>
						<td align="right">Confirm Password: </td>
						<td><input type="password" name="c_cpass" /></td>
					</tr>
					<tr>
						<td align="right">Profile Image: </td>
						<td><input type="file" name="c_image" /></td>
					</tr>
					<tr align="center">
						<td colspan="6"><input type="submit" name="register" value="Create Account" /></td>
					</tr>

				</table>

			</form>

		</div>

		<div class="w3-black w3-center w3-padding-24">&copy; 2018 by Software Engineering TEAM 1</div>

	</div>
		<!--content_wrapper ends here-->

		<div id="footer">footer</div>

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
