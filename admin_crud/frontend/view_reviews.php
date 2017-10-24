<?php session_start();
include("connection.php");
include("header.php"); ?>

<h4>Customer reviews</h4><hr>
<?php 

$id = $_GET['id'];
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

	<div class="row">
		<div class="col-md-4">
			<div class="rating-block">
				<h4>Average user rating</h4>
				<h2 class="bold padding-bottom-7"><?php echo $mix_rating; ?><small>/ 5</small></h2>
				<div id="rateYo"></div>
			</div>
		</div>
		<div class="col-md-4">
			<h4>Rating breakdown</h4>
				<div class="pull-left" id="progressbar">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:15px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:15px; margin:3px 0;">
						  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 1000%">
							<span class="sr-only">80% Complete (danger)</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">
					<?php 
					$id = $_GET['id'];

					$five_user = array();
					$four_user = array();
					$three_user = array();
					$two_user = array();
					$one_user = array();

					$result = mysqli_query($db, "SELECT user_id, rating FROM rating WHERE product_id = '$id' ");
						while($row = mysqli_fetch_assoc($result)) {
							$rating = $row['rating'];
							if ($rating == 5) {
								array_push($five_user, $row['user_id']);
							} elseif ($rating >=4 && $rating <5) {
								array_push($four_user, $row['user_id']);
							} elseif ($rating >=3 && $rating <4) {
								array_push($three_user, $row['user_id']);
							} elseif ($rating >=2 && $rating <3) {
								array_push($two_user, $row['user_id']);
							} else {
								array_push($one_user, $row['user_id']);
							}
						}
						echo sizeof($five_user);
					 ?>
					</div>
				</div>
				<div class="pull-left" id="progressbar">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:15px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:15px; margin:3px 0;">
						  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: 80%">
							<span class="sr-only">80% Complete (danger)</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">
						<?php echo sizeof($four_user); ?>
					</div>
				</div>
				<div class="pull-left" id="progressbar">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:15px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:15px; margin:3px 0;">
						  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: 60%">
							<span class="sr-only">80% Complete (danger)</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">
						<?php echo sizeof($three_user); ?>
					</div>
				</div>
				<div class="pull-left" id="progressbar">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:15px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:15px; margin:3px 0;">
						  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: 40%">
							<span class="sr-only">80% Complete (danger)</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">
						<?php echo sizeof($two_user); ?>
					</div>
				</div>
				<div class="pull-left" id="progressbar">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:15px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:15px; margin:3px 0;">
						  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: 20%">
							<span class="sr-only">80% Complete (danger)</span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;">
						<?php echo sizeof($one_user); ?>
					</div>
				</div>
			</div>  <!-- column-4 ending -->
			<a class="col-md-4 text-center" id="reviewimage" href="product_details.php?id=<?php echo $_GET['id']; ?>">
			<?php 
				$id = $_GET['id'];
				$result = mysqli_query($db, "SELECT b.name, b.price, p.image FROM baby_clothes b JOIN product_images p ON b.id = p.product_id WHERE b.id = '$id' GROUP BY p.product_id ");
				$row = mysqli_fetch_assoc($result);
			?>
				<h4><b><?php echo $row['name']; ?></b></h4>

				<img src="../backend/uploads/<?php echo $row['image']; ?>" width="150px" height="170px">
			</a> <!-- column 4 ending -->
		</div><hr>					
	<?php 	
	if (isset($_GET['id'])) {
	
	$id = $_GET['id'];

	$result = mysqli_query($db, "SELECT * FROM rating WHERE product_id = '$id' ");
	while($row = mysqli_fetch_assoc($result)) { 
		$date = $row['date_joined'];
	
?>
	<div class="review-block well">
		<div class="row">
			<div class="col-md-4">
			<span id="rateYo"></span>
			<input type="hidden" name="rateyoid" value="<?php echo $row['rating']; ?>" id="mixrating">
				<div class="review-block-name"><a href="#">
					<?php $result1 = mysqli_query($db, "SELECT name FROM users WHERE id = '".$row['user_id']."' ");
						  $rows = mysqli_fetch_assoc($result1);
						  echo $rows['name'];
					 ?>
				</a></div>
				<div class="review-block-date"><?php echo date("d F Y", strtotime($date)); ?><br/>
					<?php $timestamp = strtotime($date);
						echo get_timeago( $timestamp ); 
					?>
				</div>
			</div>
			<div class="col-md-8">
				<div class="review-block-rate">
				</div>
				<div class="review-block-title"><?php echo $row['review'] ?></div>
			</div>
		</div>
		<hr/>
		
	</div>
<script src="./assets/js/jquery.rateyo.js"></script>
<script>
	$("#rateYo").rateYo({
      rating: <?php echo $mix_rating; ?>,
      halfStar: true,
      readOnly: true
  	});

  	$( "input[name='rateyoid']" ).each( function() {
	  var current_rating = $(this).val();	
	  $(this).parent().find('span').rateYo({
		  starWidth: '15px',
		  halfStar: true,
  		  readOnly: true,
		  rating: current_rating
	  });
    });
</script>
		
<?php } ?>
<?php } ?>




<?php 
function get_timeago( $ptime )
{
$etime = time() - $ptime;

if( $etime < 1 )
{
    return 'less than '.$etime.' second ago';
}

$a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60             =>  'hour',
            60                  =>  'minute',
            1                   =>  'second'
);

foreach( $a as $secs => $str )
{
    $d = $etime / $secs;

    if( $d >= 1 )
    {
        $r = round( $d );
        return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
    }
}
}


 ?>
