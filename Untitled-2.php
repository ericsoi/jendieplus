
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
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

	<style>
		img{
			display:block;
			width:100%; height:100%;
			object-fit: cover;
		}
	</style>
</head>

<body>

	<!--[if lte IE 8]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
    <![endif]-->

	<!-- Header================================================== -->
	<div id="" class="layer_slider">
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
	<!-- <section class="parallax_window_in" data-parallax="scroll" data-image-src="img/description_banner.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Automobile Details</h1>
				<p>Enter Your Vehicle/Motorcycle details below:</p>
			</div>
		</div>
	</section> -->
	<!-- End section -->
	<!-- End SubHeader ============================================ -->
	<span></span>
	<section class="">
	<div class="card mb-3 h-100">
		<div class="row h-100">
			<div class="col-md-4">
				<img src="img/underwriter_page.jpg." class="" alt="..." height=500 style="object-fit: fit;">
			</div>
			<div class="col-md-2">
				<div class="card-body">
					<h5 class="card-title">Policy Holder Details</h5>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Names</span>
						<input type="text" class="form-control" aria-label="Sizing example input" value='<?php echo $_SESSION["name_contact"]?>' aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Id Number </span>
						<input type="text" class="form-control" aria-label="Sizing example input" value='<?php echo $_SESSION["logbook"]["id_number"]?>'aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Kra Pin</span>
						<input type="text" class="form-control" aria-label="Sizing example input" value='<?php echo $_SESSION["logbook"]["kra_number"]?>'aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Phone</span>
						<input type="text" class="form-control" aria-label="Sizing example input" value='<?php echo $_SESSION["phone_number"]?>' aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Email</span>
						<input type="text" class="form-control" aria-label="Sizing example input" value='<?php echo $_SESSION["email"]?>' aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Occupation</span>
						<input type="text" class="form-control" aria-label="Sizing example input" value='<?php echo $_SESSION["phone_number"]?>' aria-describedby="inputGroup-sizing-default">
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="card-body">
					<h5 class="card-title">Vehicle Details </h5>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Registration</span>
						<input type="text" class="form-control" aria-label="Sizing example input" value='<?php echo $_SESSION["logbook"]["registration"]?>' aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Chassis/Frame</span>
						<input type="text" class="form-control" aria-label="Sizing example input" value='<?php echo $_SESSION["logbook"]["chasis"]?>'aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Engine Number</span>
						<input type="text" class="form-control" aria-label="Sizing example input" value='<?php echo $_SESSION["logbook"]["engine_number"]?>'aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Man Year</span>
						<input type="text" class="form-control" aria-label="Sizing example input" value='<?php echo $_SESSION["logbook"]["man_year"]?>'aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Load Capacity</span>
						<input type="text" class="form-control" aria-label="Sizing example input" value='<?php echo $_SESSION["logbook"]["load_capacity"]?>'aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Seating Capacity</span>
						<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Tax class</span>
						<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="card-body">
					<h5 class="card-title">Payment</h5>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Premium Applicable </span>
						<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Payment Options </span>
						<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Intermediary name </span>
						<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">IRA number</span>
						<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
					</div>
					<div class="input-group input-group-default mb-3">
						<span class="input-group-text" id="inputGroup-sizing-default">Cover Period</span>
						<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
					</div>
					<button type="button" class="btn btn-danger btn-lg  text-align: left !important">Proceeed</button>
				</div>
			</div>
			<div class="col-md-2">
				<div class="card-body">
					<lable>Optional Benefits</div>
					<ul class="list-group">
						<li class="list-group-item">A second item</li>
						<li class="list-group-item">A third item</li>
						<li class="list-group-item">A fourth item</li>
						<li class="list-group-item">And a fifth one</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	</section>
	<?php print_r($_SESSION)?>

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