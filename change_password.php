<?php
//start output buffering
ob_start();

//initialize session
session_start();

//connect to database
DEFINE ('DB_USER', 'rachel26');
DEFINE ('DB_PASSWORD', 'coffee4life');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'rachel26_forum');
	
//make the connection 
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
//if no connection, trigger an error
if (!$dbc) {
	trigger_error('Could not connect to MySQL: ' . mysqli_connect_error() );
} else { //set the encoding
		
	//encoding
	mysqli_set_charset($dbc, 'utf8');
		
}

//check for a page title value
if (!isset($page_title)) {
	$page_title = 'Reset Password';
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $page_title; ?></title>
<link href="https://fonts.googleapis.com/css?family=Codystar|Raleway:100" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body class="change">
<?php
	//allow a logged-in user to change their password
	require('includes/config.inc.php');
	$page_title = 'Reset Password';
	
	//if no first_name session variable exists, redirect the user 
	if (isset($_SESSION['user_id'])) {
		
		$url = BASE_URL . 'index.php';
		//define url
		ob_end_clean(); // delete buffer
		header("Location: $url");
		exit(); // quit the script
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		require(MYSQL);
		
		//check for new password and match against the confirmed password
		$p = FALSE;
		if (preg_match ('/^(\w){4,20}$/', $_POST['password1']) ) {
			if ($_POST['password1'] == $_POST['password2']) {
				$p = mysqli_real_escape_string($dbc, $_POST['password1']);
			} else {
				echo '<p class="error">Your password did not match the confirmed password.</p>';
			}
			
		} else {
			echo '<p class="error">Please enter a valid password.</p>';
		}
		
		if ($p) { // if everything is ok
			//make the query
			$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id={$_SESSION['user_id']} LIMIT 1";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
			if (mysqli_affected_rows($dbc) == 1) { // if it ran ok
				//send an email
				echo '<h3>Your password has been changed</h3>';
				mysqli_close($dbc); // close the database connection
				exit();
			} else { // if it did not run ok 
				echo '<p class="error">Your password was not changed. Make sure your new password is different than the current password. Contact the system administrator if you think an error occurred.</p>';
				
			}
		} else { // failed the validation
			echo '<p class="error">Please try again.</p>';
		}
		
		mysqli_close($dbc); // close the database connection
	
	} // end of main submit conditional
	
?>
<div class="changecontainer">
	<h1>Change Your Password</h1>
	<form action="change_password.php" method="post">
		<fieldset>
			<p><strong>New Password:</strong> <input type="password" name="password1" size="20" maxlength="20" /><br /><small>Use only letters, numbers, and underscores. Must be between 4 and 20 characters long.</small></p>
			<p><strong>Confirm New Password:</strong> <input type="password" name="password2" size="20" maxlength="20" /></p>
		</fieldset>
		<div align="left">
			<input type="submit" name="submit" value="Change My Password" />
		</div>
	</form>

	<div class="row">
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 connect">
		<img src="images/facebook.png" alt="facebook" title="Facebook">
		<img src="images/instagram.png" alt="instagram" title="Instagram">
		<img src="images/twitter.png" alt="twitter" title="Twitter">
		<a href="mailto:grannyjoanscoffee@gmail.com?Subject=Hello" target="_top"><img src="images/email.png" alt="email" title="Email"></a>
		<p class="logincopy"><a href="index.php">Granny Joan's Coffee House &copy; 2017</a></p>
	</div>
	</div>
</div>
</body>
</html>