<?php
// Include config file
require_once "config/db.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $firstname = $lastname = $companyname = $contactperson = $krapin = $krapincopy = $emailaddress = $phonenumber = $physicaladdress= $idnumber = $idcopy = $iralicense = $iracopy = "";
$username_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = $companyname_err = $contactperson_err = $krapin_err = $krapincopy_err = $emailaddress_err = $phonenumber_err = $physicaladdress_err = $idnumber_err = $idcopy_err = $iralicense_err = $iracopy_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    print_r($_POST);
    // Validate first name
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter first name.";
    } else{
        $firstname = trim($_POST["firstname"]);
    }

    // Validate first name
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter last name.";
    } else{
        $lastname = trim($_POST["lastname"]);
    }

    // Validate first name
    if(empty(trim($_POST["companyname"]))){
        $companyname_err = "Please enter company name.";
    } else{
        $companyname = trim($_POST["companyname"]);
    }

    // Validate first name
    if(empty(trim($_POST["contactperson"]))){
        $contactperson_err = "Please enter conterct person name.";
    } else{
        $contactperson = trim($_POST["contactperson"]);
    }

    // Validate first name
    if(empty(trim($_POST["krapin"]))){
        $krapin_err = "Please enter credential.";
    } else{
        $krapin = trim($_POST["krapin"]);
    }

    // Validate first name
    if(empty(trim($_POST["krapincopy"]))){
        $krapincopy_err = "Please upload kra copy.";
    } else{
        $krapincopy = trim($_POST["krapincopy"]);
    }

    // Validate first name
    if(empty(trim($_POST["emailaddress"]))){
        $emailaddress_err = "Please enter email address.";
    } else{
        $emailaddress = trim($_POST["emailaddress"]);
    }
    
    // Validate first name
    if(empty(trim($_POST["phonenumber"]))){
        $phonenumber_err = "Please enter phone number.";
    } else{
        $phonenumber = trim($_POST["phonenumber"]);
    }

    // Validate first name
    if(empty(trim($_POST["physicaladdress"]))){
        $physicaladdress_err = "Please enter place of residence.";
    } else{
        $physicaladdress = trim($_POST["physicaladdress"]);
    }
    
    // Validate first name
    if(empty(trim($_POST["idnumber"]))){
        $idnumber_err = "Please enter credential.";
    } else{
        $idnumber = trim($_POST["idnumber"]);
    }

    // Validate first name
    if(empty(trim($_POST["idcopy"]))){
        $idcopy_err = "Please upload id copy.";
    } else{
        $idcopy = trim($_POST["idcopy"]);
    }

    // Validate first name
    if(empty(trim($_POST["iralicense"]))){
        $iralicense_err = "Please enter credential.";
    } else{
        $idcopy = trim($_POST["iralicense"]);
    }
    
    // Validate first name
    if(empty(trim($_POST["iracopy"]))){
        $iracopy_err = "Please upload ira license copy.";
    } else{
        $iracopy = trim($_POST["iracopy"]);
    }
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, firstname, lastname, companyname, contactperson, krapin, krapincopy, emailaddress, phonenumber, physicaladdress, idnumber, idcopy, iralicense, iracopy, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $param_username, $param_firstname, $param_lastname, $param_companyname, $param_contactperson, $param_krapin, $param_krapincopy, $param_emailaddress, $param_phonenumber, $param_physicaladdress, $param_idnumber, $param_idcopy, $param_iralicense, $param_iracopy, $param_password, $param_role);
            
            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_username = $username;
            $param_companyname = $companyname;
            $param_contactperson = $contactperson;
            $param_krapin = $krapin;
            $param_krapincopy = $krapincopy;
            $param_emailaddress = $emailaddress;
            $param_phonenumber = $phonenumber;
            $param_physicaladdress = $physicaladdress;
            $param_idnumber = $idnumber;
            $param_idcopy = $idcopy;
            $param_iralicense = $iralicense;
            $param_iracopy = $iracopy;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_role = "default";
            #mysqli_stmt_execute($stmt); 
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
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
								<img src="img/logo_menu.png" alt="Bimaplus" data-retina="true">
							</div>
							<a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
							<ul>
								<li><a href="index.html">Home</a></li>
								
								<li><a href="about.html">About us</a></li>
								<li><a href="services.html">Services</a></li>
								<li><a href="contact.html">Contact us</a></li>
								<li><a href="#">Agent Login/Register</a></li>
								
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
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/login_page.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Register</h1>
				<p>Sign up to access your account.</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper add_bottom_30">
		<div class="divider_border"></div>
		<div class="container">
			
			<div class="row">

				<aside class="col-md-3">
				
				</aside>
				<!--End aside -->

				<div class="col-md-9">
					<h3>Register</h3>
					<p>
						Enter the following details to create you account.
					
					</p>
					<div>
						<div id="message-contact"></div>
							<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
											<label class="h6">First Name</label>
											<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $firstname; ?>"placeholder="Enter first name">
											<span class="help-block"><?php echo $firstname_err; ?></span>
										</div>
										
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
											<label class="h6">Last  Name</label>
											<input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>"placeholder="Enter last name">
											<span class="help-block"><?php echo $lastname_err; ?></span>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
											<label class="h6">User Name</label>
											<input type="text" name="username" class="form-control" value="<?php echo $username; ?>"placeholder="Enter User name">
											<span class="help-block"><?php echo $username_err; ?></span>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group <?php echo (!empty($companyname_err)) ? 'has-error' : ''; ?>">
											<label class="h6">Company Name</label>
											<input type="text" name="companyname" class="form-control" value="<?php echo $companyname; ?>"placeholder="Enter company name">
											<span class="help-block"><?php echo $companyname_err; ?></span>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group <?php echo (!empty($phonenumber_err)) ? 'has-error' : ''; ?>">
											<label class="h6">Phone Number</label>
											<input type="text" name="phonenumber" class="form-control" value="<?php echo $phonenumber; ?>"placeholder="Enter phone number">
											<span class="help-block"><?php echo $phonenumber_err; ?></span>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group <?php echo (!empty($emailaddress_err)) ? 'has-error' : ''; ?>">
											<label class="h6">Email Address</label>
											<input type="text" name="emailaddress" class="form-control" value="<?php echo $emailaddress ; ?>"placeholder="Enter Email address">
											<span class="help-block invalid-tooltip"><?php echo $emailaddress_err; ?></span>
										</div>
									</div>
									
									<div class="col-md-6 col-sm-6">
										<div class="form-group <?php echo (!empty($contactperson_err)) ? 'has-error' : ''; ?>">
											<label class="h6">Contact Person</label>
											<input type="text" name="contactperson" class="form-control" value="<?php echo $contactperson; ?>"placeholder="Enter contact person">
											<span class="help-block"><?php echo $contactperson_err; ?></span>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group <?php echo (!empty($physicaladdress_err)) ? 'has-error' : ''; ?>">
											<label class="h6">Postal and Physical Address</label>
											<input type="text" name="physicaladdress" class="form-control" value="<?php echo $physicaladdress; ?>"placeholder="Enter Address: PO BOX ... Location ...">
											<span class="help-block"><?php echo $physicaladdress_err; ?></span>
										</div>
									</div>
									
												
									<div class="col-md-4 col-sm-4">
										<div class="form-group">
											<label class="h6" class="h6">Individual/Business/Company KRA No </label>
											<input type="text" name="krapin" class="form-control" value="<?php echo $krapin; ?>"placeholder="enter credential">
											<span class="help-block"><?php echo $krapin_err; ?></span>
										</div>
									</div>
									<div class="col-md-4 col-sm-4">
										<div class="form-group">
											<label class="h6">ID/Business/Company reg No</label>
											<input type="text" name="idnumber" class="form-control" value="<?php echo $idnumber; ?>"placeholder="enter credential">
											<span class="help-block"><?php echo $idnumber_err; ?></span>
										</div>
									</div>
									<div class="col-md-4 col-sm-4">
										<div class="form-group">
											<label class="h6">Individual/Business/Company IRA No </label>
											<input type="text" name="iralicense" class="form-control" value="<?php echo $iralicense; ?>"placeholder="enter credential">
											<span class="help-block"><?php echo $iralicense_err; ?></span>
										</div>
									</div>
									

									<div class="col-md-4 col-sm-4">
										<div class="form-group">
											<label class="h6">Upload KRA PIN </label>
											<input class="form-control py-1" name="iracopy" id="iracopy" type="file" value="<?php echo $iracopy; ?>" placeholder="ira copy" />
											<span class="help-block"><?php echo $iracopy_err; ?></span>									
										</div>
									</div>
									<div class="col-md-4 col-sm-4">
										<div class="form-group">
											<label class="h6">Upload ID</label>
											<input class="form-control py-1" name="idcopy" id="idcopy" type="file" value="<?php echo $idcopy; ?>" placeholder="id copy" />
											<span class="help-block"><?php echo $idcopy_err; ?></span>
										</div>
									</div>
									<div class="col-md-4 col-sm-4">
										<div class="form-group">
											<label class="h6">Upload IRA Licence </label>
											<input class="form-control py-1" name="iracopy" id="iracopy" type="file" value="<?php echo $iracopy; ?>" placeholder="ira copy" />
											<span class="help-block"><?php echo $iracopy_err; ?></span>
										</div>
									</div>
									
								
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label class="h6">Password</label>
											<input class="form-control py-4" id="password" name="password" type="password" placeholder="Enter password" value="<?php echo $password; ?>" />
											<span class="help-block"><?php echo $password_err; ?></span>									
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label class="h6">Re-enter Your Password</label>
											<input class="form-control py-4 " id="confirm_password"  name="confirm_password"  type="password" placeholder="Confirm password" value="<?php echo $confirm_password; ?>" />
											<span class="help-block"><?php echo $confirm_password_err; ?></span>									
										</div>
									</div>
									
									<div class="col-md-6">
										
										<p>
											<input type="submit" value="Submit" class="btn_1" id="submit-contact">
											<input type="reset" value="Reset">
										</p>
										<p>Have an account? <a href="login.php">Login</a></p>
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
						<li><a href="#">Login</a>
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
</body>

</html>