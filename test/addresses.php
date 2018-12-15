<!DOCTYPE>
<?php

session_start();
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
		</style>
	</head>
<body class="w3-content" style="max-width:1200px">

	<!--Main Container starts here-->

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

		 <div style="background-color: #eee">
			 <h1 style="padding-left:22px; padding-top:2px">My addresses</h1>
			  <?php
			  //gets the user id from the database
			  $user = $_SESSION['customer_email'];
			  $result = mysqli_query($con,"select id_number from accounts where email = '$user'");
			  $row = mysqli_fetch_array($result);
			  $id = $row['id_number'];

			  $addressQuery = sprintf("select * from addresses where userId= '%s' ", $id);
			  $result = mysqli_query($con, $addressQuery);
			  $num_rows = mysqli_num_rows($result);

			  //Tests if any matches were found when looking for already-registed emails
			  if($num_rows == 0)
			  {
				  echo "<div style='text-align:center; color:orange'>You do not have any addresses saved.</div>";
			  } else {

				  while($current_row=mysqli_fetch_array($result))
				  {
					  echo "<table style='padding:8px'>";
					  $cur_addr = $current_row['streetAddr'];
					  $cur_city = $current_row['city'];
					  $cur_state = $current_row['state'];
					  $cur_zip = $current_row['zip'];
					  echo "</tr><td>$cur_addr</td></tr>";
					  echo "<tr><td>$cur_city, $cur_state $cur_zip</td></tr>";
					  echo "</tr></table>";
				  }
			  }
			  ?>
		  </div>
		  <br>

		  <?php

		  if (isset($_POST['add_address'])){

			  //gets all the data the user input
			  $address = $_POST['streetAddr'];
			  $zip = $_POST['zip'];
			  $city = $_POST['city'];
			  $state = $_POST['state'];

			  $anyEmpty = (boolean) false;
			  $wrongZip = (boolean) false;

			  //checks if address or city were left empty
			  if($address == '')
			  {
				  echo "<div style='text-align:center; color:orange'>Please enter a valid street address.</div>";
				  $anyEmpty = true;
			  }
			  if($city == '')
			  {
				  echo "<div style='text-align:center; color:orange'>Please enter a valid city name.</div>";
				  $anyEmpty = true;
			  }

			  //checks if the given zip code is valid
			  if( ((!preg_match("#[0-9]+#", $zip)) || (preg_match("#[a-z]+#", $zip)) || (preg_match("#[A-Z]+#", $zip)))
			  || (!(strlen($zip) == 5)))
			  {
				  echo "<div style='text-align:center; color:orange'>Please enter a valid zip code.</div>";
				  $wrongZip = true;
			  }

			  //if everything is correct, the address is added to the database
			  if((!$anyEmpty) && (!$wrongZip))
			  {
				  $insert_c = "insert into addresses (streetAddr, zip, city, state, userId) values ('$address', '$zip', '$city','$state','$id')";

				  $run_c = mysqli_query($con, $insert_c);

				  if($run_c)
				  {
					  echo "<script>alert('New address added')</script>";
					  echo "<script>window.open('addresses.php','_self')</script>";
				  }
			  }
		  }
		  ?>

		<!--content_wrapper starts here-->
		<div align="center">
		<button class="collapsible">Add a new shipping address</button>
		<div class="collapseContent">
			<br>
			<form action="addresses.php" method="post" enctype="multipart/form-data">

				<table align="center" width="600">
					<tr>
						<td align="right">Street Address: </td>
						<td><input type="text" name="streetAddr" style="width:300px"/></td>
						<td align="right">Zip Code: </td>
						<td><input type="text" name="zip" style="width:120px"/></td>
					</tr>
					<tr>
						<td align="right">City: </td>
						<td><input type="text" name="city" style="width:200"/></td>
					</tr>
					<tr>
						<td align="right">State: </td>
						<td><select name="state" style="width:200">
							<option value="AL">Alabama</option>
							<option value="AK">Alaska</option>
							<option value="AZ">Arizona</option>
							<option value="AR">Arkansas</option>
							<option value="CA">California</option>
							<option value="CO">Colorado</option>
							<option value="CT">Connecticut</option>
							<option value="DE">Delaware</option>
							<option value="DC">District Of Columbia</option>
							<option value="FL">Florida</option>
							<option value="GA">Georgia</option>
							<option value="HI">Hawaii</option>
							<option value="ID">Idaho</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="IA">Iowa</option>
							<option value="KS">Kansas</option>
							<option value="KY">Kentucky</option>
							<option value="LA">Louisiana</option>
							<option value="ME">Maine</option>
							<option value="MD">Maryland</option>
							<option value="MA">Massachusetts</option>
							<option value="MI">Michigan</option>
							<option value="MN">Minnesota</option>
							<option value="MS">Mississippi</option>
							<option value="MO">Missouri</option>
							<option value="MT">Montana</option>
							<option value="NE">Nebraska</option>
							<option value="NV">Nevada</option>
							<option value="NH">New Hampshire</option>
							<option value="NJ">New Jersey</option>
							<option value="NM">New Mexico</option>
							<option value="NY">New York</option>
							<option value="NC">North Carolina</option>
							<option value="ND">North Dakota</option>
							<option value="OH">Ohio</option>
							<option value="OK">Oklahoma</option>
							<option value="OR">Oregon</option>
							<option value="PA">Pennsylvania</option>
							<option value="RI">Rhode Island</option>
							<option value="SC">South Carolina</option>
							<option value="SD">South Dakota</option>
							<option value="TN">Tennessee</option>
							<option value="TX">Texas</option>
							<option value="UT">Utah</option>
							<option value="VT">Vermont</option>
							<option value="VA">Virginia</option>
							<option value="WA">Washington</option>
							<option value="WV">West Virginia</option>
							<option value="WI">Wisconsin</option>
							<option value="WY">Wyoming</option>
						</select></td>
					</tr>
					<tr>
						<td align="center"><input type="submit" name="add_address" value="Submit"/></td>
					</tr>
				</table>

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

			</form>
		</div>
	</div>
		<!--content_wrapper ends here-->

		<br><br>
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
