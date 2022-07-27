<?php 
	session_start();
	include 'livechat.php';
	require_once"config/db.php";
foreach ($_POST as $key => $value) {
	if ($value == "1 week") {
		$value = "weeklyrates";
	}elseif ($value == "2 weeks"){
		$value = "fortnightrates";
	}elseif ($value == "1 month"){
		$value= "monthlyrates";
	}elseif ($value == "1 year"){
		$value = "annualrates";
	}
	$_SESSION[$key] = $value;
	// echo $key . ": " . $value . "<br>";
}
// Africa Merchant Assurance Company LimitedThird Party Only PSV - BUS00000

print_r($_SESSION);	
print_r($_POST);
$product_code = 
$product_code = $_SESSION["code"];
$sql = "SELECT * FROM tbl_product where owner = $product_code";
$result = mysqli_query($connection, $sql);
// echo $product_code;

if(isset($_POST['tonnage'])){
	$tonnage = $_POST['tonnage'];
	$sql = "SELECT * FROM `tbl_product` WHERE maxtonnage < $tonnage and not maxtonnage = '' and underwriter = '$underwriter' and coverage = '$coverage' and owner = '$referal_code' ORDER BY maxtonnage ASC limit 1";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_array($result);
	$rowcount=mysqli_num_rows($result);
	echo $rowcount;
	if($rowcount >=1){
		$_SESSION["product"] = $row;
		$_SESSION["basicpremium"] = $row[$_SESSION["coverperiod"]];
	}else{
		echo "No";
		echo "<script> alert('no product for that referal code')</script>";
		sleep(2);
		header("Location: get_quote.php");
	}
}elseif(isset($_POST["passangers"])){
	$passangers = $_POST['passangers'];
	$sql = "SELECT * FROM `tbl_product` WHERE passangers = '$passangers' and underwriter = '$underwriter' and coverage = '$coverage' and owner = '$referal_code'";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_array($result);
	print_r($row);
	$rowcount=mysqli_num_rows($result);
	echo $rowcount;
	if($rowcount >=1){
		$_SESSION["product"] = $row;
		$_SESSION["basicpremium"] = $row[$_SESSION["coverperiod"]];
	}else{
		echo "No";
		echo "<script> alert('no product for that referal code')</script>";
		sleep(2);
		header("Location: get_quote.php");
	}
}else{
	$sql = "SELECT * FROM `tbl_product` WHERE underwriter = '$underwriter' and coverage = '$coverage' and owner = '$referal_code'";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_array($result);
	$_SESSION["product"] = $row;
	$_SESSION["basicpremium"] = $row[$_SESSION["coverperiod"]];
	print_r($row);
	$rowcount=mysqli_num_rows($result);
	echo $rowcount;
	if($rowcount >=1 ){
		$_SESSION["product"] = $row;
		$_SESSION["basicpremium"] = $row[$_SESSION["coverperiod"]];
	}else{
		echo "No";
		echo "<script> alert('no product for that referal code')</script>";
		sleep(2);
		header("Location: get_quote.php");
	}
}
include_once"premiumcalcuator.php";
grossCalculater();
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
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
							<h1><a href="index.html" title="Bima Plus">BimaPlus&amp;Insurance Agency</a></h1>
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
				<h1><?php echo $_SESSION['underwriter']?></h1>
				<p><?php echo $_SESSION['description']?></p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">
			<div class="row">
				<div class="col-md-8">

					<div class="owl-carousel add_bottom_15">
						<div class="item"><img src="img/description.jpg" alt="">
												</div>
					</div>

					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">Overview</a>
						</li>
						<li><a href="#tab_2" data-toggle="tab">Reviews</a>
						</li>
											</ul>

					<div class="tab-content">
						<div class="tab-pane fade in active" id="tab_1">
							<h3>Product Overview</h3>
							<hr>
							<div class="row">
								<div class="col-md-4">
									<div class="">
										
										<div class="feature-box-info">
											<h4><?php echo $vehicle_class;?></h4>
											<h5><?php echo $_SESSION["coverage"];?></h5>
										</div>
									</div>
									<hr>
									<div class="">
										
										<div class="feature-box-info">
											<h4>Cover: <?php echo $_POST["coverperiod"];?></h4>
										</div>
									</div>
									<hr>
									<div class="">
										
										<div class="feature-box-info">
											<h4>POLICY BENEFITS:</h4>
											<h5><?php echo $policies?> </h5>
										</div>
									</div>
									<hr>
									<div class="">
										
										<div class="feature-box-info">
											<h4>Conditions and Warranties:</h4>
											<h5><?php echo $conditions;?> </h5>
										</div>
									</div>
									<hr>
								</div>
								<!-- End col -->

								<div class="col-md-8">
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon-ok-4"></i>
										</div>
										<div class="feature-box-info">
											<h4>Benefit 3</h4>
											<p>
												Description of the benefit
											</p>
										</div>
									</div>
									<div class="feature-box">
										<div class="feature-box-icon">
											<i class="icon-ok-4"></i>
										</div>
										<div class="feature-box-info">
											<h4>Benefit 4</h4>
											<p>
												Description of the benefit
											</p>
										</div>
									</div>
								</div>
								<!-- End col -->
							</div>
							<!-- End row -->

							<hr>

							
						</div>
						<!-- End tab_1 -->

						<div class="tab-pane fade" id="tab_2">

							<div id="summary_review">
								<div class="review_score"><span>8,9</span>
								</div>
								<div class="review_score_2">
									<h4>Fabulous  <span>(Based on 34 reviews)</span></h4>
									<p>
										Top Comments
									</p>
								</div>
							</div>
							<!-- End review summary -->
							
							<div class="reviews-container">

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar1.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
										</div>
										<div class="rev-info">
											Admin – April 03, 2021:
										</div>
										<div class="rev-text">
											<p>
												Comment Description
											</p>
										</div>
									</div>
								</div>
								<!-- End review-box -->

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar2.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
										</div>
										<div class="rev-info">
											Ahsan – April 01, 2021:
										</div>
										<div class="rev-text">
											<p>
												Comment Description
											</p>
										</div>
									</div>
								</div>
								<!-- End review-box -->

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar3.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star-empty"></i>
										</div>
										<div class="rev-info">
											Sara – March 31, 2021:
										</div>
										<div class="rev-text">
											<p>
												Comment Description
											</p>
										</div>
									</div>
								</div>
								<!-- End review-box -->

							</div>
							<!-- End review-container -->

							<hr>

							<div class="add-review">
								<h4>Leave a Review</h4>
								<div id="message-review"></div>
								<form method="post" action="assets/review.php" id="review" autocomplete="off">
									<input type="hidden" id="tour_name_review" name="tour_name_review" value="General Louvre Tour">
									<div class="row">
										<div class="form-group col-md-6">
											<label>Name *</label>
											<input type="text" name="name_review" id="name_review" placeholder="" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Lastname *</label>
											<input type="text" name="lastname_review" id="lastname_review" placeholder="" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Email *</label>
											<input type="email" name="email_review" id="email_review" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Rating </label>
											<select name="rating_review" id="rating_review" class="form-control">
												<option value="">Select</option>
												<option value="1">1 (lowest)</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5 (medium)</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10 (highest)</option>
											</select>
										</div>
										<div class="form-group col-md-12">
											<label>Your Review</label>
											<textarea name="review_text" id="review_text" class="form-control" style="height:130px;"></textarea>
										</div>
										<div class="form-group col-md-6">
											<label></label>
											<input type="text" id="verify_review" class=" form-control" placeholder= =">
										</div>
										<div class="form-group col-md-12">
											<input type="submit" value="Submit" class="btn_1" id="submit-review">
										</div>
										
										
									</div>
								</form>
							</div>

						</div>
						<!-- End tab_2 -->

						
					</div>
					<!-- End tabs -->
				</div>
				<!-- End Col -->

				<aside class="col-md-4">
					<div class="box_style_1">
						<div class="price">
							<small>GROSS PREMIUM</small><br><small>KSH <?php echo $grosspremium?></small>
						</div>
						<ul class="list_ok">
							<li>Excess Protection</li>
							<li>Passenger Legal Liability</li>
							<li>Windscreen</li>
						</ul>
						<small>*Terms and Conditions apply</small>
					</div>
					<div class="box_style_2">
						<h3>Summary<span>Delivered To Your Email or Whatsapp</span></h3>
						<div id="message-booking"></div>
						<form method="post" action="quote_step2.php" autocomplete="off">
						
							
							<div class="form-group">
								<label><b>Full Names:</b> <?php echo $_SESSION["name_contact"]?></label>
								
							</div>
							<div class="form-group">
								<label><b>Email:</b> <?php echo $_SESSION["email"]?></label>
								
							</div>
							<div class="form-group">
								<label><b>Phone Number:</b> <?php echo $_SESSION["phone_number"]?></label>
								
							</div>
							<div class="form-group">
								<label><b>Vehicle Class:</b> <?php echo $vehicle_class?></label>
								</div>
							<div class="form-group">
								<label><b>Registration Number:</b>  <?php echo $_SESSION["vehicle_reg"]?></label>
								
							</div>
							
							
							<div class="form-group">
								<input type="submit" value="Buy now" class="btn_full">
							</div>

						</form>
						<hr>
						<a href="javascript:;" class="btn_outline2"> Share Quotation</a>
						<a href="get_quote.php" class="btn_outline"> Back</a>
						<a href="tel:+254733566464" id="phone_2"><i class="icon_set_1_icon-91"></i>+254 733 566 464</a>
						<a href="tel:+254733566464" id="phone_2"><i class="icon_set_1_icon-91"></i>+254 733 566 464</a>

					</div>
				</aside>
			</div>
			<!-- End row -->
		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	<div class="container margin_30">
		<h3 class="second_title">Related Insurance Companies</h3>
		<div class="carousel add_bottom_30">

			<div>
				<div class="img_wrapper">
					
					<!-- End tools i-->
					
						<div class="img_container">
							<a href="detail-page.html">
								<img src="img/insurance/aig.jpg" width="100%" class="img-responsive" alt="">
								<div class="short_info">
									<h3>AIG Insurance</h3>
									<em>Comprehensive &amp; Third-party</em>
									<p>
										Small description about the Insurance company goes here.
									</p>
									<div class="score_wp">Superb
										<div class="score">7.5</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<!-- End img_wrapper -->
			</div>

			<div>
				<div class="img_wrapper">
				
					<div class="img_container">
							<a href="detail-page.html">
								<img src="img/insurance/amaco.jpg" width="800" height="533" class="img-responsive" alt="">
								<div class="short_info">
									<h3>Amaco Insurance</h3>
									<em> Comprehensive &amp; Third-party</em>
									<p>
										Small description about the Insurance company goes here.
									</p>
									<div class="score_wp">Superb
										<div class="score">7.5</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<!-- End img_wrapper -->
			</div>

			<div>
				<div class="img_wrapper">
					
					<div class="img_container">
							<a href="detail-page.html">
								<img src="img/insurance/aar.jpg" width="800" height="533" class="img-responsive" alt="">
								<div class="short_info">
									<h3>AAR Insurance</h3>
									<em>Comprehensive &amp; Third party</em>
									<p>
										Small description about the Insurance company goes here.
									</p>
									<div class="score_wp">Superb
										<div class="score">7.5</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<!-- End img_wrapper -->
			</div>

			<div>
				<div class="img_wrapper">
					
					<div class="img_container">
							<a href="detail-page.html">
								<img src="img/insurance/allianz.jpg" width="800" height="533" class="img-responsive" alt="">
								<div class="short_info">
									<h3>Allianz Insurance</h3>
									<em>Comprehensive &amp; Third-party</em>
									<p>
										Small description about the Insurance company goes here.
									</p>
									<div class="score_wp">Superb
										<div class="score">7.5</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<!-- End img_wrapper -->
			</div>

		</div>
		<!-- End carousel -->
	</div>
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

</body>

</html>