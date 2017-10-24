<?php 
	include("connection.php");

	if ($_POST) {
		
		$category = $_POST['category'];
		$id = $_POST['item_id'];

		$validator = array('success'=> false, 'messages'=> array());

		$result = mysqli_query($db, "UPDATE categories SET name = '$category' WHERE id = '$id' ");

		if ($result) {
			$validator['success'] = true;
			$validator['messages'] = "Success";
		}
		echo json_encode($validator);
	}

 ?>