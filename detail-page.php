<?php 
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
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
    }
	if(isset($_GET["passangers"])){
		$passangers="-".$_GET["passangers"];
	}else{
		$passangers='';
	}
	
	function getRange($value,$lowerlimit,$upperlimit){
	if($value >= $lowerlimit && $value <= $upperlimit){
		$value=$value;
	}else{
		$value=false;
	}
	return $value;
	}

	
    include "dashboard/db/connect_db.php";
	if (isset($_SESSION["client_details"])){
		unset($_SESSION["client_details"]);
	}
	if(isset($_SESSION["product"])){
		unset ($_SESSION['product']);
	}
    $_SESSION["client_details"] = $_GET;
    if(!isset($_SESSION["underwriter"])) { 
		header("refresh:0;url=./index.php");
	}else{
		$underwriter = trim($_SESSION["underwriter"]["Name"]);
		$description = trim($_SESSION["underwriter"]["description"]);
        $coverage =  trim($_SESSION["cover"]["cover"]);
        $referal_code = trim($_SESSION["client_details"]["referal_code"]);
        $vehicleclass = trim($_SESSION["client_details"]["vehicleclass"]);
		$productcode=strtolower("-".$referal_code."-".$underwriter."-".$vehicleclass."-".$coverage);
		$productcode= preg_replace('[ ]', '', $productcode);

	}


function t2($val, $min, $max) {
	return ($val >= $min && $val <= $max);
}


