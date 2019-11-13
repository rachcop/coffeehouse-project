<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>

<body>
<?php
	//Define constants and settings, define useful functions and dictate how errors are handled
	
	//Created by Rachel Coppens - July 21, 2017 for Granny Joan's Coffee House website
	
	//******************Settings********************//
	
	
	//Flag variable for site status
	define('LIVE', FALSE);
	
	//Admin contact address
	define('EMAIL', 'grannyjoanscoffee@gmail.com');
	
	//Site URL (acts as base for all redirections)
	define('BASE_URL', 'http://rachelcoppens.com/coffeehouse/index.php');
	
	//Location of MySQL connection script
	define('MYSQL', 'includes/mysqli_connect.php');
	
	//Adjust the timezone for PHP 5.1 and above
	date_default_timezone_set('US/Eastern');
	
	//*****************Error Management Settings****************//
	
	//Create error handler
	function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {
		
		// error message
		$message = "An error occurred in script '$e_file' on line $e_line: $e_message\n";
		
		// Add date and time
		$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n";
		
		if (!LIVE) { //Development (print error)
			
			//show the error message
			echo '<div class="error">' . nl2br($message);
			
			// add the variables and backtrace
			echo '<pre>' . print_r($e_vars, 1) . "\n";
			debug_print_backtrace();
			echo '</pre></div>';
		} else { //don't show the error
			
			//send email to admin
			$body = $message . "\n" . print_r($e_vars, 1);
			mail(EMAIL, 'Site Error!', $body, 'From: grannyjoanscoffee@gmail.com');
			
			//only print an error message if the error isn't a notice
			if ($e_number != E_NOTICE) {
				echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div><br />';
			}
			
		} // End of !LIVE IF
		
	} // end of my_error_handler definition
	
	//use my error handler
	set_error_handler('my_error_handler');
	
	//****************Error management*****************//
	
	
?>
</body>
</html>