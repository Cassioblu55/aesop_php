<?php
     include_once '../config/config.php';
     include_once $serverPath.'resources/templates/head.php';
?>

<div ng-controller="YOURController">
     <form action="YOURPAGE.php" method="post">
          <div class="container-fluid">
                    <div class="col-md-6">

               <div class="panel panel-default">
                    <div class="panel-heading">
                         <h3 class="panel-title">Title Here</h3>
                    </div>
               <div class="panel-body">
                    Body Here

                </div>
                    <div class="panel-footer">
                         <button class="btn btn-primary" type="submit">Save</button>

                         <a class="btn btn-danger" href="<?php echo $baseURL?>">Cancel</a>
                    </div>
              </div>
          </div>
          </div>
     </form>
</div>

<script>

app.controller("YOURController", ['$scope', "$controller", function($scope, $controller){

angular.extend(this, $controller('UtilsController', {$scope: $scope}));

}]);

</script>
