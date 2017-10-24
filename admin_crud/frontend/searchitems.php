<?php session_start();
	include("connection.php");
	if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
	{
	include("header.php"); ?>
	<?php 

		$searchval = $_GET['search'];
		$result = mysqli_query($db, "SELECT name FROM baby_clothes");
		while($rows = mysqli_fetch_assoc($result)) {
			$names[] = $rows['name'];
		}
		$matches = preg_grep("/$searchval/", $names);
		if (!empty($matches)) {
	?>

	<h4>You searched for: "<?php echo $_GET['search']; ?>"</h4><hr>
	<div class="row" id="productImages">
	<?php 

	if (isset($_GET['term'])) {

	    $term = $_GET['term'];
	    
	    $query = "SELECT b.name, b.price, p.image, p.product_id FROM baby_clothes b JOIN product_images p ON b.id = p.product_id WHERE name LIKE '%".$searchval."%' GROUP BY p.product_id";
	    $result = mysqli_query($db, $query);
		while($row = mysqli_fetch_assoc($result)) {

		$id = $row["product_id"];

  		$query1 = "SELECT * FROM rating WHERE product_id = '$id' ";

    	$result2 = mysqli_query($db, $query1);

	      if(mysqli_num_rows($result2) > 0) {

	      	$count_rows = mysqli_num_rows($result2);

	        while($row2 = mysqli_fetch_assoc($result2)) {
	          $user_rating[] = $row2['rating'];
	        }
	        
	       $mix_rating = round(array_sum($user_rating) / sizeof($user_rating) * 2) / 2;
	      } else {
	        $mix_rating = 0;
	      }

			echo '
				<div class="col-md-3">
      			<div class="panel panel-default card" id="newproducts">
      			<a href="product_details.php?id='.$row["product_id"].' ">
				<img src="../backend/uploads/'.$row['image'].'" width="250px" height="300px">
		        <p>'.$row['name'].'</p>
		        </a>
		        <div id="rateYo"></div>
		        <input type="hidden" name="rateyoid" value="'.$mix_rating.'" id="mixrating"><br>
		        <span><strong>&#8377;'.$row['price'].'</strong></span></div></div>';

		}
	}

	?>
	</div>

	<?php 
	} else { ?>
			<h3>Your search "<b><?php echo $_GET['search']; ?></b>" did not match any products.</h3>
			<h4><b>Try something like</b></h4>
			<ul>
				<li>Using more general terms</li>
				<li>Checking your spelling</li>
			</ul>
	<?php } ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="./assets/js/jquery.rateyo.js"></script>
	<script>
	$(document).ready(function() {
		$("#searchbox").val("<?php echo $_GET['search']; ?>");
		$("#dropdown_btn").val("<?php echo $_GET['term']; ?>")
	});

	$( "input[name='rateyoid']" ).each( function() {
	  var current_rating = $(this).val();	
	  $(this).parent().find('div').rateYo({
		  starWidth: '15px',
		  halfStar: true,
  		  readOnly: true,
		  rating: current_rating
	  });
    });
	</script>
	<?php }else{ 
header('location:login.php');
} ?>
