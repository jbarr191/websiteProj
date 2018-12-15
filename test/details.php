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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="styles/star.css" media="all" />
		<style>
			.w3-sidebar a {font-family: "Roboto", sans-serif}
			body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}

				/* Style the Image Used to Trigger the Modal */
				#myImg {
					border-radius: 5px;
					cursor: pointer;
					transition: 0.3s;
				}

				#myImg:hover {opacity: 0.7;}

				/* The Modal (background) */
				.modal {
					display: none; /* Hidden by default */
					position: fixed; /* Stay in place */
					z-index: 1; /* Sit on top */
					padding-left: 100px; /* Location of the box */
					left: 0;
					top: 0;
					width: 100%; /* Full width */
					height: 100%; /* Full height */
					overflow: auto; /* Enable scroll if needed */
					background-color: rgb(0,0,0); /* Fallback color */
					background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
				}

				/* Modal Content (Image) */
				.modal-content {
					margin: auto;
					display: block;
					width: 80%;
					max-width: 700px;
				}

				/* Caption of Modal Image (Image Text) - Same Width as the Image */
				#caption {
					margin: auto;
					display: block;
					width: 80%;
					max-width: 700px;
					text-align: center;
					color: #ccc;
					padding: 10px 0;
					height: 150px;
				}

				/* Add Animation - Zoom in the Modal */
				.modal-content, #caption {
					animation-name: zoom;
					animation-duration: 0.6s;
				}

				@keyframes zoom {
					from {transform:scale(0)}
					to {transform:scale(1)}
				}

				/* The Close Button */
				.close {
					position: absolute;
					top: 15px;
					right: 35px;
					color: #f1f1f1;
					font-size: 40px;
					font-weight: bold;
					transition: 0.3s;
				}

				.close:hover,
				.close:focus {
					color: #bbb;
					text-decoration: none;
					cursor: pointer;
				}

				/* 100% Image Width on Smaller Screens */
				@media only screen and (max-width: 700px){
					.modal-content {
						width: 100%;
					}
				}
		</style>
	</head>
<body class="w3-content" style="max-width:1200px">

	<!-- Sidebar/menu -->
	<nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="width:250px" id="mySidebar">
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
					$ratingaverage = $row_pro['ratings'];

					if($ratingaverage =='0'){
						$ratingaverage = "No Rating";
					}

					else if($ratingaverage >= '1' and $ratingaverage < '2'){
						$ratingaverage = "<span class='star-icon full'>☆</span>
									<span class='star-icon'>☆</span>
									<span class='star-icon'>☆</span>
									<span class='star-icon'>☆</span>
									<span class='star-icon'>☆</span>";
					}
					else if($ratingaverage >= '2' and $ratingaverage < '3'){
						$ratingaverage = "<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon'>☆</span>
									<span class='star-icon'>☆</span>
									<span class='star-icon'>☆</span>";
					}
					else if($ratingaverage >= '3' and $ratingaverage < '4'){
						$ratingaverage = "<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon'>☆</span>
									<span class='star-icon'>☆</span>";
					}
					else if($ratingaverage >= '4' and $ratingaverage < '5'){
						$ratingaverage = "<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon'>☆</span>";
					}
					else if($ratingaverage >= '5'){
						$ratingaverage = "<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>";
					}

					?>

					<!-- Trigger the Modal -->

					<img id="myImg" src="admin_area/product_images/<?php echo $pro_image; ?>" alt="<?php echo $pro_title; ?>" width="187" height="250">

						<!-- The Modal -->
					<div id="myModal" class="modal">

					  <!-- The Close Button -->
					  <span class="close">&times;</span>

					  <!-- Modal Content (The Image) -->
					  <img class="modal-content" id="<?php echo $pro_image; ?>">

					  <!-- Modal Caption (Image Text) -->
					  <div id="caption"></div>

					</div>
					<?php
					echo "

						<div>

							<h3>$pro_title</h3>
						    <h3>$ratingaverage</h3>

							<p><b> Price: $ $pro_price  </b></p>

							<b> Author: </b><a href = 'authors.php?pro_author=$pro_author' style = 'float:center;width:42px;height:42px'>&nbsp$pro_author&nbsp</a>

							<br><b>Book Description : </b>
							<p align='center'>$pro_desc</p>
							<br><b>Author Biography : </b>
							<p align='center'>$pro_bio</p>
							<br><b>Genre : </b>
							<p align='center'>$pro_gen</p>

							<br>


							<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>


							<div style='padding-left:100px'><a href = 'index.php? style = 'float:center;height:42px;'>&nbspGo Back&nbsp</a></div>


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
				<td><input type="text" name="comment_text" size="20" maxlength="200"/></td>
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
			</table>

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

					//update rating
					$rate = mysqli_query($con, "select AVG(rating) from comments where book_id = '$product_id' and rating != '0'" );
					$rateAvg = $rate ->fetch_array(MYSQLI_NUM);

					$run = mysqli_query($con, "UPDATE products SET ratings = $rateAvg[0] WHERE product_id = $product_id" );
					$bookinfo = mysqli_num_rows($run);



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

			// Get the modal
			var modal = document.getElementById('myModal');

			// Get the image and insert it inside the modal - use its "alt" text as a caption
			var img = document.getElementById('myImg');
			var modalImg = document.getElementById("<?php echo $pro_image; ?>");
			var captionText = document.getElementById("caption");
			img.onclick = function(){
				modal.style.display = "block";
				modalImg.src = this.src;
				captionText.innerHTML = this.alt;
			}

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
				modal.style.display = "none";
			}


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
