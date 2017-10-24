<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "connection.php";
$role = $_SESSION['role'];
if($role != 1)
{
	$view = 0; $add = 0; $edit = 0; $delete = 0;
	
	$result = mysqli_query($db,"SELECT * FROM `role_permissions` where role_id = $role");
	{
		while ($row = mysqli_fetch_assoc($result)) 
		{
			if($row['action_id'] == 1 && $row['status'] == 1)
			{
				$view = 1;
			}
			if($row['action_id'] == 2 && $row['status'] == 1)
			{
				$add = 1;
			}
			if($row['action_id'] == 3 && $row['status'] == 1)
			{
				$edit = 1;
			}
			if($row['action_id'] == 4 && $row['status'] == 1)
			{
				$delete = 1;
			}
		}
	}

}
else
{
	$view = 1; $add = 1; $edit = 1;	$delete = 1;
}

?>
