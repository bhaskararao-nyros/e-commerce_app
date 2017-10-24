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
  <img src="./assets/images/admin.jpg" width="400px" height="100px">
 	<div class="panel panel-default"> 
 	  <h2 id="heading">Login</h2>
	 	<form action="" method="post">
	 	  <div class="form-group">
	 	    <span id="nametext" class="hide">Enter username</span>
			<input type="text" class="form-control inputcontrol" placeholder="Enter username" id="username" name="username">
			<div id="nameErr"></div>
		  </div>
		  <div class="form-group">
		    <span id="passtext" class="hide">Enter password</span>
			<input type="password" class="form-control inputcontrol" placeholder="Enter password" id="password" name="password">
			<div id="passErr"></div>
		  </div>
		  <button class="btn btn-md btn-primary" id="login_btn" name="login">Login</button> 
	 	</form>
	</div>  <!-- panel ending -->
 </div>
</body>
</html>