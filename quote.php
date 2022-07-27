<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
	include_once"dashboard/session.php";
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
							<h1><a href="index.php" title="JendiePlus">JendiePlus&amp;Insurance Technology</a></h1>
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
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/get_quote_page.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1 style="color:red;">Get Quote</h1>
				<h1><? //echo $underwriter?></h1>
				<h5 style="color:white;"><?//echo $_SESSION["description"]?></h5>
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
						<form action="quotes.php" method="get">
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
										<input type="email" class="form-control styled" id="email" name="email" placeholder="Your Email" required onchange = "validateEmail()">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Phone Number:</label>
										<input type="text" id="_phone_contact" name="phone_number" class="form-control styled" placeholder="Phone Number" required>
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
									<?//print_r($_SESSION)?>
									<label>Choose Vehicle Class:</label>
									<select id="vehicle_class" name="vehicleclass" class="form-control styled" placeholder="Vehicle Class" onchange="myFunction()" required>
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
										<input type="text" class="form-control styled" id="reg_number" name="vehicle_reg" placeholder="Vehicle Registrattion Number" required onchange="validate_registration()">
									</div>
								</div>

								<div class="col-md-6 col-sm-6">
									<div class="form-group">
									<label>Choose Cover Limit:</label>

										<select id="cover_limit" class="form-control form-control-sm"  onchange="myFunction()" name="cover">
											<?php
												$select = $pdo->prepare('SELECT cover from tbl_coverage where cover = "Third Party Only" or cover = "Comprehensive"');
												$select->execute();
												while($row = $select->fetch(PDO::FETCH_ASSOC)){
													extract($row);
													?>
														<option value="<?php echo $row["cover"];?>"><?php echo $row["cover"];?></option> 
													<?php 
														}
													?>																						
										</select>
									</div>
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group" id="suminsured">
									</div>
								</div>
							
								<div class="col-md-6 col-sm-6">
									<div class="form-group" id="manyear">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group" id="referalcode">
									<label>Have a refferal Code?:</label>
										<input type="text" class="form-control styled" id="referal_code" name="refferal_code" placeholder="Enter refafal code" required onchange="validate_referal()">
									</div>
								</div>
								
								<div class="col-md-6 col-sm-6">
									<div class="form-group" id="matatu">
									<label>Choose Cover Period</label>
									<select name="coverperiod" class="form-control form-control-lg">
										<option>1 month</option>
										<option>1 year</option>
									</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group" id="passangers">
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group" id="tonnage">
									</div>
								</div>
							</div>
							<div class="row">
								

								<div class="col-md-6 col-sm-6">
									<div class="form-group" id="coverperiod">
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group" id="vehiclemake">
									</div>
								</div>
							</div>
							<div class="row">
								
											
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<label>Confirm Submission:</label>
										<input type="Submit" class="form-control styled btn-danger"/>
									</div>
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
					<a href="tel:+254723775289" id="phone">+254 723 775 289</a>
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
					
					<span id="copy">Copyright © 2022. JendiePlus Technologies - All rights reserved</span>
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
			var x = document.getElementById("cover_limit");
			var i = x.selectedIndex;
			console.log("ttt" + i);
			if (i == 1) {
				console.log(i)
				document.getElementById("suminsured").innerHTML ='\
				<label>Enter Amount Insured</label>\
				<input type="number" id="_phone_contact" name="suminsured" class="form-control styled" placeholder="Sum Insured" required>';
				document.getElementById("manyear").innerHTML = '\
				<label>Select Manufacture Year</label>\
				<select name="yom" class="form-control form-control-lg"> <<?php for ($i = date('Y'); $i >= 1900; $i--){echo "<option>$i</option>"; }?></select><br>'
				document.getElementById("vehiclemake").innerHTML = '\
				<label>Enter Vehicle Make</label>\
				<input type="text" name="vehicleMake" placeholder="Enter Vehicle Make" class="form-control form-control-lg" id="quotemake" required/>';
				//document.getElementById("coverperiod").innerHTML = '\
				
			}
			
			if (i == 0) {
				document.getElementById("suminsured").innerHTML = '';
				document.getElementById("manyear").innerHTML = '';
				document.getElementById("vehiclemake").innerHTML = '';
				//document.getElementById("coverperiod").innerHTML = '';                            
			}

			if (i == 0 || i == 2){
				document.getElementById("tonnage").innerHTML = '';
			}
			var z = document.getElementById("vehicle_class");
			var y = z.selectedIndex;
			
			console.log(y,i);
			if ((y == 16 || y == 14) &&(i == 0)){
				document.getElementById("matatu").innerHTML ='\
				<label>Choose Cover Period</label>\
				<select name="coverperiod" id="coverperiod" class="form-control form-control-lg">\
					<option>1 week</option>\
					<option>2 weeks</option>\
					<option>1 month</option>\
					<option>1 year</option>\
				</select>';
				document.getElementById("passangers").innerHTML ='\
					<label>Enter Seating Capacity</label>\
					<input class="form-control form-control-lg" name="passangers" type="number" placeholder="Sitting Capacity" required><br>';
			}else{
				document.getElementById("passangers").innerHTML ="";
				document.getElementById("matatu").innerHTML ='\
				<label>Choose Cover Period</label>\
				<select name="coverperiod" id="coverperiod" class="form-control form-control-lg">\
					<option>1 month</option>\
					<option>1 year</option>\
				</select>';
			}
			if ((y == 6 || y == 7)&&(i == 0)) {
					document.getElementById("tonnage").innerHTML ='\
					<label>Enter Tonnage</label>\
					<input class="form-control form-control-lg" name="tonnage" type="number" placeholder="Tonnage" required><br>';
			}else{
				document.getElementById("tonnage").innerHTML =" ";
			}
			

		}
		function validate_referal(){
			const referal_code = document.getElementById("referal_code");
			console.log(referal_code.value);
			var ira_patt = /[0-9]{5}[-][0-9]{2}|[0-9]{6}[-][0-9]{2}|[0-9]{5}|[0-9]{6}$/g;
			var result = referal_code.value.match(ira_patt);
			if(result){
				referal_code.value = result;
				console.log(result);
			}else{
				referal_code.value = "";
				referal_code.placeholder='Invalid Referal code: Use this format: 00000/000000 or 00000-00/000000-00';
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
		// function validate_phone_number(){
		// 	const phone = document.getElementByid("phone");
		// 	var phone_pattern = ^(?:254|\+254|0)?(7(?:(?:[129][0–9])|(/?:0[0–8])|(4[0–1]))[0–9]{6}/g;
		// 	var result = reg_number.value.match(ira_patt);
		// 	if(result){
		// 		reg_number.value = result;
		// 		console.log(result);
		// 	}else{
		// 		reg_number.value = "";
		// 		reg_number.placeholder='Invalid Registration Use this format: KAA 000A/KAA 000';
		// }
	</script>
</body>

</html>