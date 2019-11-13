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
	$page_title = 'Forgot Password';
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

<body class="forgot">
<?php
	
	//allows user to reset their password, if forgotten
	
	require('includes/config.inc.php');
	$page_title = 'Forgot Password';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require(MySQL);
		
		//assume nothing
		$uid = FALSE;
		
		//validate the email address
		if (!empty($_POST['email'])) {
			
			//check for the existence of that email address
			$q = 'SELECT user_id FROM users WHERE email="'. mysqli_real_escape_string($dbc, $_POST['email']) . '"';
			$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
			
			if (mysqli_num_rows($r) == 1) { // retrieve the user id
				list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
			} else { // no database match
				echo '<p class="error">Hmm..the submitted email address does not match those on file.</p>';
			}
			
		} else { // no email
			echo '<p class="error">Oops, you forgot to enter your email address!</p>';
		} // end of empty ($_POST['email']) IF
		
		if ($uid) { // if everything is ok
			//create a new random password:
			$p = substr( md5(uniqid(rand(), true)), 3, 10);
			
			//update the database:
			$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id=$uid LIMIT 1";
			$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
			
			if (mysqli_affected_rows($dbc) == 1) { //if it ran ok
				//send an email
				$body = "Your password to log into <strong>Granny Joan'\s Coffee House has temporarily been changed to '$p'. Please log in using this password and this email address. From there, you can change your password to something more familiar to you!";
				mail ($_POST['email'], 'Your temporary password.', $body, 'From: admin@grannyjoanscoffee.com');
				
				//print the message and wrap up
				echo '<h5>Your password has been changed. You will receive the new, temporary password at the email address with which you registered. Once you have logged in with this password, you can change it by clicking on the "Change Password" link.</h3>';
				mysqli_close($dbc);
				exit(); //stop the script
			
			} else{ // if it did not run ok
				
				echo '<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';
				
			}
		
		} else { //failed the validation test
			echo '<p class="error">Please try again.</p>';
			
		}
		
		mysqli_close($dbc);
		
	} // end of main submit conditional 

?>
<div class="forgotcontainer">
	<h1>Reset Your Password</h1>
	<p>Enter your email address below and your password will be reset.</p>
	<form action="forgot_password.php" method="post">
		<fieldset>
			<p><strong>Email Address:</strong> <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
		</fieldset>
		<div align="left">
			<input type="submit" name="submit" value="Reset My Password" />
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