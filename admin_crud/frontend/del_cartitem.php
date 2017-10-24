<?php 
	include("connection.php");

	if ($_POST) {

		$validator = array('success'=> false, 'messages'=> array());

		$item_id = $_POST['item_id'];
		$user_id = $_POST['user_id'];
		$result = mysqli_query($db, "DELETE FROM cart_items WHERE id = '$item_id' AND user_id = '$user_id' ");

		if (mysqli_affected_rows($db) > 0) {

			$validator['success'] = true;
			$validator['messages'] = "Removed successfully";
		}
		echo json_encode($validator);
	}








 ?>