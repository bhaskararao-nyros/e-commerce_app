<?php 
include('connection.php');

//INSERT DATA INTO THE DATABASE
if($_POST) {

	$validator = array('success'=> false, 'messages'=> array());

	$name = $_POST['username'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	
	$query = "INSERT INTO users (name, email, phone, address) VALUES ('$name','$email','$phone','$address')";
	$connect = mysqli_query($db, $query);

	if($connect == true) {
		$validator['success'] = true;
		$validator['messages'] = " User added successfully";
	} else {
		$validator['success'] = false;
		$validator['messages'] = " Entered email is already exists.....try with new one";
	}
	echo json_encode($validator);
} ?>