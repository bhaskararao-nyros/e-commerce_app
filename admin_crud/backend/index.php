
<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
</head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
	<script type="text/javascript" src="./assets/js/admin_login.js"></script>
	

<body>
 <nav class="navbar navbar-inverse">  <!-- navbar starting -->
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Admin Login</a>
    </div>
  </div>
</nav>    <!-- navbar ending -->
 <div class="container">
  <img src="./assets/images/admin.jpg" width="400px" height="100px" id="loginimg">
 	<div class="panel panel-default"> 
 	  <h2 id="heading">Login</h2>
	 	<form action="" method="post">
	 	  <div class="form-group">
	 	    <span id="nametext" class="hide">Enter username</span>
			<input type="text" class="form-control inputcontrol" placeholder="Enter username" id="username" name="username" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>">
			<div id="nameErr"></div>
		  </div>
		  <div class="form-group">
		    <span id="passtext" class="hide">Enter password</span>
			<input type="password" class="form-control inputcontrol" placeholder="Enter password" id="password" name="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>">
			<div id="passErr"></div>
		  </div>
		  <div class="field-group">
		  <div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
			<label for="remember-me">Remember me</label>
		  </div>
		  <button class="btn btn-md btn-primary" id="login_btn" name="login">Login</button> 
	 	</form>
	</div>  <!-- panel ending -->
 </div>
</body>
</html>

<?php
	session_start();

      $admin_uname = "admin";
      $admin_pwd = "admin";

      $manager_uname = "manager";
      $manager_pwd = 1234;
      
      $staff_uname = "staff";
      $staff_pwd = 1234;

    if(isset($_POST['username'],$_POST['password'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];

        if(($username == $admin_uname && $password == $admin_pwd) || ($username == $manager_uname && $password == $manager_pwd) || ($username == $staff_uname && $password == $staff_pwd)){

        	$_SESSION['admin'] = 1;
          $_SESSION['username'] = $username;
        	
        	if($username == 'admin')
        	{
		    	$_SESSION['role'] = 1;    	
        	}
        	else if($username == 'manager')
        	{
	        	$_SESSION['role'] = 2;
        	}
        	else
        	{
        		$_SESSION['role'] = 3;
        	}
        	

        if (isset($_POST["remember"])) {

        setcookie ("member_login",$username,time()+ (10 * 365 * 24 * 60 * 60));
        setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
                
        } else {
                if(isset($_COOKIE["member_login"])) {
                  setcookie ("member_login", "");
                }
                if(isset($_COOKIE["member_password"])) {
                  setcookie ("member_password", "");
                }
        }
        header("location: datatable.php");

		} else {
          echo "<script>alert('Username/password is incorrect'); </script>";
		}
  }
?>



