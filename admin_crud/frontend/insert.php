<?php session_start();
	include("connection.php");

	if($_POST) {
		
		$validator = array('success'=> false, 'messages'=> array());

		$name = $_POST['user']['name'];
		$mobile = $_POST['user']['mobile'];
		$email = $_POST['user']['email'];
		$password = $_POST['user']['password'];

		$query = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$mobile', '$password')";
		$result = mysqli_query($db, $query);

		if($result == true) {

			// $query1 = "SELECT name FROM users ORDER BY id DESC LIMIT 1";
			// $result1 = mysqli_query($db, $query1);
			// $rows = mysql_fetch_assoc($result1);
			// print_r($rows);
			$_SESSION['user'] = 1;
			$_SESSION['name'] = $_POST['user']['name'];
			$validator['success'] = true;
			$validator['messages'] = "Signed Up successfully";
		}
		echo json_encode($validator);
	}

 ?>