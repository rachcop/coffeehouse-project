<!doctype html>
<html>
<head>
<meta charset="UTF-8">

<title>Blends | Granny Joan's Coffee Pickup</title>
<link href="https://fonts.googleapis.com/css?family=Codystar|Raleway:100" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body class="blends">
<div id="container">
	
<!--Header-->
	<div class="row header">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 breadcrumbs">
			<p><a href="index.php">Home</a>  /  Blends</p>
        
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
               		<li><a href="contact.php">Contact Us</a></li>
               		<li><a href="forum.php">Message Board</a></li>
               </ul>
			</div>
		</div><!--/row connect-->
	</div><!--/row header -->	

<!--Main Content-->
 	<div class="container">
 		<h2 class="cbeans">Coffee Blends</h2>
  		<img src="images/beans.jpg" class="beans" alt="coffee beans" title="Coffee Beans" >
  		<div class="row blendcontent">
  		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 light">
				<h2>Joanie's Light Blend</h2>
				<p>With a light body and snappy finish, you won't underestimate this little guy again!</p>
				<p>Quantity:</p>
				<ul class="quantities">
					<li>100grams @ $11.00 <input type="number" name="100g" size="3" maxlength="3" /></li>
					<li>150grams @ $15.00 <input type="number" name="150g" size="3" maxlength="3" /></li>
					<li>200grams @ $21.50 <input type="number" name="200g" size="3" maxlength="3" /></li>
					<li>300grams @ $31.75 <input type="number" name="300g" size="3" maxlength="3" /></li>
				</ul>
			</div><!--/light-->
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 dark">
				<h2>Granny J's Dark Blend</h2>
				<p>Dark, smooth and rich - we're not talking about the man of your dreams here - try Granny Joan's Signature Dark Roast Blend today!</p>
				<p>Quantity:</p>
				<ul class="quantities">
					<li>100grams @ $10.00 <input type="number" name="100g" size="3" maxlength="3" /></li>
					<li>150grams @ $14.50 <input type="number" name="150g" size="3" maxlength="3" /></li>
					<li>200grams @ $19.50 <input type="number" name="200g" size="3" maxlength="3" /></li>
					<li>300grams @ $28.50 <input type="number" name="300g" size="3" maxlength="3" /></li>
				</ul>
			</div><!--/dark-->
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 espresso">
				<h2>Coffee House Signature Espresso</h2>
				<p>You're a well refined individual who enjoys the finer things in life, so why should you settle for anything less with your espresso. Lucky for you, we're fancy too.</p>
				<p>Quantity:</p>
				<ul class="quantities">
					<li>100grams @ $13.50 <input type="number" name="100g" size="3" maxlength="3" /></li>
					<li>150grams @ $20.00 <input type="number" name="150g" size="3" maxlength="3" /></li>
					<li>200grams @ $25.00 <input type="number" name="200g" size="3" maxlength="3" /></li>
					<li>300grams @ $32.00 <input type="number" name="300g" size="3" maxlength="3" /></li>
				</ul>
			</div><!--/espresso-->
			<p class="checkout"><input type="submit" name="submit" value="Proceed to Checkout" /></p>
		</div><!--content-->

		<div class="row footer">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 contact">                
					<p class="address">635 Dundas St. W <br />Toronto, ON A1B 2C3 <br />PH: 416-123-4567</p>
				</div>
			<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 navbottom">
				   <ul class="footernav">
						<li><a href="index.php">Home</a></li>
						<li><a href="login.php">Login</a></li>
						<li><a href="contact.php">Contact Us</a></li>
				   </ul>
			</div><!--/navbottom-->
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 copy pullright">
				<p>Granny Joan's Coffee House &copy; 2017</p>
			</div><!--/copy-->
		</div><!--/footer-->
	</div><!--/.container-->
</body>
</html>