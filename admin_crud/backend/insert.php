<?php 
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);


include('connection.php');

//INSERT DATA INTO THE DATABASE
if($_POST) {

	$validator = array('success'=> false, 'messages'=> array());

	$productname = $_POST['productname'];
	$specifications = $_POST['specifications'];
	$price = $_POST['price'];
	$addcat = $_POST['addselcatdd'];
	$addsubcat = $_POST['addsubcatdd'];
	

	$query1 = "INSERT INTO baby_clothes (name,specification,price,c_id,sc_id)VALUES('$productname','$specifications','$price','$addcat','$addsubcat')";
	$connect = mysqli_query($db, $query1);
	$fetch_id =mysqli_query($db,"SELECT id FROM baby_clothes WHERE name='$productname'");
	$row = mysqli_fetch_array($fetch_id);
	$product_id = $row['id'];
	
	$imgs = explode(",",rtrim($_POST['imgs'],","));
	
	
	

	for ($i=0; $i<count($imgs); $i++) { 
	
	$fileTmpName = "/var/www/html/Tasks/php/php_db/assignment3/admin_crud/backend/".$imgs[$i];
	$filenames = explode('/',$imgs[$i]);
	
		$fileDestination = '/var/www/html/Tasks/php/php_db/assignment3/admin_crud/backend/uploads/'.$filenames[1];
		 
		if(rename($fileTmpName, $fileDestination))
		{
			$productimage = $filenames[1];
	
			$query2 = "INSERT INTO product_images (product_id,image) VALUES ('$product_id','$productimage')";
			$connect1 = mysqli_query($db, $query2);
		}
		
	}
	if($connect == true && $connect1 == true) {
		$validator['success'] = true;
		$validator['messages'] = " Product added successfully";
	}
	echo json_encode($validator); 
}

?>
