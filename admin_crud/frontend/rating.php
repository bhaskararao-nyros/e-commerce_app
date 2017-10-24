<?php 
	include("connection.php");

	if($_POST) {


		// $validator = array('success'=> false, 'rating'=> array());

		$userid = $_POST['user_id'];
		$productid = $_POST['product_id'];
		$rating = $_POST['rating'];
		$review = $_POST['review'];

		

		$query = "INSERT INTO rating (user_id, product_id, rating, review) VALUES ('$userid', '$productid', '$rating', '$review')";
		mysqli_query($db, $query);

		echo json_encode("Success");
	}

 ?>