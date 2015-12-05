var app = angular.module('app',['ui.grid']);

function getUrlParam(param){
	var p = location.search.split(param+"=")[1]
    return (p) ? p.split("&")[0] : null;
}

function getID(){
	var id = getUrlParam("id");
	return (id && isNumeric(id)) ? id : null;
}

function keyFromValue(hash, value){
	for ( key in hash){
		if(hash[key] == value){
			return key;
		}
	}
}

function isNumeric(n) {
	  return !isNaN(parseFloat(n)) && isFinite(n);
}

function randomRange(min, max){
	return Math.floor(Math.random() * max) + min;
}

function cutString(string, n){
	return string.substring(0, (string.length-n));
}

//Will run function if one is passed
function run(funt){
	if(funt){funt();}
}

function logObject(object){
	console.log(JSON.stringify(object));
}

function failedHTTPLog(){
	console.log("HTTP call was not sucessfull.");
}

function combine(s1, s2){
	return s1+" "+s2;
}

function getFeet(n){
	return Math.floor(Number(n)/12);
}

function getInches(n){
	return Math.floor(Number(n)%12);
}

function getHeightDisplay(n){
	return getFeet(n)+"' "+getInches(n)+"''";
}

function displaySex(sex){
	if(sex=="M"){return "Male";}
	else if(sex=="F"){return "Female";}
	return "Other";
}

function randomKeyFromHash(hash){
	return randomFromArray(Object.keys(hash));
}

//Will take an array and return a value at a random interval
function randomFromArray(array){
	return array[Math.floor((Math.random() * array.length))];
}

function isEdit(){
	return getID() != null;
}

function getTrapSting(traps){
	var trapStrings = [];
	for(var i=0; i< traps.length; i++){
		var trapString = []; var trap = traps[i];
		trapString.push(trap.id);
		trapString.push(trap.column);
		trapString.push(trap.row);
		trapStrings.push(trapString);
	}
	return JSON.stringify(trapStrings);
}

app.controller("UtilsController", ['$scope', "$http", "$window", function($scope, $http, $window){	
	
	$scope.deleteById = function(id, name, runOnSuccess, runOnFailed){
		runOnFailed = runOnFailed || failedHTTPLog;
		if(window.confirm("Are you sure you want to delete "+name+"?")){
			$http.post('delete.php?id='+id)
			.then(function(response){
				run(runOnSuccess);
			}, function errorCallback(response){
				run(runOnFailed);
			});
		}
	}
	
	$scope.deleteWithRedirect = function(id, name){
		$scope.deleteById(id, name, $scope.redirectToIndex);
	}
	
	$scope.redirectToIndex = function(){
		$window.location.href ="index.php";
	}
	
	$scope.setFromGet = function(get, setFunct, runOnFailed){
		runOnFailed = runOnFailed || failedHTTPLog;
		$http.get(get).then(function(response){
			setFunct(response.data);
		}, function errorCallback(response){
			run(runOnFailed);
		});
	}
	
	$scope.setById = function(setFunct){
		var id = getID();
		if(id){
			var get = 'data.php?id='+id;
			$scope.setFromGet(get, setFunct);
		}
	}
	
}]);