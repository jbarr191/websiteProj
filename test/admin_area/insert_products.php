<!DOCTYPE>	
<?php

include("includes/db1.php");

?>
<html>
	<head>
		<title> Inserting Product</title>
	</head>
	
<body bgcolor="skyblue">
	<!-- start of insert form -->
	<form action= "insert_products.php" method = "post" enctype = "multipart/form-data">
		<!-- start table  -->
		<table align ="center" width = "750" border="2" bgcolor="orange">
			<!-- insert into table  -->
			<tr align = "center">
				<td colspan="7"><h2>Insert New Post Here </td>
				
			</tr>
			
			<tr>
				<!-- column 1 -->
				<td align = "right"><b>Book Title:</b></td>
				<!-- column 2 -->
				<td><input type="text" name="product_title" size="60"/></td>
			</tr>
			<tr>
				<td align = "right"><b>Book Author:</b></td>
				<td><input type="text" name="product_author"/></td>
			</tr>
			<tr>
				<td align = "right"><b>Book Price:</b></td>
				<td><input type="text" name="product_price" /></td>
			</tr>
			<tr>
				<td align = "right"><b>Book Description:</b></td>
				<td><textarea name = "product_desc" cols ="20" rows="10"></textarea></td>
			</tr>
			<tr>
				<td align = "right"><b>Author Biography:</b></td>
				<td><textarea name = "product_bio" cols ="20" rows="10"></textarea></td>
			</tr>
			<tr>
				<td align = "right"><b>Book Genre:</b></td>
				<td>
					<select name = "product_genre">
						
						<option>Select a Genre</option>
						<!--query to get genres from database -->
						<?php
							//query copied from getGen() in functions.php 
							$get_gens = "select * from genres";
							
							
							$run_gens = mysqli_query($con, $get_gens);
							
						
							while ($row_gens = mysqli_fetch_array($run_gens))
							{
								$gen_id = $row_gens['gen_id'];
								$gen_type = $row_gens['gen_type'];
							
							echo "<option value='$gen_id'>$gen_type</option>";
							}
												
						?>
					</select>
				
				
				</td>
			</tr>
			<tr>
				<td align = "right"><b>Book Publisher:</b></td>
				<td><input type="text" name="product_pub" /></td>
			</tr>
			<tr>
				<td align = "right"><b>Book Release Date:</b></td>
				<td><input type="text" name="product_release" /></td>
			</tr>
			<tr>
				<td align = "right"><b>Book Cover:</b></td>
				<td><input type="file" name="product_image" /></td>
			</tr>
			<!--insert button -->
			<tr align="right">
				<td colspan="7"><input type="submit" name="insert_post" value= "Insert Now"/></td>
			</tr>
			
			
			
		
		</table>
	
	</form>

</body>

</html>

<?php
	//if something is submitted insert using post(), then execute
	if(isset($_POST['insert_post']))
	{
		//get text data from fields
		$product_title= $_POST['product_title'];
		$product_author= $_POST['product_author'];
		$product_desc= $_POST['product_desc'];
		$product_price= $_POST['product_price'];
		$product_bio= $_POST['product_bio'];
		$product_genre= $_POST['product_genre'];
		$product_pub= $_POST['product_pub'];
		$product_release= $_POST['product_release'];
		
		//getting the image from the field
		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];
		
		//used to upload product_image into product_images folder
		move_uploaded_file($product_image_tmp, "product_images/$product_image");
		
		
		$insert_products = "insert into products(product_title, product_image, product_author, product_desc, product_price, product_bio, product_genre, product_pub, product_release) 
											values('$product_title','$product_image','$product_author','$product_desc','$product_price','$product_bio','$product_genre','$product_pub','$product_release')";
		$insert_pro = mysqli_query($con, $insert_products);
		if($insert_pro)
		{
			echo "<script>alert('Product has been inserted!')</script>";
			//refresh page to avoid duplicate data
			echo "<script>window.open('insert_products.php','_self')</script>";
		}
	}



?>