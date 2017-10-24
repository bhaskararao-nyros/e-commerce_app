<?php 
	include("connection.php");

	$result = mysqli_query($db, "SELECT image FROM product_images GROUP BY product_id");
	while($row = mysqli_fetch_assoc($result)) {
		$data[] = array("images"=>$row['image']);
	}
	echo json_encode($data);
 ?>