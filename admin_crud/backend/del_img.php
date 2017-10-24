<?php 
include('connection.php');

	if($_POST) {

		$validator = array('success'=> false, 'messages'=> array());

		$id = $_POST['image_id'];
		$imgsrc = mysqli_query($db, "SELECT image from product_images WHERE id=$id");
		$result = mysqli_fetch_assoc($imgsrc);

		$path = "uploads/".$result['image'];
		unlink($path);

		$connect = mysqli_query($db, "DELETE from product_images WHERE id=$id");

		if ($connect == true) {
			$validator['success'] = true;
		};

		echo json_encode($validator);
	}



 ?>