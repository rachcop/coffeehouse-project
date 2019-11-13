<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $page_title; ?></title>
</head>

<body>
<?php
	
	//this is the logout page for the site
	require('includes/config.inc.php');
	$page_title = 'Logout';
	
	//if no first_name session variable exists, redirect the user
	if (!isset($_SESSION['first_name'])) {
		
		$url = BASE_URL . 'index.php'; // define url
		ob_end_clean(); // delete buffer
		header("Location: $url");
		exit(); // quit script
	} else { // logout the user
		$_SESSION = array(); // destroy the variables
		session_destroy(); // destroy the session itself
		setcookie(session_name(), '', time()-3600); // destroy the cookie
	}
	
	//print the customized messages
	echo '<h3>You are now logged out.</h3>';
?>
</body>
</html>