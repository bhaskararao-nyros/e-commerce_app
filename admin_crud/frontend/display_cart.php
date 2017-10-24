<?php 
session_start();
	include("connection.php");
if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
{
	include("header.php");
 ?>
 <ul class="breadcrumb">
    <li><a href="home.php">Home</a></li>
    <li>Cart items</li>
 </ul>

 <h2>Shopping Cart</h2>
 <?php 

 	$user_id = $_SESSION['user_id'];
 	$result = mysqli_query($db, "SELECT id, product_id, image, name, price, quantity FROM cart_items WHERE user_id = '$user_id' GROUP BY product_id ");
 		$price = array();
	if (mysqli_num_rows($result) > 0) { 
 	while($row = mysqli_fetch_assoc($result)) { 
 		array_push($price, $row['price']) ?>

 		<div id="cartitems">
 	 		<div class="row">
			 	<div class="col-md-4">
			 		<a href="product_details.php?id=<?php echo $row['product_id']; ?>"><img src="../backend/uploads/<?php echo $row['image']; ?>" width="100px" height="130px"></a>
			 	</div>
			 	<div class="col-md-4">
			 		<a href="product_details.php?id=<?php echo $row['product_id']; ?>"><h4 class="text-info"><b><?php echo $row['name']; ?></b></h4></a>
			 	</div>
			 	<div class="col-md-2">
			 		<p class="text-danger"><big><b>&#8377; <?php echo $row['price']; ?></b></big></p>
			 	</div>
			 	<div class="col-md-2">
					<p><?php echo $row['quantity']; ?></p>
			 	</div>
			</div><br>  <!-- row ending -->
			<a class="btn" style="color: orangered;text-decoration: underline;" onclick="delCartItem(<?php echo $row['id']; ?>)">Remove item</a>
		</div><hr>
	<?php } ?>
	<h4 class="pull-right"><b>Subtotal(<?php echo $cart_count; ?> items):<span style="color: darkred;">&#8377; <?php echo array_sum($price); ?></span></b></h4> 
 	 	<?php } else { ?>
 	 	<div class="text-center">
 	 		<h2>Your cart is empty</h2>
 	 		<a href="home.php">Shop now >> </a>
 	 	</div>
 	 	<?php }
 	 		?>
 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script>
 	function delCartItem(itemid) {
 		var userid = '<?php echo $user_id; ?>';
 		$.ajax({
 			url:"del_cartitem.php",
 			type:"post",
 			dataType:"json",
 			data:{item_id:itemid, user_id:userid},
 			success:function(response) {
 				if (response.success == true) {
 					location.reload();
 				}
 			}
 		})
 	}
 </script>
 <?php }else{ 
header('location:login.php');
} ?>