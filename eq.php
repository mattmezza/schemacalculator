<?php

require 'vendor/autoload.php';
use \Matt\InputParser;

if(!empty($_GET['F']) && !empty($_GET['G'])) {
	$ip = new InputParser($_GET['F'], $_GET['G']);
}

?>
<!doctype html>
<html ng-app="equivalence">
	<head>
		<title>Equivalence</title>
		<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.10/angular.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.js"></script>
		<script src="assets/js/equivalence.js"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div ng-controller="EquivalenceCtrl">
			<form method="get" action="">
				F = {<input type="text" name="F" value="<?php if($ip) echo $ip->getFSetObject(); else ""; ?>" style="width: 300px;" />}
				<br />
				G = {<input type="text" name="G" value="<?php if($ip) echo $ip->getGSetObject(); else ""; ?>" style="width: 300px;" />}
				<br />
				<input type="submit" value="Check" />
			</form>
		</div>
	</body>
</html>
