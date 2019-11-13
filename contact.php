<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Get in Touch!</title>
<link href="https://fonts.googleapis.com/css?family=Codystar|Raleway:100" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body class="contactform">
<div id="container">
<!--Header-->
	<div class="row header">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 breadcrumbs">
			<p><a href="index.php">Home</a>  /  Contact Us</p>
        
        </div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 connect pullright">
       	<p><a href="login.php">Login</a>  /  <a href="includes/logout.php">Logout</a></p>
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
        </div>
        
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 navs2">
		<img src="images/logo.png" class="logocontact" alt="logo" title="Granny Joan's Coffee House logo">
			<h1 class="contactpage">Granny Joan's Coffee House</h1>
			 <div class="nav">
             		<ul class="headernav">
              		<li><a href="index.php">Home</a></li>
               		<li><a href="coffee.php">Blends</a></li>
               		<li><a href="forum.php">Message Board</a></li>
               </ul>
			</div>
		</div><!--/row connect-->
	</div><!--/row header -->	

<!--Content-->
	<div class="row content">
	<!--sidebar-->
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 sidebar">
		<img src="images/contact.png" class="jcontact" alt="contact joan" title="Contact Joan">
		<div class="info">
			<div class="hours">
				<h4>Store Hours</h4>
				<p>Monday thru Wednesday: 9am - 7pm <br />Thursday &amp; Friday: 9am - 8pm <br />Saturday: 9am - 6pm <br />Sunday: 10am - 5pm</p>
			</div>
			<div class="address">
			<h4>Locations</h4>
			<h5>Granny Joan's Coffee House (Dundas)</h5>
			<p>635 Dundas St. W <br />Toronto, ON A1B 2C3<br /><strong>Phone:</strong> 416-123-4567</p>
			<h5>Granny Joan's Coffee House Pickup (Roncesvalles)</h5>
			<p>1647 Bloor St. W<br />Toronto, ON D4E 5F6<br /><strong>Phone:</strong> 647-890-1234</p>
			
			<a href="#"><img src="images/findfb.jpg" alt="find on facebook" title="Find us on Facebook!"></a>
		</div>
	</div><!--/info-->
	</div><!--/sidebar-->
	<!--form-->	
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 cform">
			<h2>Questions, comments or want to get in touch? Fill out the form below!</h2>	
			<h3> We can't wait to hear from you!</h3>
			<form enctype="multipart/form-data" action="contact.php" method="POST">
				<p>Name:* <br /><input type="text" name="name" size="30" maxlength="60" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" /></p>
				<p>Email Address:* <br /><input type="text" name="email" size="30" maxlength="80" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"</p>
				<p>Comments:* <br /><textarea name="comments" rows="5" cols="30" value="<?php if (isset($_POST['comments'])) echo $_POST['comments']; ?>" /></textarea></p>
				<div class="memory">
					<input type="hidden" name="MAX_FILE_SIZE" value="524288" />
					<p>Share your favourite memory at Granny Joan's Coffee House and it may be featured on our Facebook page!</p>
					<p>Select a JPEG or PNG image of 512KB or smaller to be uploaded:</p>
					<p><strong>File:</strong> <input type="file" name="upload" /></p>
				</div>
				<p>Sign me up to receive monthly newsletter! <br /><input type="checkbox" name="checkbox" value="checked" /></p>
				
				<p><input type="submit" name="submit" value="Send!" /></p>
				<p><em>*Indicates a mandatory field.</em></p>
			</form>
			<?php
				//Check for form submission
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					
					//Check for uploaded file:
					if (isset($_FILES['upload'])) {
						//Validate the type - should be JPEG or PNG
						$allowed = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/PNG', 'image/png', 'image/x-png');
						if (in_array($_FILES['upload']['type'], $allowed)) {
							//move file over from tmp folder
							if (move_uploaded_file($_FILES['upload']['tmp name'], "../uploads/{$_FILES['upload']['name']}")) {
								echo '<p><em>The file has been uplaoded!</em></p>';
							} //End of move...IF
						} else {
							//Invalid type
							echo '<p class="error">Please upload a JPEG or PNG image.</p>';
						}
					} //End of isset $_FILES IF
					
					//Check for an error
					if ($_FILES['upload']['error'] > 0) {
						echo '<p class="error">The file could not be uploaded because: <strong>';
						
						//Print a message based on the error
						switch ($_FILES['upload']['error']) {
							case 1:
								print 'The file exceeds the upload_max_filesize setting in php.ini.';
								break;
							case 2:
								print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form.';
								break;
							case 3:
								print 'The file was only partially uploaded.';
								break;
							case 4: 
								print 'No file was uploaded.';
								break;
							case 6:
								print 'No temporary folder was available.';
								break;
							case 7:
								print 'Unable to write to the disk.';
								break;
							case 8:
								print 'File uploaded stopped.';
								break;
							default:
								print 'A system error occured.';
								break;
						} //End of switch
					
						print '</strong></p>';
					} // END OF ERROR IF
					
					//Minimal form validation
					if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comments']) ){
						
						//Create body
						$body = "Name: {$_POST['name']}\n \nComments: {$_POST['comments']}";
						
						//Set character limit
						$body = wordwrap($body, 500);
						
						//Send the email:
						mail('grannyjoanscoffee@gmail.com', 'Contact Form Submission', $body, "From: {$_POST['email']}");
						
						//Print the message
						echo '<p class="suceess">Thank you for contacting us! One of our staff will be in touch with you soon!</p>';
						
						//Clear $_POST to make form not sticky 
						$_POST = array();	
					} else {
						echo '<p class="error">Please complete all mandatory fields.</p>';
					}	
				} //End of form submission IF	
			?>
		</div><!--/cform-->
	</div><!--/content-->
	
	<div class="row footer">
   		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 contact">                
                <p class="address">635 Dundas St. W <br />Toronto, ON A1B 2C3 <br />PH: 416-123-4567</p>
            </div>
        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 navbottom">
               <ul class="footernav">
               		<li><a href="index.php">Home</a></li>
               		<li><a href="login.php">Login</a></li>
               		<li><a href="coffee.php">Blends</a></li>
               </ul>
		</div><!--/navbottom-->
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 copy pullright">
        	<p>Granny Joan's Coffee House &copy; 2017</p>
		</div><!--/copy-->
	</div><!--footer-->
</div><!--container-->
</body>
</html>