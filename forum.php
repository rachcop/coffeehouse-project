<?php
//start output buffering
ob_start();

//initialize session
session_start();

//check for a page title value
if (!isset($page_title)) {
	$page_title = 'Message Board | Granny Joan\'s Coffee House';
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $page_title; ?></title>
<meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=Codystar|Raleway:100" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
</head>

<body class="msgboard">
	<div class="bgimg-1">
		<div class="row">
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 breadcrumbs">
 				<p><a href="index.php">Home</a>  /  Message Board</p>
  				<p class="logs"><a href="login.php">Login</a>  /  <a href="includes/logout.php">Logout</a></p>
			</div>
  		</div>
   		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 connect">
                <img src="images/facebook.png" alt="facebook" title="Facebook">
                <img src="images/instagram.png" alt="instagram" title="Instagram">
                <img src="images/twitter.png" alt="twitter" title="Twitter">
                <a href="mailto:grannyjoanscoffee@gmail.com?Subject=Hello" target="_top"><img src="images/email.png" alt="email" title="Email"></a>
                <div class="input-group">
                      <input type="text" name="search" class="form-control" title="Search" placeholder="Search">
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="button">Go</button>
                      </span>
                  </div><!-- /input-group -->
                 
        </div><!--/connect-->
    	<div class="caption">
    		<span class="border">Granny Joan's Coffee House</span><br />
    		<span class="border">Message Board</span>
   		</div>
    </div>

	<div style="color: #777;background-color:rgba(255,255,255,0.80);text-align:center;padding:10px;text-align: center;">
  		<h3 style="text-align:center;">Welcome!</h3>
  		<p>&nbsp;</p>
 	 	<p>Our message board is intended to be a common place for like-minded coffee lovers to come together and discuss coffee!</p>
		<p><em>Note: Users must login before posting to the message board.</em><br /><small><a href="login.php">Login now</a></small></p> 
		<p>Don't have an account, no worries - you can <a href="register.php">register here!</a></p>
	</div>



	<div class="bgimg-2">
    	<div class="caption">
    	</div>
    </div>

	<div style="position:relative;">
		<div style="color:#ddd;background-color:rgba(245,177,66,0.60);text-align:center;padding:50px 80px;text-align: justify;">
			<p class="lovers">COFFEE LOVERS UNITE!</p>
			<p class="post"><a href="post_form.php">Post a message</a></p>
			<p></p>
		</div>
	</div>


<?php 
	require('includes/mysqli_connect.php');
	$page_title = 'Message Board | Granny Joan\s Coffee House';
	
	
	
	//Show threads in the message board
	//If user is logged in and has chosen a time zone, use that to convert that dates and times
	
	if (isset($_SESSION['user_tz'])) {
		$first = "CONVERT_TZ(p.posted_on, 'UTC', '{$_SESSION['user_tz']}')";
		$last = "CONVERT_TZ(p.posted_on, 'UTC', '{$_SESSION['user_tz']}')";
	} else {
		$first = 'p.posted_on';
		$last = 'p.posted_on';
	}
	
	
	//Retrieve all threads for message board, with original user, original post date, date of last reply and the number of replies
	
	$q = "SELECT t.thread_id, t.subject, username, COUNT(post_id) - 1 AS responses, MAX(DATE_FORMAT ($last, '%e-%b-%y %1:%i %p')) AS last, MIN(DATE_FORMAT($first, '%e-%b-%y %1:%i %p')) AS first FROM threads AS t INNER JOIN posts AS p USING (thread_id) INNER JOIN users AS u ON t.user_id = u.user_id WHERE t.lang_id = {$_SESSION['lid']} GROUP BY (p.thread_id) ORDER BY (p.thread_id) ORDER BY last DESC";
	$r = mysqli_query($dbc, $q);
	if (mysqli_num_rows($r) > 0) {
		
		//Create a table
		echo '<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
			<tr>
				<td align="left" width="50%"><em>' . $words['subject'] . '</em>:</td>
				<td align="left" width="20%"><em>' . $words['posted_by'] . '</em>:</td>
				<td align="center" width="10%"><em>' . $words['posted_on'] . '</em>:</td>
				<td align="center" width="10%"><em>' . $words['replies'] . '</em>:</td>
				<td align="center" width="10%"><em>' . $words['latest_reply'] . '</em>:</td>
			</tr>';
		
		//Fetch each thread
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			
			echo '<tr>
					<td align="left"<a href="read.php?tid=' . $row['thread_id'] .'">' . $row['subject'] . '</a></td>
					<td align="left">' . $row['username'] . '</td>
					<td align="center">' . $row['first'] . '</td>
					<td align="center">' . $row['responses'] . '</td>
					<td align="center">' . $row['last'] . '</td>
				</tr>';
			
		} //end of while
	
	echo '</table'; //Complete the table
	
	} else {
		echo '<p>There are currently no messages...yet</p>';
	}
	

?>
</body>
</html>