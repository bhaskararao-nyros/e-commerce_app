<?php 
	include("connection.php");

	if ($_POST) {
		
		$subcategory = $_POST['subcategory'];
		$sub_cat_id = $_POST['sub_cat_id'];

		$validator = array('success'=> false, 'messages'=> array());

		$result = mysqli_query($db, "UPDATE categories SET name = '$subcategory' WHERE id = '$sub_cat_id' ");

		if ($result) {
			$validator['success'] = true;
			$validator['messages'] = "Success";
		}
		echo json_encode($validator);
	}

 ?>