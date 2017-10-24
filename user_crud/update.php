<?php 
	include("connection.php");

	if($_POST) {

		$validator = array('success'=> false, 'messages'=> array());

		$id = $_POST['user_id'];
		$name = $_POST['editName'];
		$email = $_POST['editEmail'];
		$phone = $_POST['editPhone'];
		$address = $_POST['editAddress'];
		
		$query = "UPDATE users SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = $id";
		$connect = mysqli_query($db, $query);

		if($connect == true) {
			$validator['success'] = true;
			$validator['messages'] = " User updated successfully";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Email already exists";
		}
		echo json_encode($validator);
	}

 ?>
