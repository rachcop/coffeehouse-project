<?php
//start output buffering
ob_start();

//initialize session
session_start();

//check for a page title value
if (!isset($page_title)) {
	$page_title = 'Register';
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

<body class="register">
	<div class="row menu">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 reg_nav">
			<a href="index.php" title="Home Page">Home</a><br />
			<?php
			//completes the template
		
			//display links based on login status
			if (isset($_SESSION['user_id'])) {
				
			echo '<a href="logout.php" title="Logout">Logout</a><br />
			<a href="change_password.php" title="Change Your Password">Change Password</a><br />';
			
			} else { // not logged in
			
				echo '<a href="register.php" title="Register for the Site">Register</a><br />
				<a href="forgot_password.php" title="Forgot Password">Forgot Password</a><br />';
			}
			?>	
			<a href="coffee.php" title="Blends">Blends</a><br />
			<a href="contact.php" title="Contact Us">Contact Us</a>
		</div>
	</div><!--/#menu-->

<div class="container">
	<h1>Be a part of our community - Register today!</h1>
	
	<form action="register.php" method="post" class="users2">
		<p>Enter your information in the form below to join our online community!</p>
		<fieldset>
			<p><strong>First Name:</strong> <br /><input type="text" name="first_name" size="20" maxlength="20" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" /></p>
			
			<p><strong>Last Name:</strong> <br /><input type="text" name="last_name" size="20" maxlength="30" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" /></p>
			
			<p><strong>Username:</strong> <br /><input type="text" name="username" size="20" maxlength="30" value="<?php if (isset($trimmed['username'])) echo $trimmed['username']; ?>" /></p>
			
			<p><strong>Email Address:</strong> <br /><input type="text" name="email" size="30" maxlength="60" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" /></p>
			
			<p><strong>Password:</strong> <br /><input type="password" name="password1" size="20" maxlength="20" value="<?php if (isset($trimmed['password1'])) echo $trimmed['password1']; ?>" /> <br /><small>Use only letters, numbers and underscore characters. Must be between 4 and 20 characters long.</small></p>
			
			<p><strong>Confirm Password:</strong> <br /><input type="password" name="password2" size="20" maxlength="20" value="<?php if (isset($trimmed['password2'])) echo $trimmed['password2']; ?>" /></p>
		</fieldset>
		
		<div align="center"><input type="submit" name="submit" value="Register" /></div>
	</form>
</div>
<?php

	//registration page for site
	require('includes/config.inc.php');
	$page_title = 'Register';
	
	
	$submit = strip_tags ($_POST['submit']);
	$name = strip_tags ($_POST['first_name']);
	$username = strip_tags($_POST['username']);
	$password1 = strip_tags($_POST['password1']);
	$password2 = strip_tags($_POST['password2']);

	if ($submit) {
	
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') { //handle the form
	
		//need the database connection
		require(MYSQL);
		
		//trim all incoming data
		$trimmed = array_map('trim', $_POST);
		
		//Assume invalid values
		$fn = $ln = $e = $p = FALSE;
		
		//check for a first name
		if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
			$fn = mysqli_real_escape_string($dbc, $trimmed['first_name']);
		} else {
			echo '<p class="error">Please enter your last name!</p>';
		}
		
		//check for an email address
		
		if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
			$e = mysqli_real_escape_string($dbc, $trimmed['email']);
		
		} else {
		
			echo '<p class="error">Please enter a valid email address.</p>';
		
		}
		
		//check for a password and match against the confirmed password:
		if (preg_match('/^\w{4,20}$/', $trimmed['password1']) ) {
			if ($trimmed['password1'] == $trimmed['password2']) {
				$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
			} else {
				echo '<p class="error">Your password did not match the confirmed password. Please try again</p>';
			}
		} else {
			echo '<p class="error">Please enter a valid password.</p>';
		}
	
		if ($fn && $ln && $e && $p) { //if everything is ok
			
			//make sure the email address is availabe
			$q = "SELECT user_id FROM users WHERE email='$e'";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
			
			if (mysqli_num_rows($r) == 0) { // Available 
				
				//create an activation code
				$a = md5(uniqid(rand(), true));
				
				// add user to database
				$q = "INSERT INTO users (email, pass, first_name, last_name, active, registration_date) VALUES ('$e', SHA1('$p'), '$fn', '$ln', '$a', NOW() )";
				$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
				
				if (mysqli_affected_rows($dbc) == 1) { //if it ran ok
					//send the email
					$body = "Thank you for registering at Granny Joans Coffee House. To activate your account, please click this link:\n\n";
					$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
					mail($trimmed['email'], 'Registration Confirmation', $body, 'From: admin@grannyjoanscoffee.com');
					
					//finish the page:
					echo '<h3>Thank you for registering! A confirmation email has been sent to your account.</h3>';
					exit();
				
				} else { //if it did not run ok
					echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
				}
				
			} else { // the email address is not available
				echo '<p class="error">Hmm...looks like that email address has already been registered. If you have forgotten your password, use the links above to have your password sent to you.</p>';
			}
		
		} else { // if one of the data testes failed
			echo '<p class="error">Please try again.</p>';
		}
		
		//encrypt password
		$password1 = md5($password1);
		$password2 = md5($password2);
		
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
		
		$queryreq = mysql_query("
			INSERT INTO users VALUES ('$first_name','$last_name','$username,'$email','$password1');
		");
		
		die("You have been registered! An activation code has been sent to your email account. Return to <a href='index.php'>home</a> page");
		
		mysqli_close($dbc);
	
	} //end of main submit conditional
	
?>
</body>
</html>