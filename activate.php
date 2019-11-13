<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>

<body>
<?php
	
	//activate the user's account
	require('includes/config.inc.php');
	$page_title = 'Activate Your Account';
	
	//if $x and $y don't exit or aren't of the proper format, redirect user
	if (isset($_GET['x'], $_GET['y']) && filter_var($_GET['x'], FILTER_VALIDATE_EMAIL) && (strlen($_GET['y']) == 32) ) {
		
		//update the database 
		require(MYSQL);
		$q = "UPDATE users SET active=NULL WHERE (email='" . mysqli_real_escape_string($dbc, $_GET['x']) . "' AND active='" . mysqli_real_escape_string($dbc, $_GET['y']) . "') LIMIT 1";
		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		// print a customized message
		if (mysqli_affected_rows($dbc) == 1) {
			echo "<h3>Your account is now active, you may now login!</h3>";
		} else {
			echo '<p class="error">Your account could not be activated. Please re-check the link or contact the system administrator.</p>';
		}
		
		mysqli_close($dbc);
	} else { // redirect
		$url = BASE_URL . 'index.php'; // define the url
		ob_end_clean(); // delete the buffer
		header("Location: $url");
		exit(); // quit the script
	
	} //end of main IF-else
	
?>
</body>
</html>