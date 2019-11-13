<?php
//start output buffering
ob_start();

//initialize session
session_start();

//check for $page_title value
if (!isset($page_title)) {
	$page_title = 'Welcome! | Granny Joan\'s Coffee House';
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

<body class="index">

<div id="container">
	
<!--Header-->
	<div class="row header">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 connect">
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
                 
        </div><!--/connect-->
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 navs">
			<img src="images/logo.png" class="logocontact" alt="logo" title="Granny Joan's Coffee House logo">
			<h1 class="home1">Granny Joan's Coffee House</h1>
			<div class="homenav">
             		<ul class="headernav1">
              		<li><a href="coffee.php">Blends</a></li>
               		<li><a href="contact.php">Get in Touch</a></li>
               		<li><a href="forum.php">Message Board</a></li>
               </ul>
			</div>
		</div><!--navs-->
	</div><!--row header -->	
    <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 navbar">
           
    </div><!-- row navbar -->
<!--Main Content-->
  	<div class="row content">
   		<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 main">
   			<div class="main1">
				<div class="animated jello"><h3 class="pickup">PSST...</h3></div>
				<h4>We've got some <div class="pickup">BIG</div> news!</h4>
					<p>We're so excited to announce the grand opening our second location, Granny Joan's Coffee House Pickup!</p>
					<p>Coming visit our friendly staff in Toronto's trendy Roncesvalles. Granny Joan's Coffee House Pickup is sure to be your new favourite spot to get your daily coffee fix.</p>
					<p>Visit our <a href="contact.php" class="links" title="Contact Us page">Contact</a> page for more information on address and hours!</p>
   					<p>&nbsp;</p>
    			</div><!--main1-->
    			<div class="main2">
    			<img src="images/mug-icon.png">
    				<h4>Our Story</h4>
    				<p>From humble beginnings, Granny Joan's Coffee House has been delighting customers in the downtown Toronto area for over 15 years. Starting as a family operated cafe in 2002, Joan's Coffee, the business has grown over time to be one of the most popular coffee stops in the Bloor West area.</p>
    				<p>With a strong focus on providing customers with an exceptional experience time and time again, Granny Joan's Coffee House is like the television show <em>Cheers</em>, a place where everybody knows your name. And the coffee is second to none.</p>
    				<p>Granny Joan's Coffee is rich, aromatic, bold and flavourful. With seasonal blends and creative new ideas, the staff at Granny Joan's look forward to serving you your next cup!</p>
    				<p>Now you can enjoy Granny Joan's Coffee House blends from home! Buy your favourite <a href="coffee.php">blends online</a> and have them shipped to you! Isn't the Internet awesome?</p>
    				<p>&nbsp;</p>
    			</div>
		</div><!--/main-->
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 aside">
			<h4 class="whyh">Why You Should Drink More Coffee</h4>
			<img src="images/coffee-icon-darko.png" class="why" alt="coffee icon" tite="coffee icon">
			<p>It's probably obvious - we're all about coffee, and are especially biased towards our homebrews. It's not just because of the rich aroma, delicious flavour and (let's face it, most importantly) caffeinated goodness, but we'll bet you didn't know that coffee actually has a ton of other benefits too! </p>
			<ul>
				<li>Coffee helps burn fat. Need we say more?</li>
				<li>Coffee contains important nutrients that the human body requires. In other words - you need coffee to survive!</li>
				<li>...on that note, coffee can also help you live longer! It contains a lot of antioxidants that help fight chemicals called, "free radicals" (not the cool kind). Coffee drinkers are at a lower risk of diseases like Parkinson's Disease, type II diabetes, and heart disease.</li>
				<li>Still not convinced? Why not stop by one of our locations in Toronto and try a cup of Granny Joan's delicious <a href="coffee.php" class="blends">blends</a>!</li>
			</ul>
			<img src="images/meme-superhero.png" class="superhero" alt="superman meme" title="Superman Meme">
			<cite>The above facts are from The Chive: <a href="http://thechive.com/2014/05/05/interesting-facts-about-coffee-just-in-time-for-another-workweek-17-photos/" class="links">"Interesting facts about coffee just in time for another workweek"</a> written by <a href="http://thechive.com/author/bphillipp/" class="links">Bob Phillip</a></cite>
		</div><!--/aside-->
	</div><!--content-->
	
  <!--Audio-->
   	<div class="row audio">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"> <audio controls loop autoplay>
        	<source src="coffeehouse-music.mp3" type="audio/mpeg">Your browser does not support the audio element. </audio>
        </div><!--cols-->
    </div><!--audio-->
    <div class="row footer">
   		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 contact">                
                <p class="address">635 Dundas St. W <br />Toronto, ON A1B 2C3 <br />PH: 416-123-4567</p>
            </div>
        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 navbottom">
               <ul class="footernav">
              		<li><a href="login.php">Login</a></li>
               		<li><a href="coffee.php">Blends</a></li>
           			<li><a href="contact.php">Contact Us</a></li>
               </ul>
		</div><!--/navbottom-->
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 copy pullright">
        	<p>Granny Joan's Coffee House &copy; 2017</p>
		</div><!--/copy-->
	</div><!--footer-->
</div><!--#container-->
</body>
</html>
