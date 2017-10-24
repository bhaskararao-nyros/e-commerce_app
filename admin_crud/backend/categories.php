<!DOCTYPE html>
<html>
<head>
	<title>Categories Management</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body>
<?php 
	include("connection.php");
?>
	<div class="panel panel-success" style="margin: 10px 500px 0px 200px;">
	<div class="container" style="padding: 5px;margin-left: 20px;">
	<h2><b>Category Management</b></h2>
	<button class="btn btn-success btn-xs" id="add_cat"><span class="glyphicon glyphicon-plus"></span> Add Category</button><br>
	<div id="textdiv" style="display: none;">
		<ul>
			<li>
				<input type="text" name="" placeholder="Enter category name" id="textinput">
				<div id="addcatdiverror"></div>
			</li>
		</ul>
	</div>
		<?php 
			$result = mysqli_query($db, "SELECT id, name FROM categories WHERE c_id = 0");
			while($row = mysqli_fetch_assoc($result)) { ?>
			<div class="row" style="padding: 10px;">
			<div class="col-md-6">
			<ul>
				<li style="font-size: 20px;">
				<div class="row" style="border: 1px solid #ccc;background-color:#afadac">
				  <div class="col-md-6" id="categories">
					<?php echo $row['name']; ?> 
				  </div>
				  <div class="col-md-6">
					<button class="btn-xs" onclick="editCat(<?php echo $row['id']; ?>)">
						<span class="glyphicon glyphicon-edit"></span>
					</button> 
					<button class="btn-xs" onclick="deleteCat(<?php echo $row['id']; ?>)">
						<span class="glyphicon glyphicon-trash"></span>
					</button>
					<button class="btn-xs add_sub_cat" onclick="subCat(<?php echo $row['id']; ?>)">
							<span class="glyphicon glyphicon-plus"></span> Add Sub-Cat
					</button>
					<button class="btn-xs add_sub_cat" onclick="toggleSubCat(<?php echo $row['id']; ?>)">
							<span class="glyphicon glyphicon-chevron-up"></span>
					</button>
				  </div> <!-- column 6 ending -->
				</div> <!-- row ending -->
				</li>
				<li>
					<div id="edittextdiv_<?php echo $row['id']; ?>" style="display: none;">
						<input type="text" name="" placeholder="Enter category name" id="edittextinput_<?php echo $row['id'];?>" value="<?php echo $row['name']; ?>" onkeyup="editCatText('<?php echo $row['id'];?>',this,event)">
						<div id="editcatdiverror_<?php echo $row['id']; ?>"></div>
					</div>
				</li>
				<ul>
					<li>
						<div id="subtextdiv_<?php echo $row['id']; ?>" style="display: none;">
							<input type="text" name="" placeholder="Enter sub-cat name" id="subtextinput_<?php echo $row['id']; ?>" onkeyup="addSubCat('<?php echo $row['id'];?>',this,event)">
							<div id="subcatdiverror_<?php echo $row['id']; ?>"></div>
						</div>
					</li>

					<?php 
						$result1 = mysqli_query($db, "SELECT id, name FROM categories WHERE c_id = '".$row['id']."'");
						while($sub_cat = mysqli_fetch_assoc($result1)) { ?>

					<li style="font-size: 18px;">
						<div class="row" style="border: 1px solid #ccc;background-color: #e3e1e1 ">
						  <div class="col-md-6" id="subcategories">
							<?php echo $sub_cat['name']; ?>
						  </div>
						  <div class="col-md-6">
							<button class="btn btn-default btn-xs" onclick="editSubCat(<?php echo $sub_cat['id']; ?>)">
								<span class="glyphicon glyphicon-edit"></span>
							</button> 
							<button class="btn btn-default btn-xs" onclick="delSubCat(<?php echo $sub_cat['id']; ?>)">
								<span class="glyphicon glyphicon-trash"></span>
							</button>
						  </div> <!-- column 6 ending -->
						</div> <!-- row ending -->
					</li>
					<li>
						<div id="editsubtextdiv_<?php echo $sub_cat['id']; ?>" style="display: none;">
							<input type="text" name="" placeholder="Enter categorie name" id="editsubtextinput_<?php echo $sub_cat['id'];?>" value="<?php echo $sub_cat['name']; ?>" onkeyup="editSubCatText('<?php echo $sub_cat['id'];?>',this,event)">
							<div id="editsubcatdiverror_<?php echo $sub_cat['id']; ?>"></div>
						</div>
					</li>
					<?php } ?>
				</ul>
			</ul>
			</div>
			</div>  <!-- row ending -->
			<?php } ?>
	</div>  <!-- container ending -->
	</div>   <!-- panel ending -->
		
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="./assets/js/categories.js"></script>

