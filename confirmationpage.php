<?php 
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
		include "dashboard/db/connect_db.php";
	}
	if(isset($_SESSION['logbook'])){
		unset($_SESSION['logbook']);
	}
    if(isset($_POST)){
		$_SESSION["logbook"] = $_POST;
	}if(!isset($_SESSION["underwriter"])) { 
		header("refresh:0;url=./index.php");
	}
	// else{
	// 	include "dashboard/session.php";
	// }
	$owner = $_SESSION["client_details"]["referal_code"];
	$select = $pdo->prepare("SELECT * FROM tbl_user where agency = '$owner'");
	$select->execute();
	$row = $select->fetch(PDO::FETCH_ASSOC);
	$intermediary_name = $row["companyname"];
	$intermediary_ira = $row["iralicense"];
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
				$_SESSION["client_files"]["id"] = $logbooks . $file_name;
			}elseif($key == 1){
				$id_file = $file_name;
				$file_name = "kra-". bin2hex(random_bytes(4)) . "-" . $file_name;
				$_SESSION["client_files"]["kra"] = $logbooks . $file_name;
			}else{
				$kra_file = $file_name;
				$file_name = "logbook-" . bin2hex(random_bytes(4)) . "-" . $file_name;
				$_SESSION["client_files"]["logbook"] = $logbooks . $file_name;
			}
			$path = $logbooks . $file_name;
			if(move_uploaded_file($file_tmp, $path)){
				array_push($docs, $path);    
			}
		}
			
	}
	include "nav/journeyheader.php";
?>

		<!-- End Header -->
	</div>
	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/underwriter_page.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Confirmation page</h1>
				
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
					<div>
						<div id="message-contact"></div>
						<form method="post" action="gateway.php" id="contactform">
							<div class="row">
								<div class="col-md-4 col-sm-4">
									<label><b>Client Details</b></label>
									<div class="form-group">
										<label>First Name</label>
										<input type="text" class="form-control styled" id="firstname" value="<?php echo $_SESSION['client_details']['name_contact']?>" name="firstname" placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" class="form-control styled" id="lastname" value="<?php echo $_SESSION['client_details']['name_contact']?>" name="lastname"  placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>ID Number</label>
										<input type="text" class="form-control styled" id="idnumber" value="<?php echo $_SESSION['logbook']['id_number']?>" name="idnumber" placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>KRA PIN</label>
										<input type="text" class="form-control styled" id="kra" value="<?php echo $_SESSION['logbook']['kra_number']?>" name="kra" placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Phone Number</label>
										<input type="text" class="form-control styled" id="phonenumber" value="<?php echo $_SESSION['client_details']['phone_number']?>" name="phonenumber" placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Email Address</label>
										<input type="text" class="form-control styled" id="emailaddress" value="<?php echo $_SESSION['client_details']['email']?>" name="emailaddress"  placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Occupation</label>
										<input type="text" class="form-control styled" id="occupation" placeholder="Enter Occupation" name="occupation" required>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<label><b>Vehicle Details</b></label>
									<div class="form-group">
										<label>Registration Number</label>
										<input type="text" class="form-control styled" id="registrationnumber" value="<?php echo $_SESSION['logbook']['registration']?>" name="registrationnumber"  placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Chassis/Frame</label>
										<input type="text" class="form-control styled" id="chasis" value="<?php echo $_SESSION['logbook']['chasis']?>" name="chasis" laceholder="Full Name">
									</div>
									<div class="form-group">
										<label>Engine Number</label>
										<input type="text" class="form-control styled" id="engeennumber" value="<?php echo $_SESSION['logbook']['engine_number']?>" name="engeennumber" placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Man Year</label>
										<input type="text" class="form-control styled" id="manyear" value="<?php echo $_SESSION['logbook']['man_year']?>" name="manyear"  placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Load Capacity</label>
										<input type="text" class="form-control styled" id="loadcapacity" value="<?php echo $_SESSION['logbook']['load_capacity']?>" name="loadcapacity" placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Seating Capacity</label>
										<input type="text" class="form-control styled" id="seatingcapacity" value="<?php echo $_SESSION['logbook']['passengers']?>" name="seatingcapacity"  placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Tax class</label>
										<input type="text" class="form-control styled" id="taxclass" value="<?php echo $_SESSION['logbook']['tax_class']?>" name="taxclass" placeholder="Full Name">
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<label><b>Payment</b></label>
									<div class="form-group">
										<label>Premium Applicable</label>
										<input type="text" class="form-control styled" id="grosspremium" value="<?php echo $_SESSION['grosspremium']?>" name="grosspremium" placeholder="Full Name">
									</div>
									<label>Payment Options</label>
									<div class="input-group input-group-default mb-3">
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="payments" id="inlineRadio1" value="option1">
											<label class="form-check-label" for="inlineRadio1">Mpesa</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="payments" id="inlineRadio2" value="option2" disabled>
											<label class="form-check-label" for="inlineRadio2">IPF</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="payments" id="inlineRadio3" value="option3" disabled>
											<label class="form-check-label" for="inlineRadio3">Visa </label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="payments" id="inlineRadio3" value="option4" disabled>
											<label class="form-check-label" for="inlineRadio3">Cripto </label>
										</div>
									</div>
									
									<div class="form-group">
										<label>Agency Name</label>
										<input type="text" class="form-control styled" id="agencyname" value="<?php echo $intermediary_name?>" name="agencyname" placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Agency IRA</label>
										<input type="text" class="form-control styled" id="ira" value="<?php echo	$intermediary_ira?>" name="ira" placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Underwriter</label>
										<input type="text" class="form-control styled" id="underwriter" value="<?php echo $_SESSION['underwriter']['Name']?>" name="underwriter" placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Cover Period</label>
										<input type="text" class="form-control styled" id="coverperiod" value="<?php echo $_SESSION['client_details']["coverperiod"]?>" name="coverperiod" placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Cover Start Date</label>
										<input type="text" class="form-control styled" id="coverstartdate" value="<?php echo $_SESSION['logbook']['date']?>" name="coverstartdate" placeholder="Full Name">
									</div>
									
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<!-- <div class="form-group">
										<label>Premium Applicable</label>
										<input type="text" class="form-control styled" id="d" value="<?php echo ""?>" name="e" placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Premium Applicable</label>
										<input type="text" class="form-control styled" id="dd"  value="<?php echo ""?>" name="ee" placeholder="Full Name">
									</div>
									<div class="form-group">
										<label>Premium Applicable</label>
										<input type="text" class="form-control styled" id="ddd"  value="<?php echo ""?>" name="eee" placeholder="Full Name">
									</div> -->
									<p>
										<input type="submit" value="Submit" class="btn_1" id="submit-contact">
									</p>
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
	<?php include "nav/footer.php";?>
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