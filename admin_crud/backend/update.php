<?php session_start(); ?>
<?php 
	include("connection.php");

	if($_POST) {
		
		$validator = array('success'=> false, 'messages'=> array());

		$productname = $_POST['editproductname'];
		$specifications = $_POST['editspecifications'];
		$editmaincat = $_POST['editmaincatdd'];
		$editsubcat = $_POST['editsubcatdd'];
		$price = $_POST['editprice'];
		$id = $_POST['product_id'];
		

		// if(!empty($_FILES['file']['name'][0])) {
		// 	$old_imgs_exe = mysqli_query($db, "SELECT * FROM product_images WHERE product_id = $id");
		// 	while($irow = mysqli_fetch_assoc($old_imgs_exe)) 
		// 	{
		// 		$path = 'uploads/'.$irow['image'];
				
		// 		unlink($path);
				
		// 		$img_id = $irow['id'];
				
		// 		mysqli_query($db, "DELETE from product_images WHERE id = $img_id");
				
		// 	}


		if($_POST['imgs'])
		{



			$new_imgs = explode(',',rtrim($_POST['imgs'],","));
			
			foreach($new_imgs as $ni)
			{
					if (strpos($ni, 'temp') !== false) 
					{
						
						$fileTmpName = "/var/www/html/Tasks/php/php_db/assignment3/admin_crud/backend/".$ni;
						$filenames = explode('/',$ni);
						$fileDestination = '/var/www/html/Tasks/php/php_db/assignment3/admin_crud/backend/uploads/'.$filenames[1];
			
			 			if(file_exists($fileTmpName)) 
			 			{
							if(rename($fileTmpName, $fileDestination))
							{
								$productimage = $filenames[1];
								$query2 = "INSERT INTO product_images (product_id,image) VALUES ('$id','$productimage')";
								$connect1 = mysqli_query($db, $query2);
							}
						}	
					}
				}
			
		}
	
		
		$query = "UPDATE baby_clothes SET name='$productname',specification = '$specifications',price = '$price' , c_id = '$editmaincat', sc_id = '$editsubcat', date_edited = now() WHERE id = $id";
		
		
		$connect = mysqli_query($db, $query);


		if($connect == true) {
			$validator['success'] = true;
			$validator['messages'] = " Product updated successfully";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error in product updation";
		}
		echo json_encode($validator);
	}

 ?>
