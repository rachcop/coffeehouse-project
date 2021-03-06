<?php
	//Indicate encoding:
	header('Content-Type: text/html; 
	charset=UTF-8');
	
	//Start the session
	session_start();
	
	//Testing
	$_SESSION['user_id'] = 1;
	$_SESSION['user_tz'] = 'America/Toronto';
	//for logging out
	//$_SESSION = array();
	
	//Need database connection:
	require ('../mysqli_connect.php');
	
	//Check the new language id and store the language id in session:
	if (isset ($_GET['lid']) && filter_var($_GET['lid'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
	$_SESSION['lid'];
	} elseif (!isset($_SESSION['lid'])) {
		$_SESSION['lid'] = 1; //default
	} 
	
	//retrieve words for this language
	$q = "SELECT * FROM words WHERE lang_id = {$_SESSION['lid']}";
	$r = mysqli_query($dbc, $q);
	if (mysqli_num_rows($r) == 0) { //invalid language id
		//use default language
		$_SESSION['lid'] = 1; // default
		$q = "SELECT * FROM words WHERE lang_id = {SESSION['lid']}";
		$r = mysqli_query($dbc, $q);
		
	}
	
	//fetch the results into a variable 
	$words = mysqli_fetch_array($r, MYSQLI_ASSOC);
	
	//free the results
	mysqli_free_result($r);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title><?php echo $words['title']; ?></title>
<link href="https://fonts.googleapis.com/css?family=Codystar|Raleway:100" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body>

	<div class="row header">
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
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 navs">
			<img src="images/logo.png" class="logocontact" alt="logo" title="Granny Joan's Coffee House logo">
			<h1 class="home1">Granny Joan's Coffee House</h1>
			<div class="homenav">
             		<ul class="headernav1">
              		<li><a href="coffee.php">Blends</a></li>
               		<li><a href="contact.php">Get in Touch</a></li>
               </ul>
			</div>
		</div><!--navs-->
	</div><!--row header -->
<?php
//display the links
echo '<a href="index.php" class="navlink">' . $words['home'] . '</a><br />
<a href="coffee.php" class="navlink">' . $words['blends'] . '</a><br />
<a href="contact.php" class="navlink">' . $words['contact'] . '</a><br />
<a href="msgboard.php" class="navlink">' . $words['msgboard_home'] . '</a><br />';

//display links based on login status
if (isset($_SESSION['user_id'])) {
	//if this is the message board page, add a link for posting new threads
	if (basename($_SERVER['PHP_SELF']) == 'msgboard.php') {
		echo '<a href="post.php" class="navlink">' . $words['new_thread'] . '</a><br />';
	} 
		
	//add the logout link
	echo '<a href="logout.php" class="navlink">' . $words['logout'] . '</a><br />';
} else {
	//register and login links
	echo '<a href="register.php" class="navlink">' . $words['register'] . '</a><br />';
}
	
//chosing message board language
echo '</b><p><form action="msgboard.php" method="get">
<select name="lid">
<option value="0">' . $words['language'] . '</option>
';

//retrieve all languages
$q = "SELECT lang_id, lang FROM languages ORDER BY lang_eng ASC";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) > 0) {
	while ($menu_row = mysqli_fetch_array($r, MYSQLI_NUM)) {
	echo "<option value=\"$menu_row[0]\">$menu_row[1]</option>\n";
	}
}

mysqli_free_results($r);

echo '</select><br />
<input name="submit" type="submit" value="' . $words['submit'] . '" />
</form></p>
?>
</body>
</html>
