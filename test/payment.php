<!DOCTYPE>
<?php

session_start();

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

			body {
				font-family: Arial;
				font-size: 17px;
				padding: 8px;
			}

			* {
				box-sizing: border-box;
			}

			.row {
				display: -ms-flexbox; /* IE10 */
				display: flex;
				-ms-flex-wrap: wrap; /* IE10 */
				flex-wrap: wrap;
				margin: 0 -16px;
			}

			.col-25 {
			-ms-flex: 25%; /* IE10 */
			flex: 25%;
			}

			.col-50 {
			-ms-flex: 50%; /* IE10 */
			flex: 50%;
			}

			.col-75 {
			-ms-flex: 75%; /* IE10 */
			flex: 75%;
			}

			.col-25,
			.col-50,
			.col-75 {
				padding: 0 16px;
			}

			.container {
				background-color: #f2f2f2;
				padding: 5px 20px 15px 20px;
				border: 1px solid lightgrey;
				border-radius: 3px;
			}

			#fname, #email, #adr, #city, #state, #zip, #cname, #ccnum, #expmonth, #expyear, #cvv {
				width: 100%;
				margin-bottom: 20px;
				padding: 4px;
				border: 1px solid #ccc;
				border-radius: 3px;
			}

			label {
				margin-bottom: 10px;
				display: block;
			}

			.icon-container {
				margin-bottom: 20px;
				padding: 7px 0;
				font-size: 24px;
			}

			.btn {
				background-color: #4CAF50;
				color: white;
				padding: 12px;
				margin: 10px 0;
				border: none;
				width: 100%;
				border-radius: 3px;
				cursor: pointer;
				font-size: 17px;
			}

			.btn:hover {
				background-color: #45a049;
			}

			.blue {
				color: #2196F3;
			}

			hr {
				border: 1px solid lightgrey;
			}

			span.price {
				float: right;
				color: grey;
			}

			/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
			@media (max-width: 800px) {
				.row {
					flex-direction: column-reverse;
				}
				.col-25 {
					margin-bottom: 20px;
				}
			}
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
		  <p class="w3-left" style="padding:8px; font-size:20px; padding-left:10px; font-family:Montserrat"><a href="index.php">Home</a></p>
 		 <?php
 		 if (isset($_SESSION['customer_email'])){

 			 echo "<p class='w3-left' style='padding:8px; font-size:20px; padding-left:20px; font-family:Montserrat'><a href='customer/customer_account.php'>My Account</a></p>";
 			 echo "<p class='w3-left' style='padding:8px; font-size:20px; padding-left:20px; font-family:Montserrat'><a href='customer_logout.php'>Log out</a></p>";
 		 } else {

 			 echo "<p class='w3-left' style='padding:8px; font-size:20px; padding-left:20px; font-family:Montserrat'><a href='customer_login.php'>Log In</a></p>";
 			 echo "<p class='w3-left' style='padding:8px; font-size:20px; padding-left:20px; font-family:Montserrat'><a href='customer_register.php'>Register</a></p>";
 		 }
 		 ?>
 		 <p class="w3-left" style="padding:8px; font-size:20px; padding-left:20px; font-family:Montserrat"><a href="cart.php">Shopping Cart </a><span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php total_items(); ?></b></span></p>
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
	  <div class="w3-display-container w3-container">

	  </div>

	  <div class="w3-row w3-grayscale">

	  <div class="col-25">

		<div class="container">
			<h4>Cart Summary <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php total_items(); ?></b></span></h4>
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


								// get the quantity from the cart
								$pro_qty = $p_price['qty'];

								// retrieve the product with the matching id from products table
								$pro_price = "select * from products where product_id = '$pro_id'";

								// run the above query
								$run_pro_price = mysqli_query($con, $pro_price);

								// while there's additional rows to fetch from the query results
								while ($pp_price = mysqli_fetch_array($run_pro_price)){

									// store the details of each item
									$product_price = array($pp_price['product_price'] * $pro_qty);

									$product_title = $pp_price['product_title'];

									$product_image = $pp_price['product_image'];

									$single_price = $pp_price['product_price'];

									$values = array_sum($product_price);

									$total += $values;

							?>
									<p><a href="#" class="blue"><?php echo $product_title; ?></a> <span class="price"><?php echo "$" . $single_price  . " x " . $pro_qty; ?></span></p>
						<?php   }
							}  // close brackets of above while loops
						?>
			<hr>
			<p>Total <span class="price" style="color:black"><b><?php echo "$" . $total;?></b></span></p>
		</div>
	  </div>


	  <form action="payment.php" method="post" enctype="multipart/form-data">

        <div class="row">
          <div class="col-50">
            <h3>Shipping Address</h3>
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="streetAddr" placeholder="542 W. 15th Street" required>
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York" required>

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
				<select id="state" name="state">
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
				</select>
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001" required>
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>

            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardsName" placeholder="John More Doe" required>
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardNum" placeholder="1111222233334444" required>
            <div class="row">
              <div class="col-50">
                <label for="expmonth">Exp Month</label>
				<select name="month" id="expmonth" style="width:65">
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
		  		</select>
              </div>
              <div class="col-50">
                <label for="expyear">Exp Year</label>
				<select name="year" id="expyear" style="width:80">
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
				</select>
              </div>
            </div>
          </div>

        </div>

        <input type="submit" name="add_order" value="Place Order" class="btn">
      </form>

	  <?php
		  $ip = getIp();

		  $id = getUserID();

		  if (isset($_POST['add_order'])){

			  //gets all the data the user input for address
			  $address = $_POST['streetAddr'];
			  $zip = $_POST['zip'];
			  $city = $_POST['city'];
			  $state = $_POST['state'];

			  $wrongZip = (boolean) false;

			  //gets all the data the user input for payment
			  $cardNum = $_POST['cardNum'];
			  $holderName = $_POST['cardsName'];
			  $month = $_POST['month'];
			  $year = $_POST['year'];

			  $wrongName = (boolean) false;
		      $wrongNum = (boolean) false;
			  $wrongExp = (boolean) false;

			  //checks if the given zip code is valid
			  if( ((!preg_match("#[0-9]+#", $zip)) || (preg_match("#[a-z]+#", $zip)) || (preg_match("#[A-Z]+#", $zip)))
			  || (!(strlen($zip) == 5)))
			  {
				  echo "<script>alert('Enter a valid zip code.')</script>";
				  $wrongZip = true;
			  }

			  //checks if cardholder name is valid
			  if(($holderName == '') || (preg_match("#[0-9]+#", $holderName)) )
			  {
				  echo "<script>alert('Enter a valid cardholder name.')</script>";
				  $wrongName = true;
			  }

			  //checks if card number and expiration are valid
			  if( ((!preg_match("#[0-9]+#", $cardNum)) || (preg_match("#[a-z]+#", $cardNum)) || (preg_match("#[A-Z]+#", $cardNum)))
			  || (!(strlen($cardNum) == 16)))
			  {
				  echo "<script>alert('Enter a valid card number.')</script>";
				  $wrongNum = true;
			  }

			  if(($month < 4) && ($year == 2018))
			  {
				  echo "<script>alert('Enter a valid card expiration date.')</script>";
				  $wrongExp = true;
			  }

			  // if everything was entered properly
			  if((!$wrongName) && (!$wrongNum) && (!$wrongExp) && (!$wrongZip))
			  {
				  global $con;

				  // query the db to retrieve all items in cart
				  $cart_items = "select * from cart where ip_add='$ip'";

				  // run the above query
				  $run_cart_items = mysqli_query($con, $cart_items);

				  // traverse cart items
				  while($walker=mysqli_fetch_array($run_cart_items))
				  {
					  // get the product id & quantity from the cart
					  $pro_id = $walker['p_id'];
					  $pro_quantity = $walker['qty'];

					  // insert the product into the purchase table
					  $insert_purchase = "insert into purchase (user_id, book_id) values ('$id','$pro_id')";
					  $run_insert_purchase = mysqli_query($con, $insert_purchase);
					  
					  // update purchases count for this item in products table
					  $update_products = "update products set purchases=purchases+'$pro_quantity' where product_id='$pro_id'";
					  $run_update_products = mysqli_query($con, $update_products);
					  
					  // delete the product from cart
					  $empty_cart = "delete from cart where p_id='$pro_id' and ip_add='$ip'";
					  $run_empty_cart = mysqli_query($con, $empty_cart);
				  }

				  echo "<script>alert('Purchase order has been placed')</script>";
				  echo "<script>window.open('index.php','_self')</script>";
			  }
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
