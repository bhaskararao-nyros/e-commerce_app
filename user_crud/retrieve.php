<?php 
include('connection.php');

$output = array('data' => array());

$result = mysqli_query($db, "SELECT * FROM users");

while ($row = mysqli_fetch_assoc($result)) {

	$actionButton = ' <div class="dropdown">
		  <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Action
		  <span class="caret"></span></button>
		  <ul class="dropdown-menu">
		    <li><a type="button" data-toggle="modal" data-target="#editUserModal" onclick="editUser('.$row['id'].')"><span class="glyphicon glyphicon-edit"></span> Edit</a></li>
		    <li><a type="button" data-toggle="modal" data-target="#delUserModal" onclick="delUser('.$row['id'].')"><span class="glyphicon glyphicon-trash"></span> Delete</a></li>
		  </ul>
		</div>';

	$output['data'][] = array(
		$row['id'],
		$row['name'],
		$row['email'],
		$row['phone'],
		$row['address'],
		$actionButton
	);
}

echo json_encode($output);

 ?>