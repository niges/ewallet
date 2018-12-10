<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript" src="http://localhost/ewallet/static/finchjs/finch.min.js"></script>
	<script type="text/javascript" src="http://localhost/ewallet/static/handlebars-v4.0.12.js"></script>
	<script type="text/javascript" src="http://localhost/ewallet/build/app.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
	    <div class="col-md-12">
	        <h1 align="center" >Single page Application</h1>
	        <div id="menu">
		        <button class="navigator btn btn-primary" data-route="register" id="register">Register</button>
		        <button class="navigator btn btn-success" data-route="login" id="login">Login</button>
	    	</div>
	        <div id="render"></div>
	    </div>
	<?php require_once( 'build/templates.php' ); ?>
	</div>
	
</div>
</body>

</html>