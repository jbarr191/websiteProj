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
			  <h1 style="padding-left:22px; padding-top:2px">My cards</h1>
				<?php
				//gets the user id from the database
				$user = $_SESSION['customer_email'];
				$result = mysqli_query($con,"select id_number from accounts where email = '$user'");
				$row = mysqli_fetch_array($result);
				$id = $row['id_number'];

				$addressQuery = sprintf("select * from cards where userId= '%s' ", $id);
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
						$cur_card = $current_row['cardNum'];
						$output_card = substr($cur_card, -4);
						$cur_month = $current_row['expMo'];
						$cur_year = $current_row['expYr'];
						$cur_name = $current_row['cardHolderName'];

						echo "</tr><td>XXXX-XXXX-XXXX-$output_card</td></tr>";
						echo "<tr><td>$cur_name</td></tr>";
						if($cur_month < 10)
						{
							echo "<tr><td>Expires: 0$cur_month/$cur_year</td></tr>";
						}
						else
						{
							echo "<tr><td>Expires: $cur_month/$cur_year</td></tr>";
						}
						echo "</tr></table>";
					}
				}
				?>
			</div>
			<br>

		  <div align="center">

			  <?php

			  if (isset($_POST['add_card'])){

				  //gets all the data the user input
				  $cardNum = $_POST['cardNum'];
				  $holderName = $_POST['cardsName'];
				  $month = $_POST['month'];
				  $year = $_POST['year'];

				  $wrongName = (boolean) false;
				  $wrongNum = (boolean) false;
				  $wrongExp = (boolean) false;

				  //checks if address or city were left empty
				  if(($holderName == '') || (preg_match("#[0-9]+#", $holderName)) )
				  {
					  echo "<div style='text-align:center; color:orange'>Name is not valid.</div>";
					  $wrongName = true;
				  }

				  //checks if the given zip code is valid
				  if( ((!preg_match("#[0-9]+#", $cardNum)) || (preg_match("#[a-z]+#", $cardNum)) || (preg_match("#[A-Z]+#", $cardNum)))
				  || (!(strlen($cardNum) == 16)))
				  {
					  echo "<div style='text-align:center; color:orange'>Card number is not valid.</div>";
					  $wrongNum = true;
				  }

				  if(($month < 4) && ($year == 2018))
				  {
					  echo "<div style='text-align:center; color:orange'>Experation date is not valid.</div>";
					  $wrongExp = true;
				  }

				  //if everything is correct, the address is added to the database
				  if((!$wrongName) && (!$wrongNum) && (!$wrongExp))
				  {
					  $insert_c = "insert into cards (cardNum, expMo, expYr, cardHolderName, userId) values ('$cardNum', '$month', '$year','$holderName','$id')";

					  $run_c = mysqli_query($con, $insert_c);

					  if($run_c)
					  {
						  echo "<script>alert('New card added')</script>";
						  echo "<script>window.open('customer_cards.php','_self')</script>";
					  }
				  }
			  }
			  ?>

			  <button class="collapsible">Add a new credit card</button>
			  <div class="collapseContent">
				  <br>
				  <form action="customer_cards.php" method="post" enctype="multipart/form-data">

		  				<table align="center" width="600">
		  					<tr>
		  						<td align="right">Credit card number: </td>
		  						<td><input type="text" name="cardNum" style="width:200px"/></td>
		  					</tr>
		  					<tr>
		  						<td align="right">Cardholder's name: </td>
		  						<td><input type="text" name="cardsName" style="width:250px"/></td>
		  					</tr>
		  					<tr>
		  						<td align="right">Exp. Month: </td>
		  						<td><select name="month" style="width:65">
		  							<option value="01">01</option>
		  							<option value="02">02</option>
		  							<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
		  						</select></td>
							</tr>
							<tr>
								<td align="right">Exp. Year: </td>
								<td><select name="year" style="width:80">
									<option value="2018">2018</option>
									<option value="2019">2019</option>
									<option value="2020">2020</option>
									<option value="2021">2021</option>
									<option value="2022">2022</option>
									<option value="2023">2023</option>
									<option value="2024">2024</option>
									<option value="2025">2025</option>
									<option value="2026">2026</option>
									<option value="2027">2027</option>
									<option value="2028">2028</option>
									<option value="2029">2029</option>
									<option value="2030">2030</option>
									<option value="2031">2031</option>
									<option value="2032">2032</option>
									<option value="2033">2033</option>
									<option value="2034">2034</option>
									<option value="2035">2035</option>
									<option value="2036">2036</option>
									<option value="2037">2037</option>
									<option value="2038">2038</option>
								</select></td>
		  					</tr>
		  					<tr>
		  						<td align="center"><input type="submit" name="add_card" value="Submit"/></td>
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
