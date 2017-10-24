<?php 
	session_start();
	include("connection.php");

	if ($_POST) {

		$product_id = $_POST['product_id'];
		
		$query = "SELECT p.product_id, b.name, b.price, p.image FROM baby_clothes b JOIN product_images p ON b.id = p.product_id WHERE b.id ='$product_id' GROUP BY p.product_id";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_assoc($result);
		
		$user_id = $_POST['user_id'];
		$name = $row['name'];
		$price = $row['price'];
		$image = $row['image'];
		$quantity = 1;

		$check = mysqli_query($db, "SELECT * FROM cart_items WHERE user_id = '$user_id' AND product_id = '$product_id' ");
		$rows = mysqli_fetch_assoc($check);

		if ($rows > 0) {
			$update = mysqli_query($db, "UPDATE cart_items SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id' ");
		} else {
			$query1 = "INSERT INTO cart_items (user_id, product_id, name, price, image, quantity) VALUES ('$user_id', '$product_id', '$name', '$price', '$image', '$quantity')";

			$result1 = mysqli_query($db, $query1);
		}
		
		$result2 = mysqli_query($db, "SELECT * FROM cart_items WHERE user_id = '$user_id' ");
		while($row1 = mysqli_fetch_assoc($result2)) {
			$cart[] = $row1;
		}
		$cart_count = sizeof($cart);
		// $_SESSION['cart_count'] = $cart_count;

		if($result2) {
			echo $cart_count;
		}

	}


 ?>