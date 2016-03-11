<!doctype html>
<html ng-app="app">
<script type="text/javascript">var baseURL = "<?php echo $baseURL;?>";</script>
<?php include_once $serverPath.'resources/templates/header.php';?>
<?php include_once $serverPath.'resources/templates/menu.php';?>

<script> 	
var baseURL = "<?php echo $baseURL;?>";
</script>
<?php 
include_once $serverPath . 'utils/db/connect.php';

if(!empty($_GET['error'])){
	sendErrorMessage($_GET['error']);
};
?>