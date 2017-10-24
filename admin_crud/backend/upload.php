<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);?>
<?php 
 	if ($_POST) {
 		$imgs = array();

 		for ($i=0; $i <count($_FILES['file']['name']) ; $i++) { 
 			$filetmp = $_FILES['file']['tmp_name'][$i];
 			$filename = $_FILES['file']['name'][$i];
 			$fileExt = explode('.', $filename);
			$fileActualExt = strtolower(end($fileExt));
 			$file_name = uniqid().".".$fileActualExt;
 			$filepath = "temp/".$file_name;
 			move_uploaded_file($filetmp, $filepath);
 			
 			array_push($imgs,$filepath);
 			
 		}
 		
 		echo json_encode(array('imgs'=>$imgs));
 		
 	}



























  ?>

