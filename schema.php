<?php

require 'vendor/autoload.php';
use \Matt\InputParser\SchemaParser;

$errors = array();
if (isset($_GET['R']) && isset($_GET['F'])) {
	try {
		$sp = new SchemaParser($_GET['R'], $_GET['F']);
		$schema = $sp->getSchema();
	} catch(\Exception $e) {
		array_push($errors, $e->getMessage());
	}
}
$R = "A, B, C";
$F = "A -> B, B -> C";
if(isset($schema)) {
	$R = strval($schema->getAttributeSet());
	$F = strval($schema->getFdSet());
}

?>
<!doctype html>
<html lang="en" ng-app>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="Schema calculator">
	    <meta name="author" content="Matteo Merola">
		<title>Schema Calculator</title>
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
		<style>
			body {
			  padding-top: 50px;
			}
			.starter-template {
			  padding: 40px 15px;
			  text-align: center;
			}
		</style>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="schema.php">Schema Calculator</a>
	        </div>
	        <div class="collapse navbar-collapse">
	          <ul class="nav navbar-nav">
	            <!-- <li class="active"><a href="schema.php">Schema</a></li>
	            <li><a href="#github">GitHub</a></li> -->
	          </ul>
	        </div> 
	      </div>
	    </div>

		<div class="container">
			<div class="starter-template">
		        <h1>Schema Calculator</h1>
		        <p class="lead">Use these form to quickly find out some information about a relational schema.
		        	<br>By submitting this form you'll have some closures and the key of the relation calculated.</p>
		    	<div style="width: 600px; margin: 0 auto;">
					<form class="form-horizontal" role="form" method="get" action="">
						<div class="form-group">
						    <label for="R" class="col-sm-2 control-label">R = </label>
						    <div class="col-sm-10">
						      <input id="R" type="text" name="R" value="<?php echo $R; ?>" style="width: 450px;" placeholder="Insert some attributes" />
						    </div>
						</div>
						<div class="form-group">
						    <label for="F" class="col-sm-2 control-label">F = </label>
						    <div class="col-sm-10">
						      <input id="F" type="text" name="F" value="<?php echo $F; ?>" style="width: 450px;" placeholder="Insert some functional dependencies"/>
						    </div>
						</div>
						<div class="form-group">
						    <div class="col-sm-offset-2 col-sm-10">
						      <button type="submit" class="btn btn-primary">Calculate</button>
						    </div>
						</div>
					</form>
				</div>
				<div style="margin-top: 50px;">
			<?php
				foreach ($errors as $error) {
					echo '<p class="text-danger">'.$error."</p>";
				}

				if(isset($schema)) {
					echo '<p>'.$schema.'</p>';
					foreach ($schema->getFdSet()->getDependencies() as $dependency) {
						$attrset = $dependency->getAlpha();
						echo "<p>closure of ".$attrset.": ";
						echo $schema->getFdSet()->calculateClosureOf($attrset).'</p>';
					}
					echo "<p>a key: ";
					$a_key = $schema->calculateAKey();
					echo $a_key.'</p>';
				}
			?>
				</div>
			</div>
		</div>
		<a href="https://github.com/mattmezza/schemacalculator"><img style="position: absolute; top: 0; right: 0; border: 0; z-index: 99999999;" src="https://camo.githubusercontent.com/652c5b9acfaddf3a9c326fa6bde407b87f7be0f4/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6f72616e67655f6666373630302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_orange_ff7600.png"></a>
		<script src="bower_components/jquery/dist/jquery.min.js"></script>
    	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	</body>
</html>
