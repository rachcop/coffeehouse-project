<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>

<body>
<?php
	//show the form for posting messages
	
	//redirect if page is called directly.
	if (isset($words)) {
		header("Location: http://www.rachelc.sgedu.site/coffeehouse/index.php");
		exit();
	}
	
	//only display this form if the user is logged in
	if (isset($_SESSION['user_id'])) {
		
		//display the form
		echo '<form action="post.php" method="post" accept-charset="utf-8">';
		
		//if on read.php
		if (isset($tid) && $tid) {
			
			//print a caption
			echo '<h3>' . $words['post_a_reply'] . '</h3>';
			
			//add thread id as a hidden input
			echo '<input name="tid" type="hidden" value="' . $tid . '" />'; 
		} else { //new thread
			
			//print a caption
			echo '<h3>' . $words['new_thread'] . '</h3>';
			
			//create the subject input
			echo '<p><em>' . $words['subject'] . '</em>: <input name="subject" type="text" size="60" maxlength="100" ';
			
			//check for existing value
			if (isset($subject)) {
				echo "value=\"$subject\" "; 
			}
			
			echo '/></p>';
		} //end of $tid if
		
		//create the body textarea
		echo '<p><em>' . $words['body'] . '</em>: <textarea name="body" rows="10" cols="60">';
		
		if (isset($body)) {
			echo $body;
		}
		
		echo '</textarea></p>';
		
		//finish the form 
		echo '<input name="submit" type="submit" value="' . $words['submit'] . '" /></form>';
	} else {
		echo '<p>You must be logged in to post messages.</p>';
	}
	
?>
</body>
</html>