$select = $pdo->prepare("SELECT * FROM tbl_product where product_code = '$productcode'");
$select->execute();
if($select->rowCount()>0){
	
	while($row = $select->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		
		if ($row["product_code"]==$row["uniqueidentifier"] ){
			if(strlen($row[$copy["coverperiod"]])>1){
				$_SESSION['product'] = $row;
				$_SESSION['basicpremium']=$row[$copy["coverperiod"]]?$row[$copy["coverperiod"]]:0;
				$coverperiod=$_GET["coverperiod"];
				include_once "premiumcalcuator.php";
				grossCalculater();
			}else{
				$_SESSION["product"]['vehicleclass'] = "Product Not Found. Kindly contact the agent code owner";$_SESSION["product"]['coverperiod'] = False;$_SESSION["product"]['policylimits']= False;$coverperiod=false;$_SESSION["grosspremium"]=false;

			}

		}else{
			if(isset($copy['tonnage'])){
				
				if(getRange($copy['tonnage'],$row['mintonnage'],$row['maxtonnage']) && strlen($row[$copy["coverperiod"]])>1){
					$_SESSION['product'] = $row;
					$_SESSION['basicpremium']=$row[$copy["coverperiod"]]?$row[$copy["coverperiod"]]:0;
					$coverperiod=$_GET["coverperiod"];
					include_once "premiumcalcuator.php";
					grossCalculater();
				}else{
					$_SESSION["product"]['vehicleclass'] = "Product Not Found. Kindly contact the agent code owner";$_SESSION["product"]['coverperiod'] = False;$_SESSION["product"]['policylimits']= False;$coverperiod=false;$_SESSION["grosspremium"]=false;
				}
			}
			if(isset($copy["passangers"])){
				if(strlen($row[$copy["coverperiod"]])>1){
					$_SESSION['product'] = $row;
					$_SESSION['basicpremium']=$row[$copy["coverperiod"]]?$row[$copy["coverperiod"]]:0;
					$coverperiod=$_GET["coverperiod"];
					include_once "premiumcalcuator.php";
					grossCalculater();
				}else{
					$_SESSION["product"]['vehicleclass'] = "Product Not Found. Kindly contact the agent code owner";$_SESSION["product"]['coverperiod'] = False;$_SESSION["product"]['policylimits']= False;$coverperiod=false;$_SESSION["grosspremium"]=false;					
				}
			}
			if($row["coverage"] == "Comprehensive"){
				$age=date("Y")-$copy["yom"];
				echo getRange($copy['sum_insured'], $row["minsum"], $row["maxsum"]);
				if(getRange($age, $row["minage"], $row["maxage"]) && getRange($copy['sum_insured'], $row["minsum"], $row["maxsum"])){
					$_SESSION['product'] = $row;
					$premium=$copy['sum_insured']*($row[$copy["coverperiod"]]/100);
					if($premium<=$row["minimumpremium"]){
						$_SESSION['basicpremium']=$row["minimumpremium"];
					}elseif($premium>=$row["minimumpremium"]){
						$_SESSION['basicpremium']=$premium;
					}
					$coverperiod=$_GET["coverperiod"];
					include_once "premiumcalcuator.php";
					grossCalculater();
				}else{
					$_SESSION["product"]['vehicleclass'] = "Product Not Found. Kindly contact the agent code owner";$_SESSION["product"]['coverperiod'] = False;$_SESSION["product"]['policylimits']= False;$coverperiod=false;$_SESSION["grosspremium"]=false;
				}
			}
		}
	}
}else{
	$_SESSION["product"]['vehicleclass'] = "Product Not Found. Kindly contact the agent code owner";$_SESSION["product"]['coverperiod'] = False;$_SESSION["product"]['policylimits']= False;$coverperiod=false;$_SESSION["grosspremium"]=false;
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.3/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.1.1/css/mdb.min.css" rel="stylesheet">
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
							<h1><a href="index.php" title="JendiePlus">JendiePlus&amp;Insurance Tehnologies</a></h1>
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
								<li><a href="index.php">Home</a></li>
								
								<li><a href="about.php">About us</a></li>
								<li><a href="services.php">Services</a></li>
								<li><a href="contact.php">Contact us</a></li>
								<li><a href="login.php">Agent Login/Register</a></li>
								
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
				<h1><?php echo $underwriter?></h1>
				<p><?php echo $description?></p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">
		<form method="get" action="quote_step2.php" autocomplete="off">

			<div class="row">
				<div class="col-md-8">

					<div class="owl-carousel add_bottom_15">
						<div class="item"><img src="img/description.jpg" alt="">
												</div>
					</div>

					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">Overview</a>
						</li>
						<li><a href="#" data-toggle="tab">Reviews</a>
						</li>
											</ul>

					<div class="tab-content">
						<div class="tab-pane in active" id="tab_1">
							<h3>Product Overview</h3>
							<hr>
							<div class="row">
								<div class="col-md-7">
									<div class="">
										
										<div class="feature-box-info">
											<h5><?php echo $_SESSION["product"]["vehicleclass"];?></h5>
											<p><?php echo $coverage;?></p>
										</div>
									</div>
									<hr>
									<div class="">
										
										<div class="feature-box-info">
											<h5>Cover Period: <?php echo $coverperiod;?></h5>
										</div>
									</div>
									<hr>
									<div class="">
										
										<div class="feature-box-info">
											<h5>POLICY BENEFITS:</h5>
											<p><?php echo $_SESSION["product"]["policylimits"];?> </p>
										</div>
									</div>
									<hr>
								</div>
								<!-- End col -->
								<div class="col-md-5">
									<?php
										if(isset($_SESSION["product"]["product_id"])){
											
											$product_id = $_SESSION["product"]["product_id"];
                                            $select = $pdo->prepare("SELECT * FROM `tbl_benefits` where product_id = '$product_id'");
                                            $select->execute();
                                            if($select->rowCount()>0){
                                                echo "<p>Optional Benefits</p>";
                                                $i = 1;
                                                while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                                    extract($row);
                                                    $i++;
													$value=$row["benefit_rate"]."-".$row["benefit_freelimit"]."-".$row["benefit_days"]."-".$row["benefit_amount"];
												
									?>		
									<div class="form-check">	
										<div class="feature-box-icon">
											<input type="checkbox" name = "<?php echo $row['benefit_name']?>" class="form-check-input" value = "<?php echo $value ?>" id="<?php echo $row['benefit_id']?>" onchange= "handleoptional_benefits(this)">
											<label class="form-check-label" for="<?php echo $row['benefit_id']?>"><?php echo str_replace("_", " ", $row["benefit_name"])?></label>
				
											<div id="<?php echo 'input'.$row['benefit_id']?>">
											</div>
										</div>
									</div>
									<?php
										}
                                    
									?>
									<input type="hidden" class="form-group" id="benefittotal"value="Total: 0" readonly> </input>
									<?php
                                        }
                                    }		
                                ?>
										
								</div>
								<!-- End col -->
							</div>
							<!-- End row -->
							<hr>
						</div>
						<!-- End tab_1 -->

						<div class="tab-pane fade" id="tab_2">
							<div class="reviews-container">
							</div>
							<hr>
						</div>
						<!-- End tab_2 -->
					</div>
					<!-- End tabs -->
				</div>
				<!-- End Col -->

				<aside class="col-md-4">
					<div class="box_style_1">
						<div class="price">
							<small>GROSS PREMIUM</small><br><small id="grosspremium">KSH <?php echo $_SESSION["grosspremium"]?></small>
						</div>
						<ul class="list_ok" id="optionalbenefits">
							
						</ul>
						<small>*Terms and Conditions apply</small>
					</div>
					<div class="box_style_2">
						<h3>Summary<span>Delivered To Your Email or Whatsapp</span></h3>
						<div id="message-booking"></div>
						
							
							<div class="form-group">
								<label><b>Full Names:</b> <?php echo $_SESSION["client_details"]["name_contact"]?></label>
								
							</div>
							<div class="form-group">
								<label><b>Email:</b> <?php echo $_SESSION["client_details"]["email"]?></label>
								
							</div>
							<div class="form-group">
								<label><b>Phone Number:</b> <?php echo $_SESSION["client_details"]["phone_number"]?></label>
								
							</div>
							<div class="form-group">
								<label><b>Vehicle Class:</b> <?php echo $_SESSION["product"]["vehicleclass"]?></label>
								</div>
							<div class="form-group">
								<label><b>Registration Number:</b>  <?php echo $_SESSION["client_details"]["vehicle_reg"]?></label>
								
							</div>
							
							<?php if(isset($_SESSION["product"]['product_id'])){echo '<div class="form-group"><input type="submit" value="Buy now" class="btn_full"></div>';}else{echo'';}?>
							
						<hr>
						<a href="javascript:;" class="btn_outline2"> Share Quotation</a>
						<a href="get_quote.php" class="btn_outline"> Back</a>
						<a href="tel:+254733566464" id="phone_2"><i class="icon_set_1_icon-91"></i>+254 723 775 289</a>
						<a href="tel:+254733566464" id="phone_2"><i class="icon_set_1_icon-91"></i>+254 723 775 289</a>

					</div>
				</aside>
			</div>
			<!-- End row -->
		</div>
		<form>
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
						<div class="form-group">
						</div>
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
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon-search-6"></i>
			</button>
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
	<!-- JQuery -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.3/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.1.1/js/mdb.min.js"></script>
	<script type="text/javascript">

		var added=[]
		var grossfinal = "";
		function calculateGrosspremium(premium, id){
			basicpremium=Math.ceil(premium+(0.45/100 * premium))
			var grosspremium = document.getElementById("grosspremium").innerHTML;
			grosspremium=parseFloat(grosspremium.replace('KSH ', ''));
			grosspremium+=basicpremium;
			added.push({"id":id,"premium":basicpremium});
			grossfinal = grosspremium
			document.getElementById("grosspremium").innerHTML = "KSH " + grosspremium;
		}	
		function removepremium(premium){
			var grosspremium = document.getElementById("grosspremium").innerHTML;
			grosspremium=parseFloat(grosspremium.replace('KSH ', ''));
			grosspremium = grossfinal - premium;
			document.getElementById("grosspremium").innerHTML = "KSH " + grosspremium;
		}	
		function handlewindscreen(id,freelimit,inputvalue){
			document.getElementById(id).readOnly = true;
			var rate = freelimit.split("-")[0];
			freelimit = freelimit.split("-")[1];
			var premium = 0;
			if(inputvalue-freelimit < 0){
				premium=0;
			}else{
				premium=(rate/100)*(inputvalue-freelimit);
			}
			
			calculateGrosspremium(premium, id);
		}
		
		function handlepassanger(id,passangers,value){
			document.getElementById(id).readOnly = true;
			console.log(id,passangers,value);
			premium=passangers*value;
			calculateGrosspremium(premium, id)
			// document.getElementById(id).readOnly = true;
			// var rate = freelimit.split("-")[0];
			// freelimit = freelimit.split("-")[1];
			// var premium = 0;
			// if(inputvalue-freelimit < 0){
			// 	premium=0;
			// }else{
			// 	premium=(rate/100)*(inputvalue-freelimit);
			// }
			
			// calculateGrosspremium(premium, id);
		}
		function handlevalue(id,value){
			var grosspremium = document.getElementById("grosspremium").innerHTML;
			grosspremium=parseFloat(grosspremium.replace('KSH ', ''));
			grosspremium+=parseFloat(value);
			added.push({"id":id,"premium":value});
			grossfinal = grosspremium
			document.getElementById("grosspremium").innerHTML = "KSH " + grosspremium;
		}
		
		function handleoptional_benefits(input){
			inputArray = ["WINDSCREEN", "RADIO_CASSETE", "PASSENGER_LEGAL_LIABILITY","COURTESY_CAR"];
			var benefitlist=[];
			var targetInput = 'input'+input.id;
			// console.log(input.value)
			if (inputArray.includes(input.name) && input.checked){
				if ((input.name == "WINDSCREEN" || input.name == "RADIO_CASSETE")){
					// calculateGrosspremium();
					var value = input.value.split("-")[0] +"-"+ input.value.split("-")[1];
					document.getElementById(targetInput).innerHTML = '\
						<div class="md-form form-sm">\
							<input type="number" tag="ewew" id=form'+input.id+' name='+value+' class="form-control" onchange="handlewindscreen(this.id,this.name, this.value)"></input>\
							<label for='+targetInput+'>Enter Value</label>\
						</div>';
				}else if(input.name == "PASSENGER_LEGAL_LIABILITY"){
					var value = input.value.split("-");
					value = value.pop();
					document.getElementById(targetInput).innerHTML = '\
						<div class="md-form form-sm">\
							<input type="number" tag="ewew" id=form'+input.id+' name='+value+' class="form-control" onchange="handlepassanger(this.id,this.name, this.value)"></input>\
							<label for='+targetInput+'>Enter Value</label>\
						</div>';
				}else if(input.name == "COURTESY_CAR"){
					document.getElementById(targetInput).innerHTML = '\
						<div class="md-form form-sm">\
						<input type="number" tag="ewew" id='+targetInput+' name='+input.value+' class="form-control" onkeyup="handleChange(this.id,this.name)"></input>\
							<label for='+targetInput+'>No of Days</label>\
						</div>';
				}else{
					console.log(" dssdsdsdsdsds ");
					// calculateGrosspremium();
				}
			}else{
				document.getElementById(targetInput).innerHTML = '';
				// added.forEach(add => {
				// for (let key in add) {
				// 	console.log(add[key]);
				// }});
				added.forEach(add => {
					for (let key in add) {
						if(add["id"] == "form"+input.id){
							console.log(add["premium"]);
							removepremium(add["premium"]);
						}
					}});
				
			}
			if (!(inputArray.includes(input.name)) && input.checked){
				console.log(input.value);
				var value = input.value.split("-");
				value = value.pop();
				console.log(value);
				handlevalue("form"+input.id, value);
			}
			if (input.checked){
				benefitlist.push(input.name)
				var ul = document.getElementById("optionalbenefits");
				var li = document.createElement("li");
				li.setAttribute('id',input.id + "optional" );
				li.appendChild(document.createTextNode(input.name));
				ul.appendChild(li);
			}else{
				// console.log(input.id+"optional");
				var elem = document.getElementById(input.id+"optional");
				elem.parentNode.removeChild(elem);
			}
		}


		// $row["benefit_rate"]."-".$row["benefit_freelimit"]."-".$row["benefit_days"]."-".$row["benefit_amount"]
		// var inputs = 0;
		// function handle_input(selector, idString, selectorId){
		// 	var frontName = selector.name.replaceAll("_", " ")
		// 	if(idString.indexOf(selector.name) == -1){
		// 		idString = selector[idString.indexOf(selector.name)];
		// 	}else{
		// 		idString = selector.value;
		// 	}
		// 	if (selector.checked) {
		// 		var ul = document.getElementById("optionalbenefits");
		// 		var li = document.createElement("li");
		// 		console.log(selector.value);
		// 		console.log(idString);
		// 		if (selector.value.indexOf(idString) !== -1){
		// 			var variables = selector.value.split("-");
		// 			console.log("Checked");
		// 			var name = selector.value + "-checked"
		// 			var rate = variables.pop();
		// 			var freeLimit = variables[0];
		// 			// console.log(name);
		// 			// var premium = (rate/100) * freeLimit;
		// 			var targetInput = "input-" + selector.id;
					document.getElementById(targetInput).innerHTML = '\
					<div class="md-form form-sm">\
						<input type="number" tag="ewew" id='+targetInput+' name='+name+' class="form-control" onkeyup="handleChange(this.id,this.name, this.value)"></input>\
						<label for='+targetInput+'>Value</label>\
					</div>';
		// 			li.setAttribute('id',selector.id + "optional" );
		// 			li.appendChild(document.createTextNode(frontName));
		// 			ul.appendChild(li);
		// 		}else{
		// 			var variables = selector.value.split("-");
		// 			var rate = parseFloat(variables.pop())
		// 			var value = parseFloat(variables[0]);
		// 			var premium = value * rate
		// 			var benefittotal = parseFloat(document.getElementById("benefittotal").value.split(": ").pop()) + premium
		// 			// console.log(benefittotal)
		// 			document.getElementById("benefittotal").value = "Total: " + benefittotal;
		// 			li.setAttribute('id',selector.id + "optional" );
		// 			li.appendChild(document.createTextNode(frontName));
		// 			ul.appendChild(li);
		// 		}
        //         // console.log(selector.id);
				
				
				

        //         var grossPremium = parseInt(document.getElementById("grosspremium").innerHTML.split(" ").pop());
		// 		// var totalgrossPremium = grossPremium + subTotal;
		// 		// document.getElementById("grosspremium").value = "KSH " + totalgrossPremium;
				
		// 	}
		// 	else {
		// 		var ul = document.getElementById("optionalbenefits");
		// 		var candidate = document.getElementById(selector.id + "optional");
		// 		var targetInput = "input-" + selector.id;
				
		// 		if (selector.value.indexOf(idString) !== -1){
		// 			var variables = selector.value.split("-");
		// 			var name = selector.value + "-notchecked"
		// 			var rate = variables.pop();
		// 			var freeLimit = variables[0];
		// 			var benefittotal = parseFloat(document.getElementById("benefittotal").value.split(": ").pop()) - parseFloat(inputs)
		// 			document.getElementById("benefittotal").value = "Total: " + benefittotal;
		// 			console.log(inputs);

		// 		}else{
		// 			var variables = selector.value.split("-");
		// 			var name = selector.value + "-notchecked"
		// 			var rate = parseFloat(variables.pop());
		// 			var value = parseFloat(variables[0]);
		// 			var premium = rate*value
		// 			var benefittotal = parseFloat(document.getElementById("benefittotal").value.split(": ").pop()) - parseFloat(premium)
		// 			document.getElementById("benefittotal").value = "Total: " + benefittotal;
		// 			console.log(benefittotal);
		// 		}

		// 		document.getElementById(targetInput).innerHTML = "";
		// 		ul.removeChild(candidate);	
        //     }				
		// }
		// function handleoptional_benefits(clicked_id){
		// 	inputArray = ["WINDSCREEN", "RADIO_CASSETE", "PASSENGER_LEGAL_LIABILITY","COURTESY_CAR"]
		// 	var benefitSelector = document.getElementById(clicked_id);
		// 	handle_input(benefitSelector, inputArray, clicked_id)
		// 	var basicpremium = parseFloat(document.getElementById("grosspremium").innerHTML.split(" ").pop())
		// 	var totalBenefits = parseFloat(document.getElementById("benefittotal").value.split(": ").pop())
		// 	var grossPremium = basicpremium + totalBenefits
		// 	console.log(basicpremium)
		// 	console.log(totalBenefits)
		// 	document.getElementById("grosspremium").innerHTML = "KSH " + grossPremium
		// }
		// function handleChange(id,name,input_value){
		// 	console.log(id, name, input_value)
		// 	isChecked = name.split("-").pop()
		// 	rate = name.split("-")[1]
		// 	value = name.split("-")[0]
		// 	// console.log(value, input_value, rate);
		// 	if (parseFloat(input_value) > parseFloat(value)){
		// 		var premium = (parseFloat(input_value) - parseFloat(value))*parseFloat(rate);
		// 		console.log(premium, "ppp")
		// 		inputs = premium;
		// 		var benefittotal = parseFloat(document.getElementById("benefittotal").value.split(": ").pop()) + premium
		// 		console.log(benefittotal)
		// 		document.getElementById("benefittotal").value = "Total: " + benefittotal;
		// 		console.log(inputs, "lll");
		// 	}

		// 	var additionalOptional = parseInt(name);
		// 	var additionalinput = parseInt(document.getElementById(id).value);
		// 	// if (additionalinput > additionalOptional){
		// 	// 	aditionalTotal = additionalinput = additionalOptional;
		// 	// 	var subTotalOptional = document.getElementById("benefittotal").value.split(": ").pop()
		// 	// 	subTotal = parseInt(subTotalOptional) + parseInt(aditionalTotal);
		// 	// 	document.getElementById("benefittotal").value = "Total: " + subTotal;
		// 	// 	var grossPremium = parseInt(document.getElementById("grosspremium").innerHTML.split(" ").pop());
		// 	// 	var totalgrossPremium = grossPremium + subTotal;
		// 	// 	document.getElementById("grosspremium").innerHTML = "KSH " + totalgrossPremium;

		// 	// }
			
		// }
		
	</script>
</body>

</html>