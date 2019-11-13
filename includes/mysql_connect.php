<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php
//connect to database
	//set database access information as constants
	DEFINE ('DB_USER', 'rachel26');
	DEFINE ('DB_PASSWORD', 'coffee4life');
	DEFINE ('DB_HOST', 'localhost');
	DEFINE ('DB_NAME', 'rachel26_forum');
	
	//make the connection 
	$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());
	
	//encoding
	mysqli_set_charset($dbc, 'utf8');
?>
</body>
</html>