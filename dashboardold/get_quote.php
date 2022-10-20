<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
		#print_r($_SESSION);
	}
	if (isset($_SESSION['cover'])){
		unset($_SESSION['cover']);
	}
	if (isset($_GET["cover"])){
		$_SESSION["cover"] = $_GET;
	}	
	if(!isset($_SESSION["underwriter"])) { 
	
		header("refresh:0;url=./index.php");
	}else{
		include "session.php";
		$underwriter = $_SESSION["underwriter"]["underwriter"];
		$description = $_SESSION["underwriter"]["description"];
		if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
			$_SESSION["agent"] = "True";
			
		}else{
			$_SESSION["agent"] = "False";
		}
		if(isset($_SESSION["product"])){
			unset ($_SESSION['product']);
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
					<!-- <nav class="col-md-9 col-sm-9 col-xs-9">
						<ul id="tools_top">
							<li><a href="#" class="search-overlay-menu-btn"><i class="icon-search-6"></i></a>
							</li>
						</ul>
						<a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
						<div class="main-menu">
							<div id="header_menu">
								<img src="img/logo_menu.png" alt="BimaPlus" data-retina="true">
							</div>
							<a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
							<ul>
								<li><a href="index.php">Home</a></li>
								
								<li><a href="about.html">About us</a></li>
								<li><a href="services.html">Services</a></li>
								<li><a href="contact.html">Contact us</a></li>
								<li><a href="login.html">Agent Login/Register</a></li>
								
							</ul>
						</div>
					</nav> -->
				</div>
			</div>
			<!-- container -->
		</header>
		<!-- End Header -->
	</div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/get_quote_page.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1 style="color:red;">Get Quote</h1>
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
				<div class="col-md-12">
					<h3>Get Quote</h3>
					
					<div>
						<div id="message-contact"></div>
						<form action="detail-page.php" method="get">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Your name</label>
										<input type="text" class="form-control styled" id="name_contact" name="name_contact" placeholder="Full Name" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control styled" id="email" name="email" placeholder="Your Email" onchange="validateEmail()" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Phone Number:</label>
										<input type="text" id="phone_number" name="phone_number" class="form-control styled" placeholder="Phone Number" required>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
									<label>Choose Vehicle Class:</label>
									<select id="mySelect1" name="vehicleclass" class="form-control styled" placeholder="Vehicle Class" onchange="myFunction()" required>
										<?php 	
											$select = $pdo->prepare("SELECT * FROM tbl_vehicleclass");
											$select->execute();
											while($row = $select->fetch(PDO::FETCH_ASSOC)){
												extract($row);
												?>
													<option value="<?php echo $row["type"] . ' ' . $row["class"];?>"><?php echo $row["type"] . ": " . $row["class"];?></option> 
												<?php 
													}
												?>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
									
										<label>Vehicle Registration Number:</label>
										<input type="text" class="form-control styled" id="reg_number" name="vehicle_reg" placeholder="Vehicle Registrattion Number" onchange="validate_registration()" required>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Choose Cover Period:</label>
											<div id="coveroptional">
												<select name="coverperiod" id="coverperiod" class="form-control py-1">
													<option>1 year</option>
													<option>1 month</option>
												</select>
											</div>
										</div>
									</div>
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<div id="passangers">
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<div id="tonnage">
									</div>
								</div>
							</div>	
							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<label class="styled text-center">Have a referal code?:</label>
									<input type="text" class="form-control styled text-center" name="referal_code" id="referal_code" placeholder="Enter refaral code" onchange="validate_referal()">
								</div>
							</div>
							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<label>Confirm Submission:</label>
									<input type="Submit" class="form-control styled btn-danger"/>
								</div>
							</div>			
						</form>
					</div>
				</div>
				<!-- End col lg 9 -->
			</div>
			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->
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
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="js/mapmarker.jquery.js"></script>
	<script type="text/javascript" src="js/mapmarker_func.jquery.js"></script>
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script>

	function myFunction() {
		var x = document.getElementById("mySelect1");
		var text=x.options[x.selectedIndex].text;
		console.log(text);
		if ((text == "MOTORVEHICLE: commercial Own goods")||(text == "MOTORVEHICLE: General Cartage Lorries,Trucks and Tankers")) {
			document.getElementById("tonnage").innerHTML ='\
			<label>Enter Tonnage</label>\
			<input type="text" class="form-control styled text-center" id="tonnage" name="tonnage" placeholder="Tonnage" required>';
			document.getElementById("passangers").innerHTML = "";
		}else{
				document.getElementById("tonnage").innerHTML ="";
		}
		if ((text == "MOTORVEHICLE: PSV - Matatu") || (text == "MOTORVEHICLE: PSV - BUS") || (text == "MOTORVEHICLE: commercial Own goods") || (text == " MOTORVEHICLE: General Cartage Lorries,Trucks and Tankers")){
			if ((text == "MOTORVEHICLE: commercial Own goods") || (text == "MOTORVEHICLE: General Cartage Lorries,Trucks and Tankers")){
				document.getElementById("coveroptional").innerHTML ='<select name="coverperiod" id="coverperiod" class="form-control py-1">\
				<option>1 month</option>\
				<option>1 year</option>\
			</select>';
			}else{
			document.getElementById("passangers").innerHTML ='<label class="text-center">Seating Capacity:</label>\
			<input type="number" class="form-control styled text-center" name="passangers" placeholder="Enter seating capacity" required>';
			document.getElementById("coveroptional").innerHTML ='<select name="coverperiod" id="coverperiod" class="form-control py-1">\
				<option>1 week</option>\
				<option>2 weeks</option>\
				<option>1 month</option>\
				<option>1 year</option>\
			</select>';
			}
			
		}else{
			document.getElementById("passangers").innerHTML ="";
			document.getElementById("coveroptional").innerHTML ='<select name="coverperiod" id="coverperiod" class="form-control py-1">\
				<option>1 month</option>\
				<option>1 year</option>\
			</select>';
		}
		// Get the value of the input field with id="numb"
		

	}
	function validate_referal(){
		const referal_code = document.getElementById("referal_code");
		console.log(referal_code.value);
		var ira_patt = /[0-9]{5,6}[-][0-9]+[-][0-9]+|[A-Z]{3}[/][0-9]{2}[/][0-9]{5}[/][0-9]{4}|[0-9]{5,6}[-][0-9]+|[0-9]{5,6}/im;
		var result = referal_code.value.match(ira_patt);
		if(result){
			referal_code.value = result;
			console.log(result);
		}else{
			referal_code.value = "";
			referal_code.placeholder='Invalid Referal code: Use this format: 00000 or 00000-00';
		}
	}
	function validateEmail(){
		const email = document.getElementById("email");
		console.log(email.value);
		var ira_patt = /[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/g;
		var result = email.value.match(ira_patt);
		if(result){
			email.value = result;
			console.log(result);
		}else{
			email.value = "";
			email.placeholder='Invalid email Use this format: donjoe@email.com';
		}
	}
	function validate_registration(){
		const reg_number = document.getElementById("reg_number");
		console.log(reg_number.value);
		var ira_patt = /[A-Za-z]{3}[0-9]{3}[A-Za-z]{1}|[A-Za-z]{3}[0-9]{3}|[A-Za-z]{3} [0-9]{3}[A-Za-z]{1}|[A-Za-z]{3} [0-9]{3}/g;
		var result = reg_number.value.match(ira_patt);
		if(result){
			reg_number.value = result;
			console.log(result);
		}else{
			reg_number.value = "";
			reg_number.placeholder='Invalid Registration Use this format: KAA 000A/KAA 000';
		}
	}

	</script>

</body>

</html>