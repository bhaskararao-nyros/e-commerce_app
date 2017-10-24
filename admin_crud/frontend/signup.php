<!DOCTYPE html>
<html>
<head>
	<title>Babyshop Sign up</title>
</head>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./assets/css/style.css">
<body ng-app="myApp">
<div ng-controller="MyCtrl">
	<div class="container"><br>
	  <img src="./assets/images/index.png" width="200px" height="50px" id="loginimage">
		<div class="panel panel-default" id="loginpanel">
		<h2 class="text-left" id="login">Create an account</h2><hr>
		  <form name="form" ng-submit="signup(user)" novalidate>

		  	<div class="form-group">
			  <label for="Name">Name</label>
			  <input type="text" class="form-control" placeholder="Enter your name" name="name" ng-pattern="/^[a-zA-Z]*$/" required ng-model="user.name">
			  <span class="error" ng-show="form.name.$dirty && form.name.$error.required">Enter your name</span>
			  <span class="error" ng-show="form.name.$dirty && form.name.$error.pattern">Name in characters only</span>
			</div>

			<div class="form-group">
			  <label for="Mobile">Mobile Number</label>
			  <input type="text" class="form-control" placeholder="Enter your mobile number" name="mobile" required ng-minlength="10" ng-maxlength="10" ng-model="user.mobile">
			  <span class="error" ng-show="form.mobile.$dirty && form.mobile.$error.required">Enter your mobile number</span>
			  <span class="error" ng-show="form.mobile.$dirty && (form.mobile.$error.minlength || form.mobile.$error.maxlength)">Mobile number should be 10 digits</span>
			</div>

			<div class="form-group">
			  <label for="Name">Email</label>
			  <input type="email" class="form-control" placeholder="Enter your email" name="email" required ng-model="user.email">
			  <span class="error" ng-show="form.email.$dirty && form.email.$error.required">Enter your email</span>
			  <span class="error" ng-show="form.email.$dirty && form.email.$error.email">Enter a valid email</span>
			</div>

			<div class="form-group">
			  <label for="pwd">Password</label>
			  <input type="password" class="form-control" placeholder="Enter password" name="password" required ng-minlength="8" ng-model="user.password">
			  <span class="error" ng-show="form.password.$dirty && form.password.$error.required">Enter your password</span>
			  <span class="error" ng-show="form.password.$dirty && form.password.$error.minlength">Password should be 8 characters</span>
			</div>
			  <button type="submit" class="btn btn-primary btn-block" name="login" id="login_btn" ng-disabled="form.$invalid">Sign up</button>
		  </form><br><br>
		  <p class="text-center" id="new"><span>Already have an account</span></p>
		  <a href="login.php" class="btn btn-default btn-block">Signin</a>
		</div>
	</div>
</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script>
		var app = angular.module('myApp', []);
			app.controller('MyCtrl', function($scope, $http) {
			  $scope.signup = function(user) {
			    var data = user;
			    $http({
			    	headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			    	method:"POST",
			    	url:"insert.php",
			    	data: $.param({user}),
			    	dataType:"json",
			    }).then(function successCallback(response) {
						    if (response.data.success == true) {
						    	
						    	window.location = "home.php";
						    }
					});     
			  }
			});
</script>
