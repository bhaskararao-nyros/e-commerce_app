<?php 
	include('connection.php');

	$userid = $_POST['product_id'];

	$output = array('success'=> false, 'messages'=> array());

	$query = mysqli_query($db, "SELECT image FROM product_images WHERE product_id={$userid}");
	// $row = mysqli_fetch_array($query);
	while($row = mysqli_fetch_array($query)) {
			$path = 'uploads/'.$row['image'];
			unlink($path);
	}
	// unlink($path);
	
	
	$connect = mysqli_query($db, "DELETE FROM baby_clothes WHERE id={$userid}");
	$connect1 = mysqli_query($db, "DELETE FROM product_images WHERE product_id={$userid}");
	

	if ($connect == true) {
		$output['success'] = true;
		$output['messages'] = " Product deleted successfully";
	} else {
		$output['success'] = flase;
		$output['messages'] = "Error in product deletion";
	}

	echo json_encode($output);
 ?>