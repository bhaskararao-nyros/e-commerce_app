<?php 
	include("connection.php");
	if ($_POST) {
		if ($_POST['category_id'] != 0) {
			$cat_id = $_POST['category_id'];

			$result = mysqli_query($db, "SELECT id, name FROM categories WHERE c_id = '$cat_id' ");
			while($row = mysqli_fetch_assoc($result)) {
				
				echo '<option value="'.$row['id'].'" id="subcat_'.$row['id'].'">'.$row['name'].'</option>';
			}

		} else {
			echo '<option value="0">Select</option>';
		}
	}

 ?>
