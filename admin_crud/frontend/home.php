<?php 
session_start();
include("connection.php"); 
include("header.php"); ?>
<div class="row">
  <div class="col-md-4">
  	<div class="panel panel-default">
  	  <div class="panel-heading">New Products</div>
      <div class="panel-body">
      		<?php 
      			$result = mysqli_query($db, "SELECT b.name, b.price, p.image FROM baby_clothes b JOIN product_images p ON b.id = p.product_id GROUP BY b.name LIMIT 0, 4");
      			while($row = mysqli_fetch_assoc($result)) {
      		 ?>
          <div class="row" id="siderow">
        	  <div class="col-md-4">
        	  	<img src="../backend/uploads/<?php echo $row['image']; ?>" width="50px" height="50px">
        	  </div>
        	  <div class="col-md-8">
        	  	<h5><?php echo $row['name']; ?></h5>
              <h6 id="price">&#8377;<?php echo $row['price']; ?></h6>
        	  </div>
        </div><hr>
      	  <?php } ?>
          <a href="new_products.php" class="pull-right">View more >> </a>
      	
      </div>  <!-- panel body ending -->	
  	</div>  <!-- panel ending -->
  </div>  <!-- column-4 ending -->
  <div class="col-md-8">
    <div class="row">
      <div class="col-md-4">
        
      </div>
      <div class="col-md-4">
        
      </div>
      <div class="col-md-4">
        
      </div>

    </div>  <!-- row ending -->
    <div class="row">
      <div class="col-md-4">
        
      </div>
      <div class="col-md-4">
        
      </div>
      <div class="col-md-4">
        
      </div>

    </div>  <!-- row ending -->
  	
  </div> <!-- column-8 ending -->
</div>  <!-- row ending -->
<div class="row">
  <h2 class="text-center" id="suits"><span>Sets & Suits</span></h2>
  <?php 
    $result = mysqli_query($db, "SELECT b.id, b.name, b.price, p.image FROM baby_clothes b JOIN product_images p ON b.id = p.product_id WHERE name LIKE '%Suit%' GROUP BY p.product_id LIMIT 4");
  while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="col-md-3">
      <div class="panel panel-default" id="firstrow">
        <a href="product_details.php?id=<?php echo $row['id']; ?>">
        <img src="../backend/uploads/<?php echo $row['image']; ?>" width="250px" height="300px"><br><br>
        </a>
      </div>
    </div>
  <?php } ?>
</div>
<div class="row">
  <h2 class="text-center" id="suits"><span>Tops & Tees</span></h2>
  <?php 
    $result = mysqli_query($db, "SELECT b.id, b.name, b.price, p.image FROM baby_clothes b JOIN product_images p ON b.id = p.product_id WHERE name LIKE '%Top%' GROUP BY p.product_id LIMIT 4");
  while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="col-md-3">
      <div class="panel panel-default" id="firstrow">
        <a href="product_details.php?id=<?php echo $row['id']; ?>">
        <img src="../backend/uploads/<?php echo $row['image']; ?>" width="250px" height="300px"><br><br>
        </a>
      </div>
    </div>
  <?php } ?>
</div>
<div class="row">
  <h2 class="text-center" id="suits"><span>Kurta & Kurtis</span></h2>
  <?php 
    $result = mysqli_query($db, "SELECT b.id, b.name, b.price, p.image FROM baby_clothes b JOIN product_images p ON b.id = p.product_id WHERE specification LIKE '%Kurta%' GROUP BY p.product_id LIMIT 4");
  while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="col-md-3">
      <div class="panel panel-default" id="firstrow">
        <a href="product_details.php?id=<?php echo $row['id']; ?>">
        <img src="../backend/uploads/<?php echo $row['image']; ?>" width="250px" height="300px"><br><br>
        </a>
      </div>
    </div>
  <?php } ?>
</div>
</div>
</div>  <!-- container ending -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="./assets/js/script.js"></script>