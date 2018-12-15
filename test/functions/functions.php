
<?php
//fill the third parameter with whatever database server you're working on,
//or leave it blank if working on localhost
$con = mysqli_connect("localhost","root","","onlinebookstore");
echo"<link rel='stylesheet' href='styles/star.css' media='all' />";
//function getAccount($email, $password){

	//global $con;

	//$get_acc() = "select * from account";

	//$run_acc() = mysqli_query($con, $get_acc);
//}



/* script function to retrieve a visitor's IP address.
Source: http://www.phpf1.com/tutorial/get-ip-address.html
*/
function getIp() {

    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}

function cart(){

	// if add to cart button was clicked
	if(isset($_GET['add_cart'])){

		global $con;
		// get the user's IP address
		$ip = getIp();

		// get the id of the product that was added
		$pro_id = $_GET['add_cart'];

		// quantity defaults to 1
		$qty = 1;
		
		// check if the product has already been added for that user
		$check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id'";

		// execute query
		$run_check = mysqli_query($con, $check_pro);

		// if the query returns more than 0 items, do nothing
		if (mysqli_num_rows($run_check)>0){

			echo "";
		}
		else { // insert the product; since it does not already exist

			// insert product id, and the ip address of the user
			$insert_pro = "insert into cart (p_id, ip_add, qty) values ('$pro_id', '$ip', '$qty')";

			$run_pro = mysqli_query($con, $insert_pro);

			// refresh page and go back to index.php
			echo "<script>window.open('index.php','_self')</script>";
		}
	}
}

// Getting the total number of items in cart
function total_items(){

	global $con;

	// if add to cart is clicked, update total items
	if(isset($_GET['add_cart'])){

		$ip = getIP();

		// query the db to retrieve all items that belong to an ip
		$get_items = "select * from cart where ip_add='$ip'";

		$run_items = mysqli_query($con, $get_items);

		// get the number of rows
		$count_items = mysqli_num_rows($run_items);
	}
	else{
		$ip = getIP();

		// query the db to retrieve all items that belong to an ip
		$get_items = "select * from cart where ip_add='$ip'";

		$run_items = mysqli_query($con, $get_items);

		// get the number of rows
		$count_items = mysqli_num_rows($run_items);
	}

	echo $count_items;
}

// Getting the total running price of the items in cart
function total_price(){

	global $con;

	$total = 0;

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

			// store the price of each item into an array
			$product_price = array($pp_price['product_price']);

			// sum up all values in the array
			$values = array_sum($product_price);

			$total += $values;
		}
	}

	echo "$" .$total;
}

function getGens()
{
	global $con;

	$get_gens = "select * from genres";

	//run sql query
	$run_gens = mysqli_query($con, $get_gens);

	//fetch query and save to row_gens variable
	while ($row_gens = mysqli_fetch_array($run_gens))
	{
		//row_gen gets the data from table and stores it in variable
		$gen_id = $row_gens['gen_id'];
		$gen_type = $row_gens['gen_type'];
	// dynamic link
	echo "<li><a href='#'>$gen_type</a></li>";
	}
}

function getPro(){

	global $con;

	// query
	$get_pro = "select * from products";

	// run query on the connection
	$run_pro = mysqli_query($con, $get_pro);

	while($row_pro=mysqli_fetch_array($run_pro)){

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

					<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>


					<a href ='comments.php?pro_id=$pro_id' style = 'float:left'>Comments</a>

					<a href = 'details.php?pro_id=$pro_id' style = 'float:center;width:42px;height:42px'>&nbsp Details &nbsp</a>


				</div>
		"; 
	

	/*	echo "
		
			<div class="w3-col l3 s6">
			
				<div class="w3-container">
				
					<div class="w3-display-container">
					
						<span class="w3-tag w3-display-topleft">New</span>
						
						<img src="admin_area/product_images/$pro_image" style="width:100%">
						
						<div class="w3-display-middle w3-display-hover">
							<a href='index.php?add_cart=$pro_id'><button class="w3-button w3-black">Buy now <i class="fa fa-shopping-cart"></i></button>
						</div>
						
					</div>
					
					<p>$pro_title<br><b>$ $pro_price </b></p>
					
				</div>
			
			</div>
		
		";  */
	}
}



function getComments($product_id){
				global $con;
	
				$get_pro = "select * from comments where book_id = '$product_id'";
				
	
				$run_pro = mysqli_query($con, $get_pro);
	
				while($row_pro=mysqli_fetch_array($run_pro)){
		
					
					$user_id = $row_pro['user_id'];
					$comment_text = $row_pro['comment_text'];
					$rating = $row_pro['rating'];
					$anonymous = $row_pro['Anonymous'];
					
				
					if($rating =='0'){
						$rating = "No Rating";
					}
					
					if($rating == '1'){
						$rating = "<span class='star-icon full'>☆</span>
									<span class='star-icon'>☆</span>
									<span class='star-icon'>☆</span>
									<span class='star-icon'>☆</span>
									<span class='star-icon'>☆</span>";
					}
					else if($rating == '2'){
						$rating = "<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon'>☆</span>
									<span class='star-icon'>☆</span>
									<span class='star-icon'>☆</span>";
					}
					else if($rating == '3'){
						$rating = "<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon'>☆</span>
									<span class='star-icon'>☆</span>";
					}
					else if($rating == '4'){
						$rating = "<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon'>☆</span>";
					}
					else if($rating == '5'){
						$rating = "<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>
									<span class='star-icon full'>☆</span>";
					}

					if($anonymous =='1'){
						$user = "Anonymous";
					}
					else{
					
						
						$result = mysqli_query($con,"select username from accounts where id_number = '$user_id'");
						$row_img = mysqli_fetch_array($result);
						$user = $row_img['username'];
					}
					echo "
					
						<li style ='list-style:none;padding:20px;'>
						<h3 style = 'float:left;'>$user</h3>
						<p style = 'overflow-wrap: break-word;'>$comment_text</p>
						<h6 style = 'float:center;'>$rating</h6>
						
						<h3>-----------------------------------------------------------------------------------------</h3>
						</li>
					";	
				}
}
	
	
function getUserID(){
		global $con;
		if (isset($_SESSION['customer_email'])){

						$user = $_SESSION['customer_email'];

						$result = mysqli_query($con,"select id_number from accounts where email = '$user'");
						$row_img = mysqli_fetch_array($result);
						$userID = $row_img['id_number'];
						return $userID;

				}
		
}

function getAuthor(){

	global $con;

	// query
	$get_pro = "select * from products";

	// run query on the connection
	$run_pro = mysqli_query($con, $get_pro);

	while($row_pro=mysqli_fetch_array($run_pro)){

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

					<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>


					<a href ='comments.php?pro_id=$pro_id' style = 'float:left'>Comments</a>

					<a href = 'details.php?pro_id=$pro_id' style = 'float:center;width:42px;height:42px'>&nbsp Details &nbsp</a>


				</div>
		";
	}
}

function checkSearch($check){
	if(!$check)
		throw new Exception("<h2 style='padding:20px;'>Please select a sort method!</h2>");
	return true;
}

?>
