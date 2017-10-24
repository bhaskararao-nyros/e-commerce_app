<?php 
	include('connection.php');

	$userid = $_POST['user_id'];

	$output = array('success'=> false, 'messages'=> array());

	$connect = mysqli_query($db, "DELETE FROM users WHERE id={$userid}");

	if ($connect == true) {
		$output['success'] = true;
		$output['messages'] = "User deleted successfully";
	} else {
		$output['success'] = flase;
		$output['messages'] = "Error in user deletion";
	}

	echo json_encode($output);
 ?>