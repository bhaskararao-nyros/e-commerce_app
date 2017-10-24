
<?php
	session_start();
    if(isset($_POST['username'],$_POST['password'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];

      if($username =="admin" && $password == "admin") {
      	$response['username'] =$username;
      	$_SESSION['admin'] = 1;
      	
		} else {
			$response['error'] = "Username/password is incorrect";
		}
    }
    echo json_encode($response);
?>



