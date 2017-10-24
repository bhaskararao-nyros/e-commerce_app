<?php 
	include("connection.php");
if ($_POST) {

	$name = $_POST['value'];
	$data = array();

	$result = mysqli_query($db, "SELECT name FROM baby_clothes WHERE name LIKE '%".$name."%' ");
	$rows = mysqli_num_rows($result);
	if ($rows > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			array_push($data, $row['name']);
		}
	}
	 else {
		$result = mysqli_query($db, "SELECT name FROM baby_clothes");
		while($row = mysqli_fetch_assoc($result)) {
			array_push($data, $row['name']);
		}
	}
	echo json_encode($data);
}
 ?>