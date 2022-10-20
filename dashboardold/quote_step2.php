<?php 
	session_start(); 
	include "livechat.php";
    require '../config/db.php';
    if(!isset($_SESSION["underwriter"])) { 		
      header("refresh:0;url=./index.php");
	}
		$registration = $chasis = $make = $model = $type = $body = $fuel = $man_year = $rating = $engine_number = $color = $reg_date = $gross_weight = $duty = $previous_owners = $passengers = $tare_weight = $tax_class = $axels = $load_capacity = $reg_country = $previous_reg = $date = $id_number = $id_file = $kra_number = $kra_file = $logbook_file = "";
		$registration_err = $chasis_err = $make_err = $model_err = $type_err = $body_err = $fuel_err = $man_year_err = $rating_err = $engine_number_err = $color_err = $reg_date_err = $gross_weight_err = $duty_err = $previous_owners_err = $passengers_err = $tare_weight_err = $tax_class_err = $axels_err = $load_capacity_err = $reg_country_err = $previous_reg_err = $date_err = $id_number_err = $kra_number_err =  "";

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			// Validate registration
			if(empty(trim(@$_POST["registration"]))){
				$registration_err = "Please enter registration.";
			} else{
				$registration = trim(@$_POST["registration"]);
			}

			// Validate chasis
			if(empty(trim(@$_POST["chasis"]))){
				$chasis_err = "Please enter chasis.";
			} else{
				$chasis = trim(@$_POST["chasis"]);
			}

			// Validate  make
			if(empty(trim(@$_POST["make"]))){
				$make_err = "Please enter  make.";
			} else{
				$make = trim(@$_POST["make"]);
			}

			// Validate model
			if(empty(trim(@$_POST["model"]))){
				$model_err = "Please enter model.";
			} else{
				$model = trim(@$_POST["model"]);
			}

			// Validate type
			if(empty(trim(@$_POST["type"]))){
				$type_err = "Please enter type.";
			} else{
				$type = trim(@$_POST["type"]);
			}

			// Validate body
			if(empty(trim(@$_POST["body"]))){
				$body_err = "Please enter body.";
			} else{
				$body = trim(@$_POST["body"]);
			}

			// Validate fuel
			if(empty(trim(@$_POST["fuel"]))){
				$fuel_err = "Please enter fuel.";
			} else{
				$fuel = trim(@$_POST["fuel"]);
			}

			// Validate man_year
			if(empty(trim(@$_POST["man_year"]))){
				$man_year_err = "Please enter man_year.";
			} else{
				$man_year = trim(@$_POST["man_year"]);
			}

			// Validate rating
			if(empty(trim(@$_POST["rating"]))){
				$rating_err = "Please enter rating.";
			} else{
				$rating = trim(@$_POST["rating"]);
			}

			// Validate engine_number
			if(empty(trim(@$_POST["engine_number"]))){
				$engine_number_err = "Please enter engine_number.";
			} else{
				$engine_number = trim(@$_POST["engine_number"]);
			}

			// Validate coclor
			if(empty(trim(@$_POST["color"]))){
				$color_err = "Please enter coclor.";
			} else{
				$color = trim(@$_POST["color"]);
			}


			// Validate reg_date
			if(empty(trim(@$_POST["reg_date"]))){
				$reg_date_err = "Please enter reg_date.";
			} else{
				$reg_date = trim(@$_POST["reg_date"]);
			}

			// Validate gross_weight
			if(empty(trim(@$_POST["gross_weight"]))){
				$gross_weight_err = "Please enter gross_weight.";
			} else{
				$gross_weight = trim(@$_POST["gross_weight"]);
			}

			// Validate duty
			if(empty(trim(@$_POST["duty"]))){
				$duty_err = "Please enter duty.";
			} else{
				$duty = trim(@$_POST["duty"]);
			}

			// Validate previous_owners
			if(empty(trim(@$_POST["previous_owners"]))){
				$previous_owners_err = "Please enter previous_owners.";
			} else{
				$previous_owners = trim(@$_POST["previous_owners"]);
			}

			// Validate passengers
			if(empty(trim(@$_POST["passengers"]))){
				$passengers_err = "Please enter passengers.";
			} else{
				$passengers = trim(@$_POST["passengers"]);
			}

			// Validate tare_weight
			if(empty(trim(@$_POST["tare_weight"]))){
				$tare_weight_err = "Please enter tare_weight.";
			} else{
				$tare_weight = trim(@$_POST["tare_weight"]);
			}

			// Validate tax_class
			if(empty(trim(@$_POST["tax_class"]))){
				$tax_class_err = "Please enter tax_class.";
			} else{
				$tax_class = trim(@$_POST["tax_class"]);
			}

			// Validate axels
			if(empty(trim(@$_POST["axels"]))){
				$axels_err = "Please enter axels.";
			} else{
				$axels = trim(@$_POST["axels"]);
			}

			// Validate load_capacity
			if(empty(trim(@$_POST["load_capacity"]))){
				$load_capacity_err = "Please enter load_capacity.";
			} else{
				$load_capacity = trim(@$_POST["load_capacity"]);
			}

			// Validate reg_country
			if(empty(trim(@$_POST["reg_country"]))){
				$reg_country_err = "Please enter reg_country.";
			} else{
				$reg_country = trim(@$_POST["reg_country"]);
			}

			// Validate previous_reg
			if(empty(trim(@$_POST["previous_reg"]))){
				$previous_reg_err = "Please enter previous_reg.";
			} else{
				$previous_reg = trim(@$_POST["previous_reg"]);
			}

			// Validate date
			if(empty(trim(@$_POST["date"]))){
				$date_err = "Please enter date.";
			} else{
				$date = trim(@$_POST["date"]);
			}

			// Validate id_number
			if(empty(trim(@$_POST["id_number"]))){
				$id_number_err = "Please enter id_number.";
			} else{
				$id_number = trim(@$_POST["id_number"]);
			}

			/* Validate id_file
			if(empty(trim(@$_POST["id_file"]))){
				$id_file_err = "Please enter id_file.";
			} else{
				$id_file = trim(@$_POST["id_file"]);
			}*/

			// Validate kra_number
			if(empty(trim(@$_POST["kra_number"]))){
				$kra_number_err = "Please enter kra_number.";
			} else{
				$kra_number = trim(@$_POST["kra_number"]);
			}

			/* Validate kra_file
			if(empty(trim(@$_POST["kra_file"]))){
				$kra_file_err = "Please enter kra_file.";
			} else{
				$kra_file = trim(@$_POST["kra_file"]);
			}

			/* Validate logbook_file
			if(empty(trim(@$_POST["logbook_file"]))){
				$logbook_file_err = "Please enter logbook_file.";
			} else{
				$logbook_file = trim(@$_POST["logbook_file"]);
			}
			*/
			$logbooks = "client_files/logbooks/$id_number/";
			if (!file_exists($logbooks)) {
				mkdir($logbooks, 0755, true);
				
			}
			$docs = array();
			if ( null !==  @$_FILES['clientFiles']){
				foreach(@$_FILES['clientFiles']['tmp_name'] as $key=>$tmp_name){
					$file_name = $key.$_FILES['clientFiles']['name'][$key];
					$file_tmp =$_FILES['clientFiles']['tmp_name'][$key];
					
					if ($key == 0){
						$file_name = "idnumber-_-" . $file_name;
						$logbook_file = $file_name;
					}elseif($key == 1){
						$file_name = "kra-_-" . $file_name;
						$id_file = $file_name;
					}else{
						$file_name = "logbook-_-" . $file_name;
						$kra_file = $file_name;
					}
					$path = $logbooks . $file_name;
					
					if(move_uploaded_file($file_tmp, $path)){
						array_push($docs, $path);    
					}
					
				}
			}
			
			//$logbook_file = trim($docs[0], './'); 
			//$id_file = trim($docs[1], './');
			//$kra_file = trim($docs[2], './');
			$_SESSION["logbook"] = @$_POST;
			$_SESSION["files"] = @$_FILES;
			if(empty($registration_err) && empty($chasis_err) && empty($make_err)){
				$sql = "INSERT INTO tbl_logbook (registration, chasis, make, model, type, body, fuel, man_year, rating, engine_number, color, reg_date, gross_weight, duty, previous_owners, passengers, tare_weight, tax_class, axels, load_capacity, reg_country, previous_reg, date, id_number, id_file, kra_number, kra_file, logbook_file) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				if($stmt = mysqli_prepare($connection, $sql)){
					mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssss", $param_registration, $param_chasis, $param_make, $param_model, $param_type, $param_body, $param_fuel, $param_man_year, $param_rating, $param_engine_number, $param_color, $param_reg_date, $param_gross_weight, $param_duty, $param_previous_owners, $param_passengers, $param_tare_weight, $param_tax_class, $param_axels, $param_load_capacity, $param_reg_country, $param_previous_reg, $param_date, $param_id_number, $param_id_file, $param_kra_number, $param_kra_file, $param_logbook_file);


					$param_registration = $registration;
					$param_chasis = $chasis;
					$param_make = $make;
					$param_model = $model;
					$param_type = $type;
					$param_body = $body;
					$param_fuel = $fuel;
					$param_man_year = $man_year;
					$param_rating = $rating;
					$param_engine_number = $engine_number;
					$param_color = $color;
					$param_reg_date = $reg_date;
					$param_gross_weight = $gross_weight;
					$param_duty = $duty;
					$param_previous_owners = $previous_owners;
					$param_passengers = $passengers;
					$param_tare_weight = $tare_weight;
					$param_tax_class = $tax_class;
					$param_axels = $axels;
					$param_load_capacity = $load_capacity;
					$param_reg_country = $reg_country;
					$param_previous_reg = $previous_reg;
					$param_date = $date;
					$param_id_number = $id_number;
					$param_id_file = $id_file;
					$param_kra_number = $kra_number;
					$param_kra_file = $kra_file;
					$param_logbook_file = $logbook_file;
					
					if(mysqli_stmt_execute($stmt)){
						// Redirect to login page
						header("location: ./gateway.php");
					} else{
						echo "Something went wrong. Please try again later.";
					}

					// Close statement
					mysqli_stmt_close($stmt);
				}
			}
			mysqli_close($connection);
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
								<img src="img/logo_menu.png" width="145" height="34" alt="Bestours" data-retina="true">
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
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/description_banner.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Motor-Vehicle Details</h1>
				<p>Enter Vehicle details below:</p>
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
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="off" enctype="multipart/form-data">						
									<div class="center">
											<h3>Particulars</h3>
									</div>
									<div class="form-group <?php echo (!empty($registration_err)) ? 'has-error' : ''; ?>">
										<label>Registration</label>
										<input type="text" class="form-control" name="registration" value="<?php echo $registration; ?>" placeholder="<?php echo $registration_err; ?>">

										<span class="help-block"></span>
									</div>

									<div class="form-group <?php echo (!empty($chasis_err)) ? 'has-error' : ''; ?>">
										<label>Chasis/Frame</label>
										<input type="text" class="form-control" name="chasis" value="<?php echo $chasis; ?>" placeholder="<?php echo $chasis_err; ?>">
										<span class="help-block"></span>
									</div>

									<div class="form-group <?php echo (!empty($make_err)) ? 'has-error' : ''; ?>">
										<label>Make</label>
										<input type="text" class="form-control" name="make" value="<?php echo $make; ?>" placeholder="<?php echo $make_err; ?>">
										<span class="help-block"></span>
									</div>

									<div class="form-group <?php echo (!empty($model_err)) ? 'has-error' : ''; ?>">
										<label>Model</label>
										<input type="text" class="form-control" name="model" value="<?php echo $model; ?>" placeholder="<?php echo $model_err; ?>">
										<span class="help-block"></span>
									</div>

									<div class="form-group <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
										<label>Type</label>
										<input type="text" class="form-control" name="type" value="<?php echo $type; ?>" placeholder="<?php echo $type_err; ?>">
										<span class="help-block"></span>
									</div>
									<div class="form-group <?php echo (!empty($body_err)) ? 'has-error' : ''; ?>">
										<label>Body</label>
										<input type="text" class="form-control" name="body" value="<?php echo $body; ?>" placeholder="<?php echo $body_err; ?>">
										<span class="help-block"></span>
									</div>

									<div class="form-group <?php echo (!empty($fuel_err)) ? 'has-error' : ''; ?>">
										<label>Fuel</label>
										<input type="text" class="form-control" name="fuel" value="<?php echo $fuel; ?>" placeholder="<?php echo $fuel_err; ?>">
										<span class="help-block"></span>
									</div>

									<div class="form-group <?php echo (!empty($man_year_err)) ? 'has-error' : ''; ?>">
										<label>Man Year</label>
										<select name="man_year" class="form-control py-1" value="<?php echo $man_year; ?>" placeholder="<?php echo $man_year_err; ?>"> <?php for ($i = date('Y'); $i >= 1900; $i--){echo "<option>$i</option>"; }?></select>
										<span class="help-block"></span>

									</div>

									<div class="form-group <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
										<label>Rating</label>
										<input type="text" class="form-control" name="rating" value="<?php echo $rating; ?>" placeholder="<?php echo $rating_err; ?>">
										<span class="help-block"></span>

									</div>

									<div class="form-group <?php echo (!empty($engine_number_err)) ? 'has-error' : ''; ?>">
										<label>Engine Number</label>
										<input type="text" class="form-control" name="engine_number" value="<?php echo $engine_number; ?>" placeholder="<?php echo $engine_number_err; ?>">
										<span class="help-block"></span>

									</div>

									<div class="form-group <?php echo (!empty($color_err)) ? 'has-error' : ''; ?>">
										<label>Color</label>
										<input type="text" class="form-control" name="color" value="<?php echo $color; ?>" placeholder="<?php echo $color_err; ?>">
										<span class="help-block"></span>

									</div>
									
									<div class="form-group <?php echo (!empty($reg_date_err)) ? 'has-error' : ''; ?>">
										<label>Registration Date</label>
										<input type="date" class="form-control" name="reg_date" value="<?php echo $reg_date; ?>" placeholder="<?php echo $reg_date_err; ?>">
										<span class="help-block"></span>

									</div>

									<div class="form-group <?php echo (!empty($gross_weight_err)) ? 'has-error' : ''; ?>">
										<label>Gross Weight</label>
										<input type="number" class="form-control" name="gross_weight" value="<?php echo $gross_weight; ?>" placeholder="<?php echo $gross_weight_err; ?>">
										<span class="help-block"></span>
									
									</div>

									<div class="form-group <?php echo (!empty($duty_err)) ? 'has-error' : ''; ?>">
										<label>Duty</label>
										<input type="text" class="form-control" name="duty" value="<?php echo $duty; ?>" placeholder="<?php echo $duty_err; ?>">
										<span class="help-block"></span>
									
									</div>

									<div class="form-group <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
										<label>Number Of Previous Owners</label>
										<input type="number" class="form-control" name="previous_owners" value="<?php echo $previous_owners; ?>" placeholder="<?php echo $type_err; ?>">
										<span class="help-block"></span>
									
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
										<div class="form-group <?php echo (!empty($passengers_err)) ? 'has-error' : ''; ?>">
											<label>Passengers</label>
											<input type="number" class="form-control" name="passengers" value="<?php echo $passengers; ?>" placeholder="<?php echo $passengers_err; ?>">
											<span class="help-block"></span>
										</div>

										<div class="form-group <?php echo (!empty($tare_weight_err)) ? 'has-error' : ''; ?>">
											<label>Tare Weight</label>
											<input type="number" class="form-control" name="tare_weight" value="<?php echo $tare_weight; ?>" placeholder="<?php echo $tare_weight_err; ?>">
											<span class="help-block"></span>
										</div>

										<div class="form-group <?php echo (!empty($tax_class_err)) ? 'has-error' : ''; ?>">
											<label>Tax Class</label>
											<input type="text" class="form-control" name="tax_class" value="<?php echo $tax_class; ?>" placeholder="<?php echo $tax_class_err; ?>">
											<span class="help-block"></span>				
										</div>
										
										<div class="form-group <?php echo (!empty($axels_err)) ? 'has-error' : ''; ?>">
											<label>Axels</label>
											<input type="number" class="form-control" name="axels" value="<?php echo $axels; ?>" placeholder="<?php echo $axels_err; ?>">
											<span class="help-block"></span>							
										</div>
										
										<div class="form-group <?php echo (!empty($load_capacity_err)) ? 'has-error' : ''; ?>">
											<label>Load Capaticity(KG)</label>
											<input type="number" class="form-control" name="load_capacity" value="<?php echo $load_capacity; ?>" placeholder="<?php echo $load_capacity_err; ?>">
											<span class="help-block"></span>							
										</div>
										
										<div class="form-group <?php echo (!empty($reg_country_err)) ? 'has-error' : ''; ?>">
											<label>Previous Registration Country</label>
											<input type="text" class="form-control" name="reg_country" value="<?php echo $reg_country; ?>" placeholder="<?php echo $reg_country_err; ?> ">
											<span class="help-block"></span>							
										</div>
										
										<div class="form-group <?php echo (!empty($previous_reg_err)) ? 'has-error' : ''; ?>">
											<label>Previous Registration</label>
											<input type="text" class="form-control" name="previous_reg" value="<?php echo $previous_reg; ?>" placeholder="<?php echo $previous_reg_err; ?>">
											<span class="help-block"></span>							
										</div>
										
										<div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
											<label>Choose Cover Start Date</label>
											<input type="date" class="form-control" name="date" value="<?php echo $date; ?>" min="<?php echo date('Y-m-d'); ?>" placeholder="<?php echo $date_err; ?> ">
											<span class="help-block"></span>
											<script>
												$(function() {
													$( "#datepicker" ).datepicker({ minDate: 0});
												});
											</script>
										</div>
										
										<div class="form-group <?php echo (!empty($id_number_err)) ? 'has-error' : ''; ?>">
											<label>ID Number</label>
											<input type="text" class="form-control" name="id_number" value="<?php echo $id_number; ?>" placeholder="<?php echo $id_number_err; ?>">
											<span class="help-block"></span>
										</div>
										
										<div class="form-group">
											<label>Upload ID </label>
											<input type="file" class="form-control" name="clientFiles[]" required>
											<span class="help-block"></span>
										</div>
										
										<div class="form-group <?php echo (!empty($kra_number_err)) ? 'has-error' : ''; ?>">
											<label>KRA Pin Number</label>
											<input type="text" class="form-control" name="kra_number" value="<?php echo $kra_number; ?>" placeholder="<?php echo $kra_number_err; ?>">
											<span class="help-block"></span>
										</div>
										
										<div class="form-group">
											<label>Upload KRA PIN </label>
											<input type="file" class="form-control" name="clientFiles[]" required>
											<span class="help-block"></span>
										</div>
										
										<div class="form-group ">
											<label>Upload Logbook Copy </label>
											<input type="file" class="form-control" name="clientFiles[]" required>
											<span class="help-block"></span>
										</div>
										
										<div class="form-group">
											<input type="submit" value="Save" class="btn btn-primary btn-lg btn-block">
										</div>
									</div>
								</aside>
								<div class="">
									<input type="submit" value="Issue Cover" class="btn_full">
								</div>
							</div>
						<form>
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
					<!--<form method="" action="assets/newsletter.php" name="" id="newsletter_2">
						<div class="form-group">
							<input name="email_newsletter_2" id="email_newsletter_2" type="email" value="" placeholder="Your email" class="form-control">
						</div>
						<input type="submit" value="Subscribe" class="btn_1" id="submit-newsletter_2">
					</form>-->
				</div>
			</div>
			<!-- End row -->
			<hr>
			<div class="row">
				<div class="col-sm-8">
					
					<span id="copy">Copyright © 2022.JendiePlus Technologies - All rights reserved</span>
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
		<!--<form role="search" id="searchform" method="get">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon-search-6"></i>
			</button>
		</form>-->
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