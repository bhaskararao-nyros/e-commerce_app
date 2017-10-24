<?php 
include('connection.php');
include('permission.php');

if (!empty($_POST)) {

	$cat_id = $_POST['cat_id'];
	$sub_cat_id = $_POST['sub_cat_id'];

	$result = mysqli_query($db,"SELECT * from baby_clothes WHERE c_id = '$cat_id' AND sc_id = '$sub_cat_id' ");
	$i = 1;
	while ($row = mysqli_fetch_assoc($result)) {

	$imgs_exe = mysqli_query($db,"select * from product_images where product_id = ".$row['id']);
	
	$imgs = array();
	$imgs_id = array();
	while($irow = mysqli_fetch_assoc($imgs_exe))
	{
		array_push($imgs,$irow);
	}

	$actionButton = '';
	if($edit == 1)
	{
		$actionButton .= '<a type="button" data-toggle="modal" data-target="#editProductModal" onclick="editProduct('.$row['id'].')" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></a>';
	}
	if($delete == 1)
	{
		$actionButton .= '<a type="button" data-toggle="modal" data-target="#delProductModal" onclick="delProduct('.$row['id'].')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';
	}
	
	$image = '';
	foreach($imgs as $img)
	{
		$imgsrc = 'uploads/'.$img['image'];
		if($delete) {
			$image .= '<div id="images"><span class="glyphicon glyphicon-remove-sign" onclick="delImg('.$img['id'].')"></span>';
		}
		$image .= '<img src="'.$imgsrc.'"" width="100px" height="100px" class="img-rounded" title="'.$row['name'].'" id="dispimg"></div>';
	}
	$price = '&#8377;'.$row['price'];
	$output['data'][] = array(
		$i,
		$row['name'],
		$image,
		$price,
		$row['specification'],
		$actionButton
	);
	$i++;
}

echo json_encode($output);

	

} else {
	


$output = array('data' => array());

$result = mysqli_query($db,"SELECT * from baby_clothes");

$i = 1;
while ($row = mysqli_fetch_assoc($result)) {

	$imgs_exe = mysqli_query($db,"select * from product_images where product_id = ".$row['id']);
	
	$imgs = array();
	$imgs_id = array();
	while($irow = mysqli_fetch_assoc($imgs_exe))
	{
		array_push($imgs,$irow);
	}

	$actionButton = '';
	if($edit == 1)
	{
		$actionButton .= '<a type="button" data-toggle="modal" data-target="#editProductModal" onclick="editProduct('.$row['id'].')" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></a>';
	}
	if($delete == 1)
	{
		$actionButton .= '<a type="button" data-toggle="modal" data-target="#delProductModal" onclick="delProduct('.$row['id'].')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';
	}
	
	$image = '';
	foreach($imgs as $img)
	{
		$imgsrc = 'uploads/'.$img['image'];
		if($delete) {
			$image .= '<div id="images"><span class="glyphicon glyphicon-remove-sign" onclick="delImg('.$img['id'].')"></span>';
		}
		$image .= '<img src="'.$imgsrc.'"" width="100px" height="100px" class="img-rounded" title="'.$row['name'].'" id="dispimg"></div>';
	}
	$price = '&#8377;'.$row['price'];
	$output['data'][] = array(
		$i,
		$row['name'],
		$image,
		$price,
		$row['specification'],
		$actionButton
	);
	$i++;
}

echo json_encode($output);



}
 ?>
