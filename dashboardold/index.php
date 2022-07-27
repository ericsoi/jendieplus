<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
	include_once 'db/connect_db.php';
	include_once 'session.php';
}
if(isset($_POST['btn_login'])){
	//0743996757;
	$password = trim($_POST['password']);
    $password = md5($password);
	$username = trim($_POST["username"]);
	$select=$pdo->prepare("SELECT * from tbl_user where (phonenumber='$username' or emailaddress='$username') and password='$password'");
	$select->execute();
	$total_records = $select->rowCount();
	if($total_records > 0){
		$row=$select->fetch(PDO::FETCH_OBJ); 
		if($row->is_active == 0){
			$user=$row->code;
			$message="success";
			header("refresh:2;pending.php?user=".$user);
		}elseif ($row->is_active == 1) {
			$message="success";
			$_SESSION["userid"] = $row->code;
			$name = $row->firstname;

			header("refresh:1;home.php");
		}
	}else{
		$errormsg="error";
	}
	
	// if(isset($_POST["email"])){
	// 	$email=trim($_POST["email"]);
	// 	$select=$pdo->prepare("SELECT * from tbl_user where emailaddress='$email' and password='$password'");
	// }else{
	// 	$phone = trim($_POST["username"]);
	// 	$select=$pdo->prepare("SELECT * from tbl_user where phonenumber='$phone' and password='$password'");
	// }
    // $select->execute();
	// print_r($select->rowCount());
	// if($select->rowCount()){
	// 	$row = $select->fetch(PDO::FETCH_ASSOC);
	// 	// print_r($row);
	// 	if($row['is_active'] == 0){
	// 		header('refresh:2;pending.php?status=pending');

	// 	}
	// 	elseif($row['is_active'] == 1){
	// 		echo "user 1";
	// 	}elseif($row['is_active'] == 2){
	// 		echo "user 1";
	// 	}
		
	// 	$_SESSION['role']=$row['role'];
	// 	$_SESSION['user_id']=$row['user_id'];
	// 	$_SESSION['owner'] = $row['agent'];
	// 	$code = $row['agent_admin'];
	// 	$_SESSION['code'] = $code;
	// 	$select1 = $pdo->prepare("SELECT * from tbl_user where agent_admin='$code'");
	// 	$select1 = $pdo->prepare("SELECT * from tbl_user where agent_admin='$code'");
	// 	$select1->execute();
    // 	$row1 = $select1->fetch(PDO::FETCH_ASSOC);
	// 	$_SESSION["owned_by"] = $row1["firstname"] . " " . $row1["lastname"];
	// 	$_SESSION['username']=$row['username'];
		
    //     $message = 'success';
    //     header('refresh:2;dashboard.php');
	// }else{
	// 	$errormsg = "Username or password incorrect";
	// }

    // // if($row['username']==$username && $row['password']==$password && $row['is_active']==1){
    // //     $_SESSION['user_id']=$row['user_id'];
    // //     $_SESSION['username']=$row['username'];
    // //     $_SESSION['role']=$row['role'];
	// // 	$_SESSION['owner'] = $row['agent'];
	// // 	$_SESSION['code'] = $row['agent_admin'];
	// // 	$code = $row['agent_admin'];
	// // 	$_SESSION['company'] = $row["companyname"];
	// // 	$_SESSION['fullname'] = $row['fullname'];
	// // 	$select1 = $pdo->prepare("SELECT * from tbl_user where agent_admin='$code'");
	// // 	$select1->execute();
    // // 	$row1 = $select1->fetch(PDO::FETCH_ASSOC);
	// // 	$_SESSION["owned_by"] = $row1["firstname"] . " " . $row1["lastname"];
    // //     $message = 'success';
    // //     header('refresh:2;dashboard.php');
    // // }elseif($row['username']==$username && $row['password']==$password && $row['is_active']=="0"){
	// // 	$errormsg = 'Kindly Wait for activation';
	// // }
	// // else {
    // //     $errormsg = 'User Name or Password incorrect';
    // // }
}

?>


