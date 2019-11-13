<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>

<body>
<?php
	//show messages in a thread
	include('includes/header.php');
	
	//check for thread id
	$tid = FALSE;
	if (isset($_GET['tid']) && filter_var($_GET['tid'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
		
		//shorthand version of thread id
		$tid = $_GET['tid'];
		
		//convert the date if user is logged in
		if (isset($_SESSION['user_tz'])) {
			$posted = "CONVERT_TZ(p.posted_on, 'UTC', '{$_SESSION['user_tz']}')";
		} else {
			$posted = 'p.posted_on';
		}
		
		//run the query
		$q = "SELECT t.subject, p.message, username, DATE_FORMAT($posted, '%e-%b-%y %1:%i %p') AS posted FROM threads AS t LEFT JOIN posted AS p USING (thread_id) INNER JOIN users AS u ON p.user_id = u.user_id WHERE t.thread_id = $tid ORDER BY p.posted_on ASC";
		$r = mysqli_query($dbc, $q);
		if (!(mysqli_num_rows($r) > 0)) {
			$tid = FALSE; // invalid thread id
		}
	} //end of isset($_GET['tid']) IF
	
	if ($tid) { //get messages in the thread
		
		$printed = FALSE; //flag variable
		
		//Fetch each
		while ($messages = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			
			//print subject one time only
			if (!$printed) {
				echo "<h2>{$messages['subject']}</h2>\n";
				$printed = TRUE;
			}
			
			//print the message
			echo "<p>{$messages['username']} ({$messages['posted']})<br />{$messages['message']}</p><br />\n";
		} // end of while loop
		
		//show the form to post a message
		include('includes/post_form.php');
	} else { //invalid thread id
		echo '<p>This page has been accessed in error.</p>';
	}
	
?>
</body>
</html>