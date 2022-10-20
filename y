
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'dashboard/livechat.php';
if(!isset($_SESSION["underwriter"])) { 		
    header("refresh:0;url=./index.php");
}
if (!empty($_POST)){
    $_SESSION["logbook"] = $_POST;
    $_SESSION["files"] = $_FILES['clientFiles'];
}
$id_number = trim($_POST["id_number"]);
$docs = array();
$logbooks = "dashboard/client_files/logbooks/$id_number/";
if (!file_exists($logbooks)) {
    mkdir($logbooks, 0755, true);
}
if ( null !==  $_FILES['clientFiles']){
    foreach($_FILES['clientFiles']['tmp_name'] as $key=>$tmp_name){
        $file_name = $key.$_FILES['clientFiles']['name'][$key];
        $file_tmp =$_FILES['clientFiles']['tmp_name'][$key];
        
        
        if ($key == 0){
            
            $file_name = "idnumber-" . bin2hex(random_bytes(4)) . "-" . $file_name;
            
        }elseif($key == 1){
            $id_file = $file_name;
            $file_name = "kra-". bin2hex(random_bytes(4)) . "-" . $file_name;
            
        }else{
            $kra_file = $file_name;
            $file_name = "logbook-" . bin2hex(random_bytes(4)) . "-" . $file_name;
        }
        $path = $logbooks . $file_name;
        if(move_uploaded_file($file_tmp, $path)){
            array_push($docs, $path);    
        }
        
    }
}?>
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
							<h1><a href="index.html" title="JendiePlus">JendiePlus&amp;Insurance Technology</a></h1>
						</div>
					</div>
					<nav class="col-md-9 col-sm-9 col-xs-9">
						<ul id="tools_top">
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
		<!-- End Header -->
	</div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/description_banner.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Automobile Details</h1>
				<p>Enter Your Vehicle/Motorcycle details below:</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

	<div class="logbook">
		<div class="container">
			
			<div class="row-logbook">
				<div class="col-md-6">
							<div class="row">
								<div class="col-md-10">
									
									<form method="post" action="gateway.php" autocomplete="off">
						
										<div class="center">
											<h3>Particulars</h3></div>
							<div class="form-group">
								<label>Registration</label>
								<input type="text" class="form-control" name="registration" value="<?php echo $_POST['registration']?>" >
							</div>
							<div class="form-group">
								<label>Chasis/Frame</label>
								<input type="text" class="form-control" name="chasis" value="<?php echo $_POST['chasis']?>" >
							</div>
							<div class="form-group">
								<label>Make</label>
								<input type="text" class="form-control" name="make" value="<?php echo $_POST['make']?>" >
							</div>
							<div class="form-group">
								<label>Model</label>
								<input type="text" class="form-control" name="model" value="<?php echo $_POST['model']?>" >
							</div>
							<div class="form-group">
								<label>Type</label>
								<input type="text" class="form-control" name="type" value="<?php echo $_POST['type']?>" >
							</div>
							<div class="form-group">
								<label>Body</label>
								<input type="text" class="form-control" name="body" value="<?php echo $_POST['body']?>" >
							</div>
							<div class="form-group">
								<label>Fuel</label>
								<input type="text" class="form-control" name="fuel" value="<?php echo $_POST['fuel']?>" >
							</div>
							<div class="form-group">
								<label>Man Year</label>
								<input type="text" class="form-control" name="man_year" value="<?php echo $_POST['man_year']?>" >
							</div>
							<div class="form-group">
								<label>Rating</label>
								<input type="text" class="form-control" name="rating" value="<?php echo $_POST['rating']?>" >
							</div>
							<div class="form-group">
								<label>Engine Number</label>
								<input type="text" class="form-control" name="engine_number" value="<?php echo $_POST['engine_number']?>" >
							</div>
							<div class="form-group">
								<label>Color</label>
								<input type="text" class="form-control" name="color" value="<?php echo $_POST['color']?>" >
							</div>
										<div class="form-group">
								<label>Registration Date</label>
								<input type="text" class="form-control" name="reg_date" value="<?php echo $_POST['reg_date']?>" >
							</div>
							<div class="form-group">
								<label>Gross Weight</label>
								<input type="text" class="form-control" name="gross_weight" value="<?php echo $_POST['gross_weight']?>" >
							</div>
							<div class="form-group">
								<label>Duty</label>
								<input type="text" class="form-control" name="duty" value="<?php echo $_POST['duty']?>" >
							</div>
							<div class="form-group">
								<label>Number Of Previous Owners</label>
								<input type="text" class="form-control" name="previous_owners" value="<?php echo $_POST['previous_owners']?>" >
							</div>
								</div>
								<!-- End col -->

								
								<!-- End col -->
							</div>
							<!-- End row -->

							<hr>

							
					
				</div>
				<!-- End Col -->
                
				<aside class="col-md-6">
			
						
							<div class="center">
											<h3>Particulars</h3></div>
							<div class="form-group">
								<label>Passengers</label>
								<input type="text" class="form-control" name="passengers" value="<?php echo $_POST['passengers']?>" >
							</div>
							<div class="form-group">
								<label>Tare Weight</label>
								<input type="text" class="form-control" name="tare_weight" value="<?php echo $_POST['tare_weight']?>" >
							</div>
							<div class="form-group">
								<label>Tax Class</label>
								<input type="text" class="form-control" name="tax_class" value="<?php echo $_POST['tax_class']?>" >
							</div>
							<div class="form-group">
								<label>Axels</label>
								<input type="text" class="form-control" name="axels" value="<?php echo $_POST['axels']?>" >
							</div>
							<div class="form-group">
								<label>Load Capaticity(KG)</label>
								<input type="text" class="form-control" name="load_capacity" value="<?php echo $_POST['load_capacity']?>" >
							</div>
							<div class="form-group">
								<label>Previous Registration Country</label>
								<input type="text" class="form-control" name="reg_country" value="<?php echo $_POST['reg_country']?>" >
							</div>
							<div class="form-group">
								<label>Previous Registration</label>
								<input type="text" class="form-control" name="previous_reg" value="<?php echo $_POST['previous_reg']?>" >
							</div>
						<div class="form-group">
						<label>Date of Policy</label>
							<input type="text" class="form-control" name="date" value="<?php echo $_POST['date']?>" >

						</div>
						<div class="form-group">
						<label>ID Number</label>
							<input type="text" class="form-control" name="id_number" value="<?php echo $_POST['id_number']?>" >

						</div>
						<div class="form-group">
						<label>ID File </label>
							<input type="text" class="form-control" name="id" value="<?php echo $_SESSION["files"]["name"][0]?>" readonly>

						</div>
						<div class="form-group">
						<label>KRA Pin Number</label>
							<input type="text" class="form-control" name="kra_number" value="<?php echo $_POST['kra_number']?>" >

						</div>
						<div class="form-group">
						<label>KRA File </label>
							<input type="text" class="form-control" name="kra" value="<?php echo $_SESSION["files"]["name"][1]?>" readonly>

						</div>
						<div class="form-group">
						<label>Logbook File </label>
							<input type="text" class="form-control" name="logbook" value="<?php echo $_SESSION["files"]["name"][2]?>" readonly>

						</div>
				</aside>
                        <input type="submit" value="Confirm" class="btn_full">
							</div>
			</div>
			<!-- End row -->
					</div>
				<!-- End Logbook-->
		</div>
		<!-- End container -->
			<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3">
					<h3>Need help?</h3>
					<a href="tel:+254723775289" id="phone">+254 723775289</a>
					<a href="mailto:info@jendieplus.co.ke" id="email_footer">info@jendieplus.co.ke</a>
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
					
					<span id="copy">Copyright © 2022. JendiePlus Technologies- All rights reserved</span>
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
			
</body>

</html>