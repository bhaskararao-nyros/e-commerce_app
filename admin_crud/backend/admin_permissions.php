<?php 
	session_start();
	include("connection.php");

	$role_id = $_POST['manager_role_id'];
	$action_id = $_POST['manager_action_id'];
	$status = $_POST['status'];
	
	$check = "SELECT * FROM role_permissions WHERE role_id = '$role_id' AND action_id = '$action_id'";
	$results = mysqli_query($db, $check);
	$rows = mysqli_num_rows($results);

	if($rows > 0 ) {
		mysqli_query($db, "UPDATE role_permissions SET status = '$status' WHERE role_id = '$role_id' AND action_id = '$action_id'");
	}
	else
	{
		$query = "INSERT INTO role_permissions (role_id, action_id, status) VALUES ('$role_id', '$action_id', '$status')";
		mysqli_query($db, $query);
	}

