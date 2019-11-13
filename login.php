<?php
//start output buffering
ob_start();

//initialize session
session_start();



//check for a page title value
if (!isset($page_title)) {
	$page_title = 'Login';
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

<body class="log">

	<div id="container">
	<div class="row users">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 credentials">
			<h2>Welcome to <br />Granny Joan's Coffee House!</h2>
			<img src="images/logo.png" class="loginlogo" alt="logo" title="Granny Joan's Coffee Logo">
				<h3>Please login <br /><small>Your browser must allow cookies in order to log in.</small></h3>
				<form action="login.php" method="post">
					<p>Email Address: <br /><input type="text" name="email" size="20" maxlength="60" /></p>
					<p>Password: <br /><input type="password" name="pass" size="20" maxlength="20" /></p>
					<p><input type="submit" class="send" name="submit" value="Login" /></p>
				</form>
				<p>Forgot password? <br /><a href="forgot_password.php">Reset here</a></p>
				<h5>Don't have an account? <a href="register.php">Register now</a>!</h5>
				<p>Skip login and continue to <a href="index.php">Home</a></p>
			</div><!--/credentials-->
		</div><!--/login-->
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 connect">
        	<img src="images/facebook.png" alt="facebook" title="Facebook">
            <img src="images/instagram.png" alt="instagram" title="Instagram">
            <img src="images/twitter.png" alt="twitter" title="Twitter">
            <a href="mailto:grannyjoanscoffee@gmail.com?Subject=Hello" target="_top"><img src="images/email.png" alt="email" title="Email"></a>
            <p class="logincopy">Granny Joan's Coffee House &copy; 2017</p>
        </div>
	</div><!--/container-->	
<?php
	//login page for the site
	require('includes/config.inc.php');
	$page_title = 'Login';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require(MYSQL);
		
		//validate the email address
		if (!empty($_POST['email'])) {
			$e = mysqli_real_escape_string($dbc, $_POST['email']);
		} else {
			$e = FALSE; 
			echo '<p class="error">Oops! You forgot to enter your email address!</p>';
		}
		
		//validate the password
		if (!empty($_POST['pass'])) {
			$p = mysqli_real_escape_string($dbc, $_POST['pass']);
		} else {
			$p = FALSE;
			echo '<p class="error">Uh oh - you forgot to enter your password!</p>';
		}
		
		if ($e && $p) { //if everything ok
			//query the database
			$q = "SELECT user_id, first_name, user_level FROM users WHERE (email='$e' AND pass=SHA1('$p')) AND active IS NULL";
			$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\ n<br />MySQL Error: " . mysqli_error($dbc));
			
			if (@mysqli_num_rows($r) == 1) {
				//a match was made
				//register the values
				$_SESSION = mysqli_fetch_array($r, MYSQLI_ASSOC);
				mysqli_free_result($r);
				mysqli_close($dbc);
				
				//redirect the user
				$url = BASE_URL . 'index.php';
				//define the url
				ob_end_clean(); // delete the buffer
				header("Location: $url");
				exit(); // quit the script
			
			} else { //no match made
				echo '<p class="error">Either the email address and password entered do not match those on file or you have not yet activated your account.</p>';
				
			}
		
		} else { // if everything wasn't ok
			echo '<p class="error">Please try again.</p>';
			
		}
		
	} // end of submit conditional
	
	//Setting cookies
	//check if server form has been submitted:
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		///database connection
		require ('includes/mysqli_connect.php');
		
		//check the login:
		list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
		
		if ($check) { //OK
			//Set cookies
			setcookie ('user_id', $data['user_id'], time()+3600, '/', '', 0, 0);
			setcookie ('first_name', $data['first_name'], time()+3600, '/', '', 0, 0);
			
			//redirect
			redirect_user('index.hmtl');
		} else { //unsuccessful 
			//assign $data to $errors for error reporting
			$errors = $data;
		}
		
		mysqli_close($dbc);
	} //end of main submit conditional
	
?>
</body>
</html>