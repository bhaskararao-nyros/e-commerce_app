<?php 
	include("connection.php");

	if (isset($_POST['limit'], $_POST['start'])) {

		$query = "SELECT b.name, b.price, p.image, p.product_id FROM baby_clothes b JOIN product_images p ON b.id = p.product_id GROUP BY p.product_id DESC LIMIT ".$_POST['start'].", ".$_POST['limit']."";

		$result = mysqli_query($db, $query);
		while($row = mysqli_fetch_assoc($result)) {
		
			
  		 $id = $row["product_id"];

  		$query1 = "SELECT * FROM rating WHERE product_id = '$id' ";

    	$result2 = mysqli_query($db, $query1);

	      if(mysqli_num_rows($result2) > 0) {

	        while($row2 = mysqli_fetch_assoc($result2)) {
	          $user_rating[] = $row2['rating'];
	        }
	        
	       $mix_rating = round(array_sum($user_rating) / sizeof($user_rating) * 2) / 2;
	      } else {
	        $mix_rating = 0;
	      }
		
			echo '
				<div class="col-md-3">
      			<div class="panel panel-default" id="offerimages">
      			<a href="product_details.php?id='.$row["product_id"].' ">
				<img src="../backend/uploads/'.$row['image'].'" width="250px" height="300px"><br><br>
				<span class="label label-default">Offer</span>
		        <p>'.$row['name'].'</p>
		        </a>
		        <div id="rateYo"></div>
		        <input type="hidden" name="rateyoid" value="'.$mix_rating.'" id="mixrating"><br>
		        <span><strong>&#8377;'.$row['price'].'</strong></span></div></div>';

		}

	}
 ?>
