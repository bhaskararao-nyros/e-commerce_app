<?php 
	include("connection.php");

	if ($_POST) {

		$category = $_POST['subcategory'];
		$cat_id = $_POST['cat_id'];

		$validator = array('success'=> false, 'messages'=> array());

		$result = mysqli_query($db, "INSERT INTO categories (name, c_id) VALUES ('$category', '$cat_id') ");

		if ($result) {
			$validator['success'] = true;
			$validator['messages'] = "Success";
		}
		echo json_encode($validator);
	}

 ?>