
<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);?>
<?php
session_start();
include "permission.php";
include "connection.php";



if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
{

?>


<!DOCTYPE html>
<html>
<head>
	<title>Datatables Crud</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
<div class="container">

<div id="mySidenav" class="sidenav">  <!-- sidenav starting-->
<ul>
  <li class="categoriesli" onclick="sortSubCat()">All Categories <span class="glyphicon glyphicon-triangle-right pull-right"></span></li>
  <?php 
      $result = mysqli_query($db, "SELECT id, name FROM categories WHERE c_id = 0");
      while($row = mysqli_fetch_assoc($result)) { ?>
        <div id="categorydiv_<?php echo $row['id']; ?>" onclick="showSubCat(<?php echo $row['id']; ?>)">
        <li id="category_<?php echo $row['id']; ?>" class="categoriesli"><?php echo $row['name']; ?><span class="glyphicon glyphicon-triangle-right pull-right"></span></li>
        </div>
        <li style="padding: 0px;" class="subcategory">
          <ul>
              <?php 
                $result1 = mysqli_query($db, "SELECT c_id, id, name FROM categories WHERE c_id = '".$row['id']."'");
                while($rows = mysqli_fetch_assoc($result1)) { ?>
            <div id="subcatdiv_<?php echo $rows['id']; ?>" class="subcategory_<?php echo $rows['c_id']; ?>"  style="display:none;">
            <li id="subcategory_<?php echo $rows['id']; ?>" onclick="sortSubCat(<?php echo $rows['id']; ?>, <?php echo $row['id']; ?>)"><?php echo $rows['name']; ?></li>
            </div>
            <?php } ?>
          </ul>
        </li>
<?php } ?>
</ul>
</div>


<div id="main">
  <h2 class="text-center">Baby Clothes Mart</h2>
  <span class="text-right badge" style="color: green;">Welcome <big><b><?php echo $_SESSION['username']; ?> </big></b></span>
  <?php if($_SESSION['role'] == 1) { ?>
  <a href="" data-toggle="modal" data-target="#changePermissionsModal">Edit Permissions</a>
  <?php } ?>
  <span class="pull-right btn btn-sm btn-primary" id="logout"><a href="logout.php">Logout</a></span><hr>
	<div class="row">
		<div class="col-md-12">
		  <div class="messages"></div>
      <?php if($_SESSION['role'] == 1) { ?>
      <button class="btn" data-toggle="modal" data-target="#categoriesmodal">Category management</button>
      <?php } ?>
      <?php if($add) { ?>
		  <button class="btn btn-success pull-right" data-toggle="modal" data-target="#addProductModal" id="addProductBtn"><span class=" glyphicon glyphicon-plus-sign"></span> Add New Product</button>
      <?php } ?>
		  <br><br><br>
      <?php if($view == 1) { ?>
			<table id="datatableId" class="table table-hover table-striped">
				<thead>
					<tr>
						<th>S.No</th>
						<th>Name</th>
						<th>Image</th>
            <th>Price</th>
						<th style="width: 300px;">Specifications</th>
						<?php if($edit == 1 || $delete == 1) { ?><th>Option</th><?php } ?>
					</tr>
				</thead>
			</table>
      <?php } ?>
		</div>  <!-- col-md-12 ending -->
	</div>  <!-- row ending -->
  </div> <!-- main id div ending -->
</div>  <!-- container ending -->
										<!-- add user modal starting-->								
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-hidden="true">   <!-- model starting -->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Add New Product</h4>
      </div>
      <form method="post" id="addProductForm" enctype="multipart/form-data">
	      <div class="modal-body">
	        <div id="message"></div>
	       	  <div class="form-group">
			    <label for="name">Product Name</label>
			    <input type="text" name="productname" id="productname">
			  </div>
        <div class="form-group">
        <label for="name">Category</label>
        <select class="maincat" id="addselcatdd" name="addselcatdd">
         <option value="0">Select</option>
          <?php 
            $result = mysqli_query($db, "SELECT id, name FROM categories WHERE c_id = 0");
            while($row = mysqli_fetch_assoc($result)) { ?>
              <option id="selcat_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
              <?php } ?>
        </select>
        </div>
        <div class="form-group">
        <label for="name">Sub-category</label>
        <select class="selectsub" id="addsubcatdd" name="addsubcatdd">
        <option value="0">Select</option>
          <?php 
            $result1 = mysqli_query($db, "SELECT c_id, name FROM categories WHERE c_id != 0");
            while($rows = mysqli_fetch_assoc($result1)) { ?>
              <option value="<?php echo $rows['c_id']; ?>" id="selsubcat_<?php echo $rows['c_id']; ?>"><?php echo $rows['name']; ?></option>
              <?php } ?>
        </select>
        </div>
         <div class="form-group">
          <label for="email">Specifications</label>
          <textarea cols="50" rows="6" name="specifications" id="specifications"></textarea>
        </div>
			  <div class="form-group">
			    <label for="email">Price</label>
          <input type="text" name="price" id="price" class="number">
			  </div>
			    <label for="phone">Product Image</label>
			    <input type="file" id="productimage" name="file[]" multiple="multiple">
          <div id="preimages"></div>
          <input type="hidden" id="imgs" name="imgs">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-primary" name="save">Save</button>
	      </div>
	  </form>
    </div>
  </div>
</div> 	<!-- add user modal ending -->
				<!-- delete user modal starting-->
<div class="modal fade" id="delProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-trash"></span> Delete Product Confirmation</h4>
      </div>
      <div class="modal-body">
        <h5>Do you want to delete this product</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" id="delProductBtn">Yes</button>
      </div>
    </div>
  </div>
</div> 		<!-- delete user modal ending -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-edit"></span> Edit Product</h4>
      </div>
      <!-- edit user modal starting-->
    <form  method="post" id="editProductForm" enctype="multipart/form-data">
      <div class="modal-body">
          <div id="editMessage"></div>
       		<div class="form-group">
			    <label for="name">Product Name</label>
			    <input type="text" name="editproductname" id="editproductname">
			  </div>
        <div class="form-group">
        <label for="name">Category</label>
        <select class="maincat" id="editmaincatdd" name="editmaincatdd">
         <option>Select</option>
          <?php 
            $result = mysqli_query($db, "SELECT id, name FROM categories WHERE c_id = 0");
            while($row = mysqli_fetch_assoc($result)) { ?>
              <option id="selcat_<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
              <?php } ?>
        </select>
        </div>
        <div class="form-group">
        <label for="name">Sub-category</label>
        <select class="selectsub" id="editsubcatdd" name="editsubcatdd">
        <option>Select</option>
          <?php 
            $result1 = mysqli_query($db, "SELECT c_id, id, name FROM categories WHERE c_id != 0");
            while($rows = mysqli_fetch_assoc($result1)) { ?>
              <option value="<?php echo $rows['id']; ?>" id="selsubcat_<?php echo $rows['c_id']; ?>"><?php echo $rows['name']; ?></option>
              <?php } ?>
        </select>
        </div>
			  <div class="form-group">
			    <label for="email">Specifications</label>
			    <textarea cols="50" rows="6" id="editspecifications" name="editspecifications"></textarea>
			  </div>
        <div class="form-group">
          <label for="email">Price</label>
          <input type="text" name="editprice" id="editprice" class="numonly">
        </div>
			  <div class="form-group">
			    <label for="editproductimage">Product Image</label>
			    <input type="file" name="file[]" id="editproductimage" multiple>
          <div id="editimages"></div>
          <div id="extraimages"></div>
          <input type="hidden" id="editimgs" name="imgs">
          <input type="hidden" name="extimgs" id="extimgs">
				
			  </div>
      </div>
      <div class="modal-footer" id="editProductId">
      
      	<input type="hidden" name="product_id" id="product_id">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="btn_update">Update</button>
      </div>
    </form>
    
    </div>
  </div>
</div><!-- edit user modal ending-->
                <!-- admin permissions modal starting-->
<div class="modal fade" id="changePermissionsModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Admin Permissions</h4>
        </div>
        <div class="modal-body">
          
            <?php 
                $result = mysqli_query($db, "SELECT * FROM admin_roles where id!=1");
                $permissions = array();
				        $role = array();
				
                while($row = mysqli_fetch_assoc($result)) { 
                 $r['role_id'] = $row['id'];
                 $actions = array();
                 $result1 = mysqli_query($db, "SELECT * FROM role_permissions where role_id=".$row['id']." order by action_id asc");
                  while($row1 = mysqli_fetch_assoc($result1)) { 
                    $a['action'] = $row1['action_id'];
                    $a['status'] = $row1['status'];
                    array_push($actions,$a);
                  }
                  $r['actions'] = $actions;
                  array_push($permissions,$r);
                 }
               
            ?>
             <table border="2" cellpadding="10" cellspacing="10">
            <thead>
              <tr>
                <th>Role</th>
                <th>View</th>
                <th>Add</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($permissions as $per) { ?>
              <tr>
                <td>
                  <?php if ($per['role_id'] == 2) {
                    echo "Manager";
                  } else {
                    echo "Staff";
                    }?>
                </td>
                    <?php foreach($per['actions'] as $act) { ?>
                        <td><input type="checkbox" name="view" class="radio" <?php if($act['status']==1){ echo 'checked';} else { echo '';}?> data-role="<?php echo $per['role_id'];?>" data-act="<?php echo $act['action'];?>"></td>
                    <?php } ?>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="savecheck">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      
    </div>
  </div>      <!-- admin permissions modal ending -->

              <!-- category management modal starting -->

  <div class="modal fade" id="categoriesmodal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content" id="categorysmodal">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Category Management</h4>
        </div>
        <div class="modal-body">
          <div class="container" style="padding: 5px;margin-left: 20px;">
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
                  <button class="btn-xs hide_sub_cat" id="hidesubcat_<?php echo $row['id']; ?>" onclick="toggleSubCat(<?php echo $row['id']; ?>)">
                      <span class="glyphicon glyphicon-chevron-up" id="uparrow_<?php echo $row['id']; ?>"></span>
                      <span class="glyphicon glyphicon-chevron-down" id="downarrow_<?php echo $row['id']; ?>" style="display: none;"></span>
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
                    $result1 = mysqli_query($db, "SELECT c_id, id, name FROM categories WHERE c_id = '".$row['id']."'");
                    while($sub_cat = mysqli_fetch_assoc($result1)) { ?>

                  <li style="font-size: 18px;display: none;" class="subcatli_<?php echo $sub_cat['c_id']; ?> subcatli">
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
        </div> <!-- modal body ending -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="savecheck">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      
    </div>
  </div>      <!-- category management modal ending -->

</body>
</html>
<?php }else{ 
header('location:index.php');
} ?>
<script type="text/javascript" src="./assets/js/index.js"></script>
<script src="./assets/js/categories.js"></script>
<script>
$(document).ready(function(){

$(".radio").click(function(){
var role_id = $(this).attr('data-role');
var act_id = $(this).attr('data-act');
        
        if($(this).is(':checked')) {
        	status = 1
        }
        else
        {
        	status = 0;
        }
        var manager_role_id = role_id;
		var manager_action_id = act_id;
		   
     	$.ajax({
     		url:"admin_permissions.php",
     		type:"post",
     		data:{manager_role_id:manager_role_id, manager_action_id:manager_action_id, status:status},
     		dataType:"json"
     	});
       
    });
$("#mySidenav").mouseenter(function() {
  $("#mySidenav").addClass("marginleft");
  $("#main").addClass("margin");
});
$("#mySidenav").mouseleave(function() {
  $("#mySidenav").removeClass("marginleft");
  $("#main").removeClass("margin");
});
$("#addselcatdd").change(function() {
var addcategory = $("#addselcatdd option:selected").val();
    $.ajax({
        url:"get_subcat.php",
        type:"post",
        data:{category_id:addcategory},
        success:function(response) {
          $("#addsubcatdd").html(response);
        }
    });
});

$("#editmaincatdd").change(function() {
  var editcategory = $("#editmaincatdd option:selected").val();
      $.ajax({
          url:"get_subcat.php",
          type:"post",
          data:{category_id:editcategory},
          success:function(response) {
            $("#editsubcatdd").html(response);
          }
    });
});
});

function showSubCat(id) {
  $(".subcategory_"+id).toggle();
}

function toggleSubCat(id) {
  $("#uparrow_"+id).toggle();
  $('#downarrow_'+id).toggle();
  $(".subcatli").not(".subcatli_"+id).hide();
  $(".subcatli_"+id).toggle();
}
</script>


