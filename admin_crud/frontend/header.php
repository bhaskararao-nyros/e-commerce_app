
<!DOCTYPE html>
<html ng-app="myApp">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="AngularJS Demo Features">
    <meta name="author" content="Bhaskararao Gummidi">
    <link rel="icon" type="icon" href="./assets/images/icon.jpg">
	<title>Shopping cart</title>
	<link rel="stylesheet" href="./assets/css/jquery.rateyo.css">
  <link rel="stylesheet" href="./assets/css/xzoom.css" media="all">
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
<div class="container">
 <div id="cart">
  <div class="pull-left">
  	<img src="./assets/images/index.png" width="200px" height="50px;">
  </div>
  <div class="pull-right">
  	<?php
  		if(isset($_SESSION['user']))
  		{
  			if($_SESSION['user'] == 1)
  			{
           echo "Welcome, ".$_SESSION['name'];
  				 echo ' <a href="" type="submit" class="btn btn-primary" onclick="getUrl()">Logout</a>';
  			}
  			else
  			{
  				echo '<a href="login.php" class="btn btn-default"><span class="glyphicon glyphicon-lock"></span> Login</a>';		
  			}
  		}
  		else
  		{
  			echo '<a href="login.php" class="btn btn-default"><span class="glyphicon glyphicon-lock"></span> Login</a>';		
  		}
  	
  	?>
  	<?php 
    if (isset($_SESSION['user_id'])) {
       $user_id = $_SESSION['user_id'];
        $result2 = mysqli_query($db, "SELECT * FROM cart_items WHERE user_id = '$user_id' ");
        while($row1 = mysqli_fetch_assoc($result2)) {
          $cart[] = $row1;
        }
        if (!empty($cart)) {
            $cart_count = sizeof($cart);
             ?>
            <a class="btn btn-info" href="display_cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge" id="cartcount"><?php echo $cart_count; ?></span></a> 
            <?php 
        } else {
          $cart_count = 0;
             ?>
            <a class="btn btn-info" href="display_cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge" id="cartcount"><?php echo $cart_count; ?></span></a>
       <?php } ?>
    <?php
    } else { ?>
    <a class="btn btn-info" href="display_cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a>
    <?php } ?>
    
  </div>
 </div><br><br>  <!-- cart ending -->
 <nav class="navbar navbar-default">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php"><span class="glyphicon glyphicon-home"></span></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="new_products.php">New collection</a></li>
      <li><a href="festive_offer.php">Special offers</a></li>
      <!-- <li><a href="#">Special</a></li>
      <li><a href="#">Contact</a></li> -->
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <li>
       <select id="dropdown_btn" onchange="selectVal()" class="form-control">
       <option>Search by category</option>
        <option value="suit">Sets & Suits</option>
        <option value="frock">Frocks</option>
        <option value="party">Party Wear</option>
        <option value="top">Tops & Tees</option>
        <option value="nightwear">Nightwear</option>
        <option value="short">Shorts & Skirts</option>
        <option value="pajama">Pajamas</option>
        <option value="legging">Leggings</option>
        <option value="jean">Jeans</option>
      </select> 
    </li>
      <li>
        <div class="ui-widget">
          <input type="text" class="form-control" placeholder="Search" id="searchbox">
        </div>
      </li>

    </ul>
</nav>
 </body>
 <!-- <script src="./assets/js/header.js"></script> -->
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 </html>
 <script>
   function getUrl() {
    var url = document.URL;
    localStorage.setItem("url", url);
    $.ajax({
            type: 'GET',
            url: "logout.php",
            success:function(data){
             if (data) {
                  window.location.href = "home.php";
                }
             }
        });
   }

    $( "#searchbox" ).autocomplete({
      source: function selectVal(request, response) {
        var value = $("#dropdown_btn").val();

        $.ajax({
          url:"search.php",
          type:"post",
          dataType:"json",
          data:{value:request.term},
          success:function(data) {
            response(data);
          }
        });
      }
    });
  
$("#searchbox").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#searchbox").submit();
        var term = $("#dropdown_btn").val();
        var searchval = $("#searchbox").val();
        if (searchval == '') {} else {
          location.href = "searchitems.php?search="+searchval+"&term="+term;
        }
    }
});





</script>
