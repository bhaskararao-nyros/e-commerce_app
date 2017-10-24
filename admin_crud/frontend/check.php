<?php 
	session_start();
	include("connection.php");

	if($_POST) {

		$validator = array('success'=> false, 'messages'=> array());

		$data = array();
		$email = $_POST['user']['email'];
		$password = $_POST['user']['password'];

		$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

		$result = mysqli_query($db, $query);

		$rows = mysqli_fetch_assoc($result);

		if($rows > 0) {

			$_SESSION['user'] = 1;
			$_SESSION['name'] = $rows['name'];
			$_SESSION['user_id'] = $rows['id'];
			$validator['success'] = true;
			$validator['messages'] = "Login successfull";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Login failed";
		}
		echo json_encode($validator);
	}

 ?>
