
<?php session_start(); 
include("connection.php"); ?>
<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
{
include("header.php");
?>

<?php
  $id = $_GET['id'];
  $_SESSION['pro_id'] = $_GET['id'];
  $query1 = "SELECT * FROM rating WHERE product_id = '$id' ";

    $result = mysqli_query($db, $query1);
      $review = array();
      if(mysqli_num_rows($result) > 0) {

        while($row = mysqli_fetch_assoc($result)) {
          $user_rating[] = $row['rating'];
          array_push($review, $row['review']);
        }
        $mix_rating = round(array_sum($user_rating) / sizeof($user_rating) * 2) / 2;

      } else {
        $mix_rating = 0;
      }
?>
   <ul class="breadcrumb">
    <li><a href="home.php">Home</a></li>
    <li><a href="home.php">Sets & Suits</a></li>
    <?php 
    	$id = $_GET['id'];
  		$result1 = mysqli_query($db, "SELECT name FROM baby_clothes WHERE id ='$id'");
  		while($row1 = mysqli_fetch_assoc($result1)) { ?>
    	<li><?php echo $row1['name']; ?></li>
  </ul>
  <div class="row"  ng-controller="slideController">
   <h2 id="productname"><?php echo $row1['name']; ?></h2> <?php } ?>
  	<div class="col-md-7">
      <div class="text-center">
        <img ng-src="{{mainImage.url}}" width="300px" height="400px" class="img-thumbnail xzoom" xoriginal="{{mainImage.url}}">
      <hr>
        <img ng-repeat="image in images" ng-src="{{image.url}}" width="80px" height="80px" ng-mouseenter="$parent.mainImage = image" id="smallimages" xpreview="{{image.url}}">
      </div>
    </div>
  	<div class="col-md-5">
  		<h3>Specifications:</h3>
  		<ul>
  		<?php 
	    	$id = $_GET['id'];
	  		$result1 = mysqli_query($db, "SELECT specification, price FROM baby_clothes WHERE id ='$id'");
	  		while($row1 = mysqli_fetch_assoc($result1)) { ?>
  			<li><?php echo $row1['specification']; ?></li>
  		</ul>
  		<hr>
      <div class="row">
        <div class="col-md-6">
          <div id="rateYo"></div>
        </div>
        <div class="col-md-6">
          <big><?php echo sizeof($review); ?><a href="view_reviews.php?id=<?php echo $_GET['id']; ?>"> user reviews</a></big>
        </div>
      </div>
      <h4><?php echo $mix_rating; ?> out of 5</h4>

      <input type="hidden" name="rating" id="rating">
      <p class='text-success' id="successmsg"><b><span class='glyphicon glyphicon-ok'></span> Thanks for rating & review our product</b></p>
      <div id="reviewdiv">
        <textarea rows="4" cols="50" placeholder="Tell something about the product" id="reviewtext"></textarea>
        <button class="btn btn-info btn-md" id="review_btn">Submit</button>
      </div>
      <input type="hidden" ng-model="productid" value="{{productid}}" id="product_id">
      <input type="hidden" name="userid" value="<?php echo $_SESSION['user_id']; ?>" id="user_id">
  		<h3>Price:</h3>
  		<h4><b>&#8377;</b> <?php echo $row1['price']; ?></h4>
  		<?php } ?>
  		<button class="btn btn-warning btn-md" id="addcart_btn">Add to Cart</button>
      <span class="text-success" id="addcartmsg"><span class="glyphicon glyphicon-ok"></span> <b>Added to cart</b></span>
  	</div>
  </div>  <!-- row ending -->
</div>  <!-- container ending -->

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="./assets/js/jquery.rateyo.js"></script>
<script src="./assets/js/xzoom.js"></script>
<script>
  var slide=angular.module("myApp",[])
  slide.controller('slideController', function ($scope) {
    $scope.images = [
      <?php 
        $id = $_GET['id'];
        $result = mysqli_query($db, "SELECT * FROM product_images WHERE product_id ='$id' ");
          while($row = mysqli_fetch_assoc($result)) { ?>
      {
        url: "../backend/uploads/<?php echo $row['image']; ?>",
        id: <?php echo $row['product_id']; ?>
      },
      <?php } ?>
    ]
    $scope.productid = $scope.images[0].id;
    $scope.mainImage = $scope.images[0];
});

</script>

<script>
  $(function () {
    $("#reviewdiv").hide();
    $("#successmsg").hide();
    $(".xzoom").xzoom({tint: '#333', Xoffset: 15, position: 'lens'});
    $("#rateYo").rateYo({
      rating: <?php echo $mix_rating; ?>,
      halfStar: true,
       onSet: function (rating, rateYoInstance) {
          $("#reviewdiv").slideDown("slow");
          $("#rating").val(rating);
       }
    });
        $("#review_btn").on('click', function(){
          var rating = $("#rating").val();
          var product_id = $("#product_id").val();
          var user_id = $("#user_id").val();
          var review = $("#reviewtext").val();

          $.ajax({
              url:"rating.php",
              type:"post",
              dataType:"json",
              data:{rating:rating, product_id:product_id, user_id:user_id, review:review},
              success:function(response) {
                console.log(response);
                  $("#reviewdiv").hide();
                  $("#successmsg").show();
              }
          });
        });
  });
  $("#addcartmsg").hide();
 $(document).on("click","#addcart_btn", function() {
    var user_id = "<?php echo $_SESSION['user_id']; ?>";
    var product_id = "<?php echo $_GET['id']; ?>";
    $.ajax({
      url:"cart_items.php",
      type:"post",
      data:{user_id:user_id, product_id:product_id},
      success:function(response) {
        if (response) {
          $("#addcartmsg").show().delay(3000).fadeOut('slow');
          $("#cartcount").text(response);
          $("#cartcount").focus();
        }
      }
    });     
 });
</script>
</html>
<?php }else{ 
header('location:login.php');
} ?>
