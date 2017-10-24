<!DOCTYPE html>
<html>
<head>
	<title>Babyshop Login</title>
</head>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
<body ng-app="myApp">
  <div ng-controller="myCtrl">
	<div class="container"><br>
	  <img src="./assets/images/index.png" width="200px" height="50px" id="loginimage">
		<div class="panel panel-default" id="loginpanel">
		<h2 class="text-left" id="login">Login</h2><hr>
		  <form name="form" ng-submit="signin(user)" novalidate>
			<div class="form-group">
			  <label for="Name">Email</label>
			  <input type="email" class="form-control" placeholder="Enter your email" name="email" required ng-model="user.email">
			  <span class="error" ng-show="form.email.$dirty && form.email.$error.required">Enter your email</span>
			</div>

			<div class="form-group">
			  <label for="pwd">Password</label>
			  <input type="password" class="form-control" placeholder="Enter password" name="password" required  ng-model="user.password">
			  <span class="error" ng-show="form.password.$dirty && form.password.$error.required">Enter your password</span>
			  <a href="" class="pull-right">Forgot password</a>
			</div><br>
			  <button class="btn btn-primary btn-block" name="login" id="login_btn" ng-disabled="form.$invalid">Login</button>
		  </form><br><br>
		  <p class="text-center" id="new"><span>New to babyshop</span></p>
		  <a href="signup.php" class="btn btn-default btn-block">Create an account</a>
		</div>
	</div>
  </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script>
	var app = angular.module('myApp', []);
	app.controller('myCtrl', function($scope, $http) {
		$scope.signin = function(user) {
		    var data = user;
		    $http({
		    	headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		    	method:"POST",
		    	url:"check.php",
		    	data: $.param({user}),
		    	dataType:"json",
		    }).then(function successCallback(response) {
					    console.log(response.data);
					if (response.data.success == false) {
						alert("Email or Password is incorrect");
					} else {
						window.location = "home.php";

					}
			});     
		}
	});
</script>