<?php 
	include("connection.php");

	if ($_POST) {
		
		$id = $_POST['item_id'];

		$validator = array('success'=> false, 'messages'=> array());

		$result = mysqli_query($db, "DELETE FROM categories WHERE id = '$id' ");

		if ($result) {
			$validator['success'] = true;
			$validator['messages'] = "Success";
		}
		echo json_encode($validator);
	}

 ?>