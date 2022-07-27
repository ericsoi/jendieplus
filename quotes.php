<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
	include_once"dashboard/session.php";
}
if(isset($_GET)){
	$copy = $_GET;
	foreach ($copy as $key => $value) {
		if ($value == "1 week") {
			$value = "weeklyrates";
		}elseif ($value == "2 weeks"){
			$value = "fortnightrates";
		}elseif ($value == "1 month"){
			$value= "monthlyrates";
		}elseif ($value == "1 year"){
			$value = "annualrates";
		}
		$copy[$key] = $value;
	}
	$_SESSION["client_details"]=$_GET;
	// print_r($_SESSION);
	$refferal_code = $_GET["refferal_code"];
	$coverage = $_GET["cover"];
	// print_r($coverage);
	// print_r($refferal_code);
}

	// $referal_code = $_SESSION["referal_code"];
	// $underwriter = $_SESSION["underwriter"];
	// $coverage = $_SESSION["coverage"];
	// print_r($_SESSION);
	
	// if(isset($_POST['tonnage'])){
	// 	$tonnage = $_POST['tonnage'];
	// 	$sql = "SELECT * FROM `tbl_product` WHERE maxtonnage < $tonnage and not maxtonnage = '' and coverage = '$coverage' and owner = '$referal_code' ORDER BY maxtonnage ASC limit 1";
	// 	$result = mysqli_query($connection, $sql);
	// 	$row = mysqli_fetch_array($result);
	// 	$rowcount=mysqli_num_rows($result);
	// 	if($rowcount >=1){
	// 		$_SESSION["product"] = $row;
	// 		$_SESSION["basicpremium"] = $row[$_SESSION["coverperiod"]];
	// 	}else{
	// 		echo "<script> alert('no product for that referal code')</script>";
	// 		sleep(2);
	// 		header("Location: get_quote.php");
	// 	}
	// }elseif(isset($_POST["passangers"])){
	// 	$passangers = $_POST['passangers'];
	// 	$sql = "SELECT * FROM `tbl_product` WHERE passangers = '$passangers' and coverage = '$coverage' and owner = '$referal_code' ORDER BY passangers ASC limit 1";
	// 	$result = mysqli_query($connection, $sql);
	// 	$row = mysqli_fetch_array($result);
	// 	$rowcount=mysqli_num_rows($result);
	// 	if($rowcount >=1){
	// 		$_SESSION["product"] = $row;
	// 		$_SESSION["basicpremium"] = $row[$_SESSION["coverperiod"]];
	// 	}else{
	// 		echo "<script> alert('no product for that referal code')</script>";
	// 		sleep(2);
	// 		header("Location: get_quote.php");
	// 	}
	// }else{
	// 	$sql = "SELECT * FROM `tbl_product` WHERE underwriter = '$underwriter' and coverage = '$coverage' and owner = '$referal_code' ASC limit 1";
	// 	$result = mysqli_query($connection, $sql);
	// 	$row = mysqli_fetch_array($result);
	// 	$_SESSION["product"] = $row;
	// 	$_SESSION["basicpremium"] = $row[$_SESSION["coverperiod"]];
	// 	$rowcount=mysqli_num_rows($result);
	// 	if($rowcount >=1 ){
	// 		$_SESSION["product"] = $row;
	// 		$_SESSION["basicpremium"] = $row[$_SESSION["coverperiod"]];
	// 	}else{
	// 		echo "<script> alert('no product for that referal code')</script>";
	// 		sleep(2);
	// 		header("Location: get_quote.php");
	// 	}
	// }
	// include_once"premiumcalcuator.php";
	// grossCalculater();
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
	<title>JendiePlusPlus :: Smart INSURANCE Mkononi</title>
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
    
    <!-- SPECIFIC CSS -->
    <link href="layerslider/css/layerslider.css" rel="stylesheet">

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

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<!-- Header================================================== -->
	

<div class="quotespacer"></div>

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">

			<?php
				
			?>
			<div class="main_title">
				<h2><span> Quotes</span></h2>
				<p>Quotations for vehicle registration: Registration Number <?echo $_POST["vehicle_reg"]?> &nbsp;Coverage: <?echo $_POST["cover"] ?>&nbsp;
					for a period of  <?echo $period?>. Choose your prefered underwriter below to continue</p>
					
			</div>
			<div class="row">
					<!-- End img_wrapper -->
				</div>
				<?php
				$record_per_page = 6;
				$page = '';
				if(isset($_GET["page"])){
					$page = $_GET["page"];
					$search = @$_GET['page']; 
				}else {
					$page = 1;
				}
				// $class = trim(explode(":", $vehicle_class)[1]);
				$start_from = ($page-1)*$record_per_page;
				
				// if (isset($_POST["passangers"])){
				// 	$passangers = trim($_POST["passangers"]);
				// 	if ($passangers > 36 && $class == "PSV - Matatu"){
				// 		$class = "PSV - BUS";
				// 	}elseif($passangers <= 36 && $class == "PSV - BUS"){
				// 		$class = "PSV - Matatu";
				// 	}
				// 	if ($period == "1 Week"){
				// 		$sql = "SELECT * FROM Product WHERE coverage = '$cover' AND risk like '%$class' and length(weeklyrates) < 7 and passangers ='$passangers'";
				// 	}
				// 	if ($period == "2 Weeks"){
				// 		$sql = "SELECT * FROM Product WHERE coverage = '$cover'	AND risk like '%$class' and length(fortnightrates) < 7 and passangers ='$passangers'";
				// 	}
				// 	if ($period == "1 Month"){
				// 		$sql = "SELECT * FROM Product WHERE coverage = '$cover' AND risk like '%$class' and length(monthlyrates) < 7 and passangers ='$passangers'";
				// 	}
				// 	if ($period == "1 Year"){
				// 		$sql = "SELECT * FROM Product WHERE coverage = '$cover' AND risk like '%$class' and length(annualrates) < 7 and passangers ='$passangers'";
				// 	}
				// }else{
				// 	echo $period;
				// 	$sql = "SELECT * FROM tbl_product WHERE owner = '$referal_code'";
				// }
					#echo $cover . $class . $passangers;
				//elseif (isset($_POST["tonnage"])) {
					//$sql = "SELECT * FROM Product WHERE coverage = '$cover' AND risk like '%$class' and length(annualrates) < 7 and passangers ='$passangers'";
				//}
				#_r($_POST);
					
				// if(mysqli_num_rows($result) > 0){
				$select = $pdo->prepare("SELECT * FROM tbl_product WHERE owner = '$refferal_code' and coverage = '$coverage'");
				$select->execute();
				// echo ($select->rowCount());
				while($row = $select->fetch(PDO::FETCH_ASSOC)){

						#extract($row);
						// print_r($row);
						//print_r($_POST);
						// if ($cover == "Third Party Only"){
						// 	if($period == "1 Week"){
						// 		$basic_premium = $row["weeklyrates"];
						// 	}elseif ($period == "2 Weeks") {
						// 		$basic_premium = $row["fortnightrates"];							
						// 	}elseif ($period == "1 Month") {
						// 		$basic_premium = $row["monthlyrates"];							
						// 	}elseif ($period == "1 Year") {
						// 		$basic_premium = $row["annualrates"];							
						// 	}
							
						// 	else{
						// 		$basic_premium = $row["annualrates"];
						// 	}

						// }else{
						// 	$basic_premium = $row["annualrates"] * $_GET["suminsured"] * 0.01;
						// 	if( $basic_premium < $row["minimumpremium"]){
						// 		$basic_premium = $row["minimumpremium"];
							
						// 	}
						// }
						
						// $stamp_duty = 40; //for new businesses.
						// #$policy_holder_compensation_fund = (0.2/100) * $basic_premium;
						// #$training_levy = (0.25/100) * $basic_premium;
						// #$gross_premium = $basic_premium + $training_levy + $policy_holder_compensation_fund + $stamp_duty;//+ Optional Benefits(in caps) new businesses 
						// #$gross_premium = round($gross_premium);
						$underwriter_image = $row["underwriter"];
						// print_r($underwriter_image);
						$select1 = $pdo->prepare("SELECT * from underwriters where Name like '%$underwriter_image'");
						$select1->execute();
						$image_rows = $select1->fetch(PDO::FETCH_ASSOC);
						$name = $image_rows["Name"];
						$image = $image_rows["path"];
						$description = $image_rows["description"];
						$_SESSION["underwriter"] = $image_rows;
				?>
				<div class="col-md-4 col-sm-6 wow fadeIn animated" data-wow-delay="0.2s">
					<div class="img_wrapper">
						<div class="img_container" style="height:233px;">
							<a href="detail-page.php?<?php echo $name?>" class="fill" id="underwriter">
								<img src="<?php echo $image?>" width="100%" height="100px" class="img-responsive" alt="">
								<div class="short_info">
									<!-- <h3><?echo$row["underwriter"]?></h3> -->
									
									<!-- <em><?echo $cover?></em><br> -->
									<em style="background-color:black; font-size:25px;">Kshs. <?echo $gross_premium?></em>
									<p>
									</p>							
										

									<div class="score_wp">
										<div class="score">7.5</div>
									</div>
								</div>
								
							</a>
						</div>
						
					</div>
					<!-- End img_wrapper -->
				</div>
				<?php
					}
				
				?>
			</div>

				

			
			<nav class="pagination-wrapper">
				<ul class="pagination">
					<li><a href="#">1</a>
					</li>
					<li><a href="#">2</a>
					</li>
					<li><a href="#">3</a>
					</li>
					<li><a href="#">4</a>
					</li>
					<li><a href="#">5</a>
					</li>
					<li>
						<a href="#" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</section>
	<!-- End section -->

	<section class="container margin_60">
		<div class="main_title">
			<h3>Why choose JendiePlus</h3>
			<p>We are relentless in striving to offer innovative products while leveraging on advancing technology for an automated, transparent and seamless processes.</p>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="box_how">
					<div class="icon_how"><span class="icon_set_1_icon-81"></span>
					</div>
					<h4>Best price guarantee</h4>
					<p>Compare prices from multiple companies to get the best deals.</p>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box_how">
					<div class="icon_how"><span class="icon_set_1_icon-94"></span>
					</div>
					<h4>Professional Team</h4>
					<p>Our team well trained and ready to assist on any issue 24/7.</p>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box_how">
					<div class="icon_how"><span class="icon_set_1_icon-92"></span>
					</div>
					<h4>Certificate in Minutes</h4>
					<p>Get your insurance certificate delivered instantly to your email or whatsapp.</p>
				</div>
			</div>
		</div>
		<!-- End Row -->
	</section>
	<!-- End Container -->

	
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
    <script src="layerslider/js/greensock.js"></script>
    <script src="layerslider/js/layerslider.transitions.js"></script>
    <script src="layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
    <script type="text/javascript">
        'use strict';
        $('#layerslider').layerSlider({
            autoStart: true,
            navButtons: false,
            navStartStop: false,
            showCircleTimer: false,
            responsive: true,
            responsiveUnder: 1280,
            layersContainer: 1200,
            skinsPath: 'layerslider/skins/'
                // Please make sure that you didn't forget to add a comma to the line endings
                // except the last line!
        });
    </script>

</body>

</html>