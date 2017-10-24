<?php session_start(); ?>
<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);?>
<?php 
	include("connection.php");

	$fields = array();

	$userid = $_POST['pro_id'];

	$query = mysqli_query($db, "SELECT * FROM baby_clothes WHERE id = {$userid}");

	while($result = mysqli_fetch_assoc($query)) {
		array_push($fields, $result);
	}


	$imgs = array();

	$query1 = mysqli_query($db, "SELECT image FROM product_images WHERE product_id = '".$fields[0]['id']."'");

	while($result1 = mysqli_fetch_assoc($query1)) {
		array_push($imgs, $result1['image']);
	}
	$_SESSION['image'] = $imgs;
	echo json_encode(array('data'=>$fields,'imgs'=>$imgs));
// echo "okkkkkkkk";
 ?>