<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Get your motor Insurance delivered to your Email or Whatsapp in minutes.">
	<meta name="author" content="JdiePlus Technologies">
	<title>JendiePlus :: Smart INSRANCE Mkononi</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/icon.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/icon.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/icon.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/icon.png">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Satisfy" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="../css/animate.min.css" rel="stylesheet">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
	<link href="../css/responsive.css" rel="stylesheet">
	<link href="../css/menu.css" rel="stylesheet">
	<link href="../css/icon_fonts/css/all_icons.min.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="../css/custom.css" rel="stylesheet">

	<!-- SPECIFIC CSS -->
	<link href="../css/date_time_picker.css" rel="stylesheet">
	<link href="../css/timeline.css" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<title>JendiePlus | Log in</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="plugins/iCheck/square/blue.css">

	<link rel="shortcut icon" href="img/logo1.jpg">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

		<!-- jQuery 3 -->
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- iCheck -->
	<script src="plugins/iCheck/icheck.min.js"></script>
	<!--Sweetalert Plugin --->
	<script src="bower_components/sweetalert/sweetalert.js"></script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div id="header_1" class="layer_slider">
		<header>
			<div id="top_line">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<a href="tel:+524722301062 +254723775289" id="phone_top">+254722301062 +254723775289</a>
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
							<h1><a href="index.php" title="JendiePlus">JendiePlus&amp;Insuance Technology</a></h1>
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
								<img src="img/logo_menu.png" alt="JendiePlus" data-retina="true">
							</div>
							<a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
							<ul>
								<li><a href="../index.php">Home</a></li>
								
								<li><a href="../about.html">About us</a></li>
								<li><a href="../services.html">Services</a></li>
								<li><a href="../contact.html">Contact us</a></li>
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
				<h1>Login</h1>
				<p>Login to your account.</p>
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
					<h3>Login</h3>
					<p>
						Use your credentials to access your account.
					</p>
					<div>
						<div id="message-contact"></div>
						<form method="post" action="#" id="contactform">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Username</label>
										<input type="text" class="form-control" placeholder="Username" name="username" id="username"required onchange="handleCHanhe(this.name, this.id)">
                    					<span class="glyphicon glyphicon-user form-control-feedback"></span>
									</div> 
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
                  					<div class="form-group has-feedback">
                    					<input type="password" class="form-control" placeholder="Password" name="password" required onchange="handleChange(this.value)">
                    					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  					</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<p>
										<input type="submit" value="Submit" class="btn_1" name="btn_login" id="submit-contact">
										<input type="input" class="btn-check" name="options-outlined" id="success-outlined" autocomplete="off" onclick="confirmPasssword()">
										<label class="btn btn-outline-success" for="success-outlined">Show Password</label>
										<input type="reset" class="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off">
										<label class="btn btn-outline-danger" for="danger-outlined">Reset Inputs</label>
									</p>
									<p>Forgot Password? <a href="reset_pass.php">Reset Password</a></p>
									<p>Don't have an account? <a href="register.php">Register</a></p>
								</div>
							</div>
							<?php
								if(!empty($message)){
								echo'<script type="text/javascript">
									jQuery(function validation(){
									swal("Login Success", "Welcome '.$name.'", "success", {
									button: "Continue",
										});
									});
									</script>';
									}else{}
								if(empty($errormsg)){
								}else{
								echo'<script type="text/javascript">
									jQuery(function validation(){
									swal("Login Fail", "'.$errormsg.'", "error", {
									button: "Continue",
										});
									});
								</script>';
								}
								if (isset($_GET["status"])){
									if($_GET["status"] == "success"){
										echo'<script type="text/javascript">
											jQuery(function validation(){
											swal("Registration Success", "Use your phone or email to login", "success", {
											button: "Continue",
											});
										});
									</script>';
									}
								}
										#header ("Location: index.php"); 
								// 	}else if($_GET["status"] =="duplicate"){
								// 			echo'<script type="text/javascript">
								// 				jQuery(function validation(){
								// 				swal("Registration Failure", "User already exists", "error", {
								// 				button: "Continue",
								// 				});
								// 			});
								// 		</script>';
								// 		#header ("Location: register.php"); 
								// 	}else if($_GET["status"] =="error"){
								// 			echo'<script type="text/javascript">
								// 				jQuery(function validation(){
								// 				swal("Registration Failure", "kindly try again latter", "error", {
								// 				button: "Continue",
								// 				});
								// 			});
								// 		</script>';
								// 		header ("Location: register.php"); 
								// 	}
									
								
							?>
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
					<a href="tel:+254722301062 +254723775289" id="phone">+254722301062 +254723775289/a>
					<a href="mailto:info@jendieplus.co.ke" id="email_footer">info@jendieplus.co.ke</a>
				</div>
				<div class="col-md-2 col-sm-3">
					<h3>Quick Links</h3>
					<ul>
						<li><a href="about.html">About us</a>
						</li>
						<li><a href="faq.html">FAQ</a>
						</li>
						<li><a href="login.php">Login</a>
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
					
					<span id="copy">Copyright 2022.All rights reserved</span>
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
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script>
	// function handleCHanhe(name, id){
	// 	console.log(name, id);
	// 	console.log(name.indexOf("@"));
	// 	if(name.indexOf("@") == -1){
	// 		document.getElementById(id).setAttribute("name","email");
	// 	}
	// 	console.log(name, id);
	// }
	function handleChange(value){
		var password = document.getElementById("password").value;
		if(value !== password){
			console.log("error");
			document.getElementById("password").value = "";
			document.getElementById("confirmpassword").value = "";
			document.getElementById("password").placeholder = "Password Didnt Match";
			document.getElementById("confirmpassword").placeholder = "Password Didnt Match";

		}
	}
</script>
</body>
</html>
