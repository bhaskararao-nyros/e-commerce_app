<?php 
	include("connection.php");

	$userid = $_POST['user_id'];

	$query = mysqli_query($db, "SELECT * FROM users WHERE id = {$userid}");

	$result = mysqli_fetch_assoc($query);

	echo json_encode($result);
 ?>