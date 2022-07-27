<?php 
	session_start(); 
	include "livechat.php";
    require '../config/db.php';
    if(!isset($_SESSION["underwriter"])) { 
      header("refresh:0;url=./index.php");
	}
	$underwriter = trim($_SESSION["underwriter"]);
	$emailsql= "SELECT EMAIL_ADDRESS FROM UnderwriterList where Name  like '%$underwriter'";
	if($res = mysqli_query($connection, $emailsql)){
									
		while($row = mysqli_fetch_array($res)){
			$_SESSION["underweiter_email"] = $row["EMAIL_ADDRESS"];
		}
	}
?>
<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"><![endif]-->
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Get your motor Insurance delivered to your Email or Whatsapp in minutes.">
	<meta name="author" content="Webworks Africa Limited">
	<title>BimaPlus :: Bima Smart Mkononi</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/icon.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/icon.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/icon.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/icon.png">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Satisfy" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!-- BASE CSS -->
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/menu.css" rel="stylesheet">
	<link href="css/icon_fonts/css/all_icons.min.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
	<link href="css/date_time_picker.css" rel="stylesheet">
	<link href="css/timeline.css" rel="stylesheet">

	<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

	<!--[if lte IE 8]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
    <![endif]-->

	<!-- Header================================================== -->
	<div id="header_1" class="layer_slider">
		<header>
			<div id="top_line">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<a href="tel:+254733566464" id="phone_top">+254 733 566 464</a>
						</div>
						<div class="col-md-6 col-sm-6 hidden-xs">
								<ul id="top_links">
								
					<ul>
						<li><a href="#"><i class="icon-facebook"></i></a>
						</li>
						<li><a href="#"><i class="icon-twitter"></i></a>
						</li>
						<li><a href="#"><i class="icon-instagram"></i></a>
						</li>
					</ul>
				
								
							</ul>
						</div>
					</div>
					<!-- End row -->
				</div>
				<!-- End container-->
			</div>
			<!-- End top line-->

			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-3">
						<div id="logo_home">
							<h1><a href="index.php" title="Bima Plus">BimaPlus&amp;Insurance Agency</a></h1>
						</div>
					</div>
					<nav class="col-md-9 col-sm-9 col-xs-9">
						<!--<ul id="tools_top">
							<li><a href="#" class="search-overlay-menu-btn"><i class="icon-search-6"></i></a>
							</li>
						</ul>
						<a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
						<div class="main-menu">
							<div id="header_menu">
								<img src="img/logo_menu.png" width="145" height="34" alt="Bestours" data-retina="true">
							</div>
							<a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
							<ul>
								<li><a href="index.html">Home</a></li>
								
								<li><a href="about.html">About us</a></li>
								<li><a href="services.html">Services</a></li>
								<li><a href="contact.html">Contact us</a></li>
								<li><a href="login.html">Agent Login/Register</a></li>
								
							</ul>
						</div>
						<!-- End main-menu -->
					</nav>
				</div>
			</div>
			<!-- container -->
		</header>
	</div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/mpesa.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Pay Using Your Phone</h1>
				<p>Pay using Mpesa</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->
	<section class="wrapper">
		<div class="divider_border"></div>	
		<div class="container">
			<div class="row">
				<div class="col-md-10">
				

				<div id="myDIV" style="display:none !important;" class="d-flex justify-content-around">
					<!-- <div class="spinner-border text-primary" role="status">
						<span class="sr-only" style="width: 6rem; height: 6rem;">Loading...</span>
					</div>
					<div class="spinner-border text-secondary" role="status">
						<span class="sr-only"  style="width: 6rem; height: 6rem;">Loading...</span>
					</div>
					<div class="spinner-border text-success" role="status">
						<span class="sr-only"  style="width: 6rem; height: 6rem;">Loading...</span>
					</div> -->
					<div id = "countdown" style="color:red;font-size:20px;">
					</div>
					<div class="d-flex justify-content-around">
						kindly wait as we process your request
					</div>
					
					<!-- <div class="spinner-border text-primary" role="status">
						<span class="sr-only" style="width: 6rem; height: 6rem;">Loading...</span>
					</div>
					<div class="spinner-border text-secondary" role="status">
						<span class="sr-only"  style="width: 6rem; height: 6rem;">Loading...</span>
					</div>
					<div class="spinner-border text-success" role="status">
						<span class="sr-only"  style="width: 6rem; height: 6rem;">Loading...</span>
					</div><br> -->
					
				</div>
					<h2>Customer  Details</h2>
					
					<h5>Confirm mobile number for m-pesa payment</h5>
					<form action="transactions/stk.php" method="post" autocomplete="off" >
						<div class="input-container">
							<i class="icon-mobile-6 icon"></i>
							<input class="input-field" id="phone" type="text" name="phone" placeholder=<?php echo $_SESSION["phone_number"]?>>
						</div>
						<h5>Confirm email address receiving insurance certificate</h5>
						<div class="input-container">
							<i class="icon-mobile-6 icon"></i>
							<input class="input-field" id="email" type="text" name="email" placeholder=<?php echo $_SESSION["email"]?>>
						</div>				
						<div class="form-group">
							<input type="submit" value="Make Payment" class="btn_full" onclick="myFunction()">
						</div>
					</form>
				</div>
				<div class="divider_border">
			</div>
		</section>
		<div class="divider_border"></div><br><br>
									
		<!-- End container -->

			<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3">
					<h3>Need help?</h3>
					<a href="tel:+254733566464" id="phone">+254 733 566 464</a>
					<a href="mailto:info@iplus.co.ke" id="email_footer">info@iplus.co.ke</a>
				</div>
				<div class="col-md-2 col-sm-3">
					<h3>Quick Links</h3>
					<ul>
						<li><a href="about.html">About us</a>
						</li>
						<li><a href="faq.html">FAQ</a>
						</li>
						<li><a href="login.html">Login</a>
						</li>
						
					</ul>
				</div>
				
				<div class="col-md-7 col-sm-12">
					<h3>Newsletter</h3>
					<div id="message-newsletter_2">
					</div>
					<form method="post" action="assets/newsletter.php" name="newsletter_2" id="newsletter_2">
						<div class="form-group">
							<input name="email_newsletter_2" id="email_newsletter_2" type="email" value="" placeholder="Your email" class="form-control">
						</div>
						<input type="submit" value="Subscribe" class="btn_1" id="submit-newsletter_2">
					</form>
				</div>
			</div>
			<!-- End row -->
			<hr>
			<div class="row">
				<div class="col-sm-8">
					
					<span id="copy">Copyright © 2020. IPlus Insurance Agency - All rights reserved</span>
				</div>
				<div class="col-sm-4" id="social_footer">
					<ul>
						<li><a href="#"><i class="icon-facebook"></i></a>
						</li>
						<li><a href="#"><i class="icon-twitter"></i></a>
						</li>
						<li><a href="#"><i class="icon-instagram"></i></a>
						</li>
					</ul>
				</div>
			</div>
			<!-- End row -->
		</div>
		<!-- End container -->
	</footer>
	<!-- End footer -->

	<div id="toTop"></div>
	<!-- Back to top button -->

	<!-- Search Menu -->
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_close"></i></span>
		<form role="search" id="searchform" method="get">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon-search-6"></i>
			</button>
		</form>
	</div>
	<!-- End Search Menu -->

	<!-- COMMON SCRIPTS -->
	<script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/common_scripts_min.js"></script>
	<script src="assets/validate.js"></script>
	<script src="js/jquery.tweet.min.js"></script>
	<script src="js/functions.js"></script>

	<!-- SPECIFIC SCRIPTS -->
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#date_pick').datepicker();
	</script>
	<script src="js/sidebar_carousel_detail_page_func.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js"></script>
	<script src="js/map.js"></script>
	<script src="js/infobox.js"></script>
	<script>
	function myFunction() {
		var x = document.getElementById("myDIV");
		if (x.style.display === "block") {
			x.style.display = "none";
		} else {
			x.style.display = "block";
		}
	}
	</script>
	<script>
	function countdown( elementName, minutes, seconds ){
			var element, endTime, hours, mins, msLeft, time;

			function twoDigits( n ){
				return (n <= 1.5 ? "0" + n : n);
			}

			function updateTimer(){
				msLeft = endTime - (+new Date);
				if ( msLeft < 1000 ) {
					element.innerHTML = "Time is up!";
				} else {
					time = new Date( msLeft );
					hours = time.getUTCHours();
					mins = time.getUTCMinutes();
					element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
					setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
				}
			}

			element = document.getElementById( elementName );
			endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
			updateTimer();
		}

		countdown( "countdown", 1.5, 0 );

	</script>


</body>

</html>