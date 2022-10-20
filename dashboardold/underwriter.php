<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if (isset($_GET["underwriter"])){
		$_SESSION["underwriter"] = $_GET;
	}	
	if(!isset($_SESSION["underwriter"])) { 
   
        header("refresh:0;url=./index.php");
    }else{
		$underwriter = $_SESSION["underwriter"]["underwriter"];
		$description = $_SESSION["underwriter"]["description"];
		include "session.php";;
		if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			$_SESSION["agent"] = "True";
		}else{
			$_SESSION["agent"] = "False";
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
	<meta name="author" content="JendiePlus Technologies">
	<title>JendiePlus :: Smart INSURANCE Mkononi</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/icon.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/icon.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/icon.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/icon.png">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Satisfy" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="css/animate.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/menu.css" rel="stylesheet">
	<link href="css/icon_fonts/css/all_icons.min.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">

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
							<a href="tel:+254723775289" id="phone_top">+254 723 775 289</a>
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
							<h1><a href="index.php" title="JendiePlus">JendiePlus&amp;Insurance Technologies</a></h1>
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
								<li><a href="index.php">Home</a></li>
								
								<li><a href="about.html">About us</a></li>
								<li><a href="services.html">Services</a></li>
								<li><a href="contact.html">Contact us</a></li>
								<li><a href="../../bimaplus/login.php">Agent Login/Register</a></li>
								
							</ul>
						</div>
						<!-- End main-menu -->
					</nav>
				</div>
			</div>
			<!-- container -->
		</header>
		<!-- End Header -->
	</div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/underwriter_page.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1><?php echo $underwriter?></h1>
				<h5 style="color:white;"><?php echo $description?></h5>
				
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">

			<div class="row">
				<div class="col-md-9">
					<div class="bloglist">
							<div class="row wow fadeIn">
								<div class="col-sm-4">
									<a><img alt="" class="img-responsive img-thumbnail" src="img/third_party.jpg">
									</a>								
								</div>
								<div class="col-sm-8">
									<h4><a href="javascript:;">Third-Party Cover</a></h4>
									<ul class="list-inline">
										<li><a href="#"><i class="icon_folder-alt"></i> (14) Covers Issued</a>
										</li>
										<li><a href="#"><i  class="icon-share"></i> Share Cover</a>
										</li>
										
									</ul>
									<p>Descriptions of the Cover.</p>
										<a href="get_quote.php?cover=Third Party Only" id ='get_quote' class="btn_1">Get Quote</a>
									</p>
								</div>
							</div>
						
						<!-- end row -->

						<hr>
					
						<div class="row wow fadeIn">
							<div class="col-sm-4">
								<a><img alt="" class="img-responsive img-thumbnail" src="img/comprehensive.jpg">
								</a>
							</div>
							<div class="col-sm-8">
								<h4><a href="javascript:;">Comprehensive Cover</a></h4>
								<ul class="list-inline">
									<li><a href="#"><i class="icon_folder-alt"></i> (25) Covers Issued</a>
									</li>
									<li><a href="#"><i  class="icon-share"></i> Share Cover</a>
									</li>
									
								</ul>
								<p>Descriptions of the Cover. </p>
								<a href="get_quote_comprehensive.php?cover=Comprehensive" id ="getquote" class="btn_1">Get Quote</a>
							</div>
						</div>
						
						<!-- end row -->

					</div>
					<!-- end store-list -->
				</div>
				<!-- end col -->

				<aside id="sidebar" class="col-md-3">
					<div class="widget">
						<form>
							<div class="form-group">
								<input type="text" name="search" id="search" class="form-control" placeholder="Search...">
							</div>
							<button type="submit" id="submit" class="btn_1"> Search Insurance Company</button>
						</form>
					</div>
					<!-- end widget -->

					
					<div class="widget">
						<div class="widget-title">
							<h4>Popular Tags</h4>
						</div>
						<!-- end widget-title -->

						<div class="tags">
							<a href="#">Third-Party</a>
							<a href="#">Fire Protection</a>
							<a href="#">Comprehensive</a>
							
						</div>
						<!-- end tags -->
					</div>
					<!-- end widget -->
				</aside>
				<!-- end col -->
			</div>
			<!-- end row -->

			<nav class="pagination-wrapper">
				<ul class="pagination">
					<li><a href="#">1</a>
					</li>
					
					<li>
						<a href="#" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				</ul>
			</nav>
			<!-- End pagination -->

		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3">
					<h3>Need help?</h3>
					<a href="tel:+254723775289" id="phone">+254 723 775 289</a>
					<a href="mailto:info@jendieplus.co.ke" id="email_footer">info@jendieplus.co.ke</a>
				</div>
				<div class="col-md-2 col-sm-3">
					<h3>Quick Links</h3>
					<ul>
						<li><a href="#">About us</a>
						</li>
						<li><a href="#">FAQ</a>
						</li>
						<li><a href="../../bimaplus/login.php">Login</a>
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
					
					<span id="copy">Copyright © 2022.JendiePlus Technoogies - All rights reserved</span>
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
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>

</body>

</html>