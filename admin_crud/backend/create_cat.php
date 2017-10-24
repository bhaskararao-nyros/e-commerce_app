<?php 
	include("connection.php");

	if ($_POST) {
		
		$category = $_POST['category'];

		$validator = array('success'=> false, 'messages'=> array());

		$result = mysqli_query($db, "INSERT INTO categories (name) VALUES ('$category') ");

		if ($result) {
			$validator['success'] = true;
			$validator['messages'] = "Success";
		}
		echo json_encode($validator);
	}

 ?>