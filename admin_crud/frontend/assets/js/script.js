var fetch=angular.module("myApp",[])
fetch.controller('slideShowController', ['$scope', '$http', function ($scope, $http) {
      
	$http({
		method: 'get',
		url: 'getdata.php'
		}).then(function successCallback(response) {
		    $scope.images = response.data;
	});
}]);
