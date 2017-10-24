<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);?>

<?php
session_start();
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
<script type="text/javascript" src="./assets/js/index.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
<div class="container">
  <h2 class="text-center">Crud on user's data<small> using dataTable</small></h2>
  <span class="text-right" style="color: green;">Welcome Admin</span><span class="pull-right"><a href="logout.php">Logout</a></span><hr>
	<div class="row">
		<div class="col-md-12">
		  <div class="messages"></div>
		  <button class="btn btn-success pull-right" data-toggle="modal" data-target="#addUserModal" id="addUserBtn"><span class=" glyphicon glyphicon-plus-sign"></span> Add New User</button><br><br><br>
			<table id="datatableId" class="table table-hover table-striped">
				<thead>
					<tr>
						<th>User id</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone No</th>
						<th>Country</th>
						<th>Option</th>
					</tr>
				</thead>
			</table>
		</div>  <!-- col-md-12 ending -->
	</div>  <!-- row ending -->
</div>  <!-- container ending -->
										<!-- add user modal starting-->								
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-hidden="true">   <!-- model starting -->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span> Add New User</h4>
      </div>
      <form action="insert.php" method="post" id="addUserForm">
	      <div class="modal-body">
	        <div id="message"></div>
	       	  <div class="form-group">
			    <label for="name">Name</label>
			    <input type="text" class="form-control" name="username" placeholder="Enter name" id="name">
			  </div>
			  <div class="form-group">
			    <label for="email">Email</label>
			    <input type="email" class="form-control" placeholder="Enter email" name="email" id="email">
			  </div>
			  <div class="form-group">
			    <label for="phone">Phone No</label>
			    <input type="text" class="form-control numonly" placeholder="Enter Phone Number" name="phone" id="phone" maxlength="10">
			  </div>
			  <div class="form-group">
			    <label for="phone">Address</label>
			    <input type="text" class="form-control" placeholder="Enter Address" name="address" id="address">
			  </div>
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
<div class="modal fade" id="delUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-trash"></span> Delete User Confirmation</h4>
      </div>
      <div class="modal-body">
        <h5>Do you want to delete this user</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" id="delUserBtn">Yes</button>
      </div>
    </div>
  </div>
</div> 		<!-- delete user modal ending -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-edit"></span> Edit User</h4>
      </div>
      <!-- edit user modal starting-->
    <form action="update.php" method="post" id="editUserForm">
      <div class="modal-body">
          <div id="editMessage"></div>
       		<div class="form-group">
			    <label for="name">Name</label>
			    <input type="text" class="form-control" name="editName" placeholder="Enter name" id="editName">
			  </div>
			  <div class="form-group">
			    <label for="email">Email</label>
			    <input type="email" class="form-control" placeholder="Enter email" name="editEmail" id="editEmail">
			  </div>
			  <div class="form-group">
			    <label for="phone">Phone No</label>
			    <input type="text" class="form-control" placeholder="Enter Phone Number" name="editPhone" id="editPhone" maxlength="10">
			  </div>
			  <div class="form-group">
			    <label for="phone">Address</label>
			    <input type="text" class="form-control" placeholder="Enter Address" name="editAddress" id="editAddress">
			  </div>
      </div>
      <div class="modal-footer"  id="editUserId">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    <!-- edit user modal ending-->
    </div>
  </div>
</div>
</body>
</html>
<?php }else{ 
header('location:index.php');
} ?>
