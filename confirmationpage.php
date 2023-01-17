<?php 
	@session_start();
	include "dashboard/db/connect_db.php";
	include "nav/journeyheader.php";
	if(isset($_GET["status"])){
		$status=$_GET["status"];
		echo "<script>alert('$status')</script>";	
	}
	
?>

	<!-- End Header -->
	</div>
	<!-- End Header 1-->
	<div id="loader">
		<div class="loading-animation"></div>
		<p id="loading-text">Loading...</p>
	</div>
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
						<form method="get" action="processer/handle_confirmationpage.php" id="contactform">
							<div class="row">
								<div class="col-md-4 col-sm-4">
									<label><b>Client Details</b></label>
									<div class="form-group">
										<label>First Name</label>
										<input type="text" class="form-control styled" id="firstname" value="<?php echo $_SESSION['firstname']?>" name="firstname" placeholder="First Name">
									</div>
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" class="form-control styled" id="lastname" value="<?php echo $_SESSION['lastname']?>" name="lastname"  placeholder="Last Name">
									</div>
									<div class="form-group">
										<label>ID Number</label>
										<input type="text" class="form-control styled" id="idnumber" value="<?php echo $_SESSION['logbook']['id_number']?>" name="idnumber" placeholder="Id Number">
									</div>
									<div class="form-group">
										<label>KRA PIN</label>
										<input type="text" class="form-control styled" id="kra" value="<?php echo $_SESSION['logbook']['kra_number']?>" name="kra" placeholder="Kra Pin">
									</div>
									<div class="form-group">
										<label>Phone Number</label>
										<input type="text" class="form-control styled" id="phonenumber" value="<?php echo $_SESSION['client_details']['phone_number']?>" name="phonenumber" placeholder="Phone Number">
									</div>
									<div class="form-group">
										<label>Email Address</label>
										<input type="text" class="form-control styled" id="emailaddress" value="<?php echo $_SESSION['client_details']['email']?>" name="emailaddress"  placeholder="Email Address">
									</div>
									<div class="form-group">
										<label>Postal Address</label>
										<input type="text" class="form-control styled" id="postaladdress" placeholder="Enter Postal Address" name="postaladdress" required>
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
										<input type="text" class="form-control styled" id="registrationnumber" value="<?php echo $_SESSION['logbook']['registration']?>" name="registrationnumber"  placeholder="Registration Number">
									</div>
									<div class="form-group">
										<label>Chassis/Frame</label>
										<input type="text" class="form-control styled" id="chasis" value="<?php echo $_SESSION['logbook']['chasis']?>" name="chasis" laceholder="Chasis">
									</div>
									<div class="form-group">
										<label>Engine Number</label>
										<input type="text" class="form-control styled" id="engeennumber" value="<?php echo $_SESSION['logbook']['engine_number']?>" name="engeennumber" placeholder="Engeen Number">
									</div>
									<div class="form-group">
										<label>Man Year</label>
										<input type="text" class="form-control styled" id="manyear" value="<?php echo $_SESSION['logbook']['man_year']?>" name="manyear"  placeholder="Year of Manufacture">
									</div>
									<div class="form-group">
										<label>Load Capacity</label>
										<input type="text" class="form-control styled" id="loadcapacity" value="<?php echo $_SESSION['logbook']['load_capacity']?>" name="loadcapacity" placeholder="Load Capacity">
									</div>
									<div class="form-group">
										<label>Seating Capacity</label>
										<input type="text" class="form-control styled" id="seatingcapacity" value="<?php echo $_SESSION['logbook']['passengers']?>" name="seatingcapacity"  placeholder="Seating Capacity">
									</div>
									<div class="form-group">
										<label>Tax class</label>
										<input type="text" class="form-control styled" id="taxclass" value="<?php echo $_SESSION['logbook']['tax_class']?>" name="taxclass" placeholder="Tax Calss">
									</div>
									<div class="form-group">
										<label>Postal Code</label>
										<input type="text" class="form-control styled" id="postal_code" placeholder="Enter Postal Code" name="postal_code" required>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<label><b>Payment</b></label>
									<div class="form-group">
										<label>Premium Applicable</label>
										<input type="text" class="form-control styled" id="grosspremium" value="<?php echo $_SESSION['grosspremium']?>" name="grosspremium" placeholder="Gross Premium" readonly>
									</div>
									<label>Payment Options</label>
									<div class="input-group input-group-default mb-3">
										<div class="form-check form-check-inline form-switch">
											<input class="form-check-input" type="radio" name="payments" id="inlineRadio1" value="mpesa" required onchange="credit(this)">
											<label class="form-check-label" for="inlineRadio1">Mpesa</label>
										</div>
										<div class="form-check form-check-inline form-switch">
											<input class="form-check-input" type="radio" name="payments" id="inlineRadio2" value="credit" required onchange="credit(this)">
											<label class="form-check-label" for="inlineRadio2">Credit </label>
										</div>
										
									</div>
									<div class="form-group" id="instalments">
										<label>Choose Number of Instalments</label>
										<select id="installments" name="installments" class="form-control styled"  required>
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
											<option>6</option>
											<option>7</option>
											<option>8</option>
											<option>9</option>
											<option>10</option>
											<option>11</option>
											<option>12</option>
										</select>
									</div>
									<div class="form-group">
										<label>Agency Name</label>
										<input type="text" class="form-control styled" id="agencyname" value="<?php echo $_SESSION["intermediary_name"]?>" name="agencyname" placeholder="Company Name" readonly>
									</div>
									<div class="form-group">
										<label>Agency IRA</label>
										<input type="text" class="form-control styled" id="ira" value="<?php echo	$_SESSION["intermediary_ira"]?>" name="ira" placeholder="Company IRA" readonly>
									</div>
									<div class="form-group">
										<label>Underwriter</label>
										<input type="text" class="form-control styled" id="underwriter" value="<?php echo $_SESSION['underwriter']['Name']?>" name="underwriter" placeholder="Underwriter" readonly>
									</div>
									<div class="form-group">
										<label>Cover Period</label>
										<input type="text" class="form-control styled" id="coverperiod" value="<?php echo $_SESSION['client_details']["coverperiod"]?>" name="coverperiod" placeholder="Cover Period" readonly>
									</div>
									<div class="form-group">
										<label>Cover Start Date</label>
										<input type="text" class="form-control styled" id="coverstartdate" value="<?php echo $_SESSION['logbook']['date']?>" name="coverstartdate" placeholder="Cover Start Date" readonly>
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
										<input type="submit" value="Submit" class="btn_1" id="submit">
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
	</script>
		<script>
		// Get the submit button
		var submitButton = document.getElementById("submit");
		// Add a click event listener to the submit button
			submitButton.addEventListener("click", function(event) {
			// Show the loader
			document.getElementById("loader").style.display = "block";
			document.getElementById("loading-text").innerHTML = "Processing....";
		});
	</script>
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
	<script>
		function credit(name){
			console.log(name.id);
			if(name.id == "inlineRadio1"){
				document.getElementById("instalments").className ="form-group";
			}
			if(name.id == "inlineRadio2"){
				document.getElementById("instalments").className ="form-group d-none";
			}
		}
			
	</script>
	<?php include "chat/chat.php"?>
</body>

</html>