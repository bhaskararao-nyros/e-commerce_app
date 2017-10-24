<?php 
	include("connection.php");

	if ($_POST) {
		
		$sub_cat_id = $_POST['sub_cat_id'];

		$validator = array('success'=> false, 'messages'=> array());

		$result = mysqli_query($db, "DELETE FROM categories WHERE id = '$sub_cat_id' ");

		if ($result) {
			$validator['success'] = true;
			$validator['messages'] = "Success";
		}
		echo json_encode($validator);
	}

 ?>