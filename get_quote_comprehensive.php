<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include "dashboard/db/connect_db.php";
	if(!isset($_SESSION["cover"])) { 
		header("refresh:0;url=./index.php");
	}
	$underwriter = $_SESSION["underwriter"]["Name"];
	$description = $_SESSION["underwriter"]["description"];

	$select = $pdo->prepare("SELECT code FROM tbl_user");
	$select->execute();
	$code = [];
	while ($codes = $select->fetch(PDO::FETCH_ASSOC)){
		array_push($code, trim($codes['code']));
	};
	include "nav/journeyheader.php";
	if(isset($_SESSION['client_details']['vehicleclass']))$vehicleclass=trim($_SESSION['client_details']['vehicleclass']);else$vehicleclass='';
?>

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/get_quote_page.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1 style="color:red;">Get Quote</h1>
				<h1><?php echo $underwriter?></h1>
				<h5 style="color:white;"><?php echo $description?></h5>
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
						<form class="was-validated" action="processer/handle_get_quote.php" method="get">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Client Name</label>
										<input type="text" class="form-control styled" id="name_contact" <?php if(isset($_SESSION['client_details']['name_contact'])) echo 'value='.'"'.$_SESSION['client_details']['name_contact'].'"'?> name="name_contact" placeholder="Full Name" onchange="validate_names(this.id,this.value)" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control styled" id="email" <?php if(isset($_SESSION['client_details']['email'])) echo 'value='.'"'.$_SESSION['client_details']['email'].'"'?> name="email" placeholder="Your Email" onchange="validateEmail()" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Phone Number:</label>
										<input type="text" id="phone_number" <?php if(isset($_SESSION['client_details']['phone_number'])) echo 'value='.'"'.$_SESSION['client_details']['phone_number'].'"'?> name="phone_number" class="form-control styled" placeholder="Phone Number" onchange="validatePhone(this.id,this.value)" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="col-md-6">
										<div class="form-group">
											<label>Choose Vehicle Class:</label>
											<select id="mySelect1"  name="vehicleclass" class="form-control styled" placeholder="Vehicle Class" onchange="myFunction()" required>
												<optgroup label="1. MOTORCYCLE">
													<?php
													$select = $pdo->prepare("SELECT * FROM tbl_vehicleclass where type = 'MOTORCYCLE'");
													$select->execute();
													while($row = $select->fetch(PDO::FETCH_ASSOC)){
														extract($row);
														$row = array_map('trim', $row);
														$class= trim($row['ID']).'. '.trim($row['class']);
													?>
														<option <?php if($class==$vehicleclass) echo 'selected';?>><?php echo $class?></option>
														
													<?php
														}
													?>
												</optgroup>
												<optgroup label="2. TRICYCLE">
													<?php
													$select = $pdo->prepare("SELECT * FROM tbl_vehicleclass where type = 'TRICYCLE'");
													$select->execute();
													while($row = $select->fetch(PDO::FETCH_ASSOC)){
														extract($row);
														$row = array_map('trim', $row);
														$class= trim($row['ID']).'. '.trim($row['class']);
													?>
														<option <?php if($class==$vehicleclass) echo 'selected';?>><?php echo $class?></option>
													<?php
														}
													?>
												</optgroup>
												<optgroup label="3. MOTORVEHICLE">
													<?php
													$select = $pdo->prepare("SELECT * FROM tbl_vehicleclass where type = 'MOTORVEHICLE'");
													$select->execute();
													while($row = $select->fetch(PDO::FETCH_ASSOC)){
														extract($row);
														$row = array_map('trim', $row);
														$class= trim($row['ID']).'. '.trim($row['class']);
													?>
														<option <?php if($class==$vehicleclass) echo 'selected';?>><?php echo $class?></option>
													<?php
													}
													?>
												</optgroup>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Year of Manufacture</label>
											<?php if(isset($_SESSION['client_details']['man_year']))$man_year=trim($_SESSION['client_details']['man_year']);else $man_year='';?>
											<select name="man_year" class="form-control py-1"> 
												<?php for ($i = date('Y'); $i >= 1900; $i--){?>
													<option <?php if($i==$man_year) echo 'selected';?>><?php echo $i;?></option>
												<?php
													}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Vehicle Registration Number:</label>
										<input type="text" class="form-control styled" id="vehicle_reg" <?php if(isset($_SESSION['client_details']['vehicle_reg'])) echo 'value='.'"'.$_SESSION['client_details']['vehicle_reg'].'"'?> name="vehicle_reg" placeholder="Vehicle Registrattion Number" onchange="validate_registration()" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Vehicle make:</label>
										<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
											<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
											<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
										<input type="search" class="form-control styled" id="term" name="term" <?php if(isset($_SESSION['client_details']['vehicle_make'])) echo 'value='.'"'.$_SESSION['client_details']['vehicle_make'].'"'?> placeholder="Vehicle Registrattion Number" onchange="validate_registration()" required>
										<script type="text/javascript">
										$(function() {
											$( "#term" ).autocomplete({
											source: 'dashboard/build/pages/processor/vehicle_search.php',
											});
										});
										</script>									
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="col-md-4">
										<label>Gender</label>
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="male" name="gender" value="M" <?php if(isset($_SESSION['client_details']['gender']) && trim($_SESSION['client_details']['gender']) == 'Male') echo 'checked'?> required>
											<label class="custom-control-label" for="male">Male</label>
										</div>
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="female" name="gender" value="F" <?php if(isset($_SESSION['client_details']['gender']) && trim($_SESSION['client_details']['gender']) == 'Female') echo 'checked'?>  required>
											<label class="custom-control-label" for="female">Female</label>
										</div>
										<div class="custom-control custom-radio mb-3">
											<input type="radio" class="custom-control-input" id="other" name="gender" value="O" <?php if(isset($_SESSION['client_details']['gender']) && trim($_SESSION['client_details']['gender']) == 'Other') echo 'checked'?>required>
											<label class="custom-control-label" for="other">Other</label>
											<div class="invalid-feedback">Select Gender</div>
										</div>									
									</div>
									<div class="col-md-4">
										<label>Have a referal code?</label>
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" value="yes" id="yes" name="agent_code" checked required onchange="validate_referal(this)">
											<label class="custom-control-label" for="yes">Yes</label>
										</div>
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" value="no" id="no" name="agent_code" <?php if(isset($_SESSION['client_details']['agent_code']) && trim($_SESSION['client_details']['agent_code']) == 'no') echo 'checked'?> required onchange="validate_referal(this)">
											<label class="custom-control-label" for="no">No</label>
										</div>
																			
									</div>
									<div class="col-sm-4">
										<label>Agent Code</label>
										<input type="text" class="form-control styled text-center" <?php if(isset($_SESSION['client_details']['referal_code'])) echo 'value='.'"'.$_SESSION['client_details']['referal_code'].'"';?> name="referal_code" id="referal_code" placeholder="Enter refaral code" onchange="validate_referal(this)" required>
										<div class="invalid-feedback"> contact <?php echo $_SESSION["origin"]?>'s owner</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Sum Insured: </label>
										<input type="text" id="sum_insured" <?php if(isset($_SESSION['client_details']['sum_insured'])) echo 'value='.'"'.$_SESSION['client_details']['sum_insured'].'"'?> name="sum_insured" class="form-control styled" placeholder="Sum insured" onchange="validatePhone(this.id,this.value)" required>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<input type="Submit" class="form-control styled btn-danger"/>
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
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
		var x = document.getElementById("mySelect1");
		var text=x.options[x.selectedIndex].text;
		if ((text == "7. commercial Own goods")||(text == "8. General Cartage Lorries,Trucks and Tankers")) {
			document.getElementById("tonnage").innerHTML ='\
			<label>Enter Tonnage (KG)</label>\
			<input type="text" class="form-control styled text-center" id="tonnage" <?php if(isset($_SESSION['client_details']['tonnage'])) echo 'value='.'"'.$_SESSION['client_details']['tonnage'].'"';?> name="tonnage" placeholder="Tonnage (KG)" required>';
			document.getElementById("passangers").innerHTML = "";
			document.getElementById("coveroptional").innerHTML ='';


			// document.getElementById("coveroptional").innerHTML ='<select name="coverperiod" id="coverperiod" class="form-control py-1">\
			// 	<option>1 year</option>\
			// </select>';
		}else{
				document.getElementById("tonnage").innerHTML ="";
		}
		if ((text == "15. PSV - Matatu") || (text == "17. PSV - BUS") || (text == "7. commercial Own goods") || (text == "8. General Cartage Lorries,Trucks and Tankers")){
			if ((text == "7. commercial Own goods") || (text == "8. General Cartage Lorries,Trucks and Tankers")){
				document.getElementById("coveroptional").innerHTML ='<select name="coverperiod" id="coverperiod" class="form-control py-1">\
				<option <?php if(isset($_SESSION['client_details']['coverperiod']) && trim($_SESSION['client_details']['coverperiod']) == '1 year') echo 'selected'?>>1 year</option>\
			</select>';
			}else{
			document.getElementById("passangers").innerHTML ='<label class="text-center">Seating Capacity:</label>\
			<input type="number" class="form-control styled text-center" name="passangers" <?php if(isset($_SESSION['client_details']['passangers'])) echo 'value='.'"'.$_SESSION['client_details']['passangers'].'"';?> placeholder="Enter seating capacity" required>';
			document.getElementById("coveroptional").innerHTML ='<select name="coverperiod" id="coverperiod" class="form-control py-1">\
				<option <?php if(isset($_SESSION['client_details']['coverperiod']) && trim($_SESSION['client_details']['coverperiod']) == '1 week') echo 'selected'?>>1 week</option>\
				<option <?php if(isset($_SESSION['client_details']['coverperiod']) && trim($_SESSION['client_details']['coverperiod']) == '2 weeks') echo 'selected'?>>2 weeks</option>\
				<option <?php if(isset($_SESSION['client_details']['coverperiod']) && trim($_SESSION['client_details']['coverperiod']) == '1 month') echo 'selected'?>>1 month</option>\
				<option <?php if(isset($_SESSION['client_details']['coverperiod']) && trim($_SESSION['client_details']['coverperiod']) == '1 year') echo 'selected'?>>1 year</option>\
			</select>';
			}
			
		}else{
			document.getElementById("passangers").innerHTML ="";
			document.getElementById("coveroptional").innerHTML ='<select name="coverperiod" id="coverperiod" class="form-control py-1">\
				<option <?php if(isset($_SESSION['client_details']['coverperiod']) && trim($_SESSION['client_details']['coverperiod']) == '1 month') echo 'selected'?>>1 month</option>\
				<option <?php if(isset($_SESSION['client_details']['coverperiod']) && trim($_SESSION['client_details']['coverperiod']) == '1 year') echo 'selected'?>>1 year</option>\
			</select>';
		}
		// Get the value of the input field with id="numb"
		

	}
	function validate_referal(name){
		var codes = <?php echo json_encode($code); ?>;
		const referal_code = document.getElementById("referal_code");
		var ira_patt = /[0-9]{5,6}[-][0-9]+[-][0-9]+|[A-Z]{3}[/][0-9]{2}[/][0-9]{5}[/][0-9]{4}|[0-9]{5,6}[-][0-9]+|[0-9]{5,6}/im;
		var result = referal_code.value.match(ira_patt);
		if(result){
			referal_code.value = result;
			if (!codes.includes(referal_code.value)){
				referal_code.value = "";
				referal_code.placeholder='Agent code doesnt exist, recheck or use 31212';

			}
		}else{
			referal_code.value = "";
			referal_code.placeholder='Invalid agent code: Use this format: 00000 or 00000-00';
		}
		if(name.id == "yes"){
			document.getElementById("referal_code").className ="form-control styled text-center";
		}
		if(name.id == "no"){
			document.getElementById("referal_code").className ="form-control styled text-center d-none";
			referal_code.value = "31212";

			// referal_code.value = "31212";
		}
	}
	function validateEmail(){
		const email = document.getElementById("email");
		var ira_patt = /[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/g;
		var result = email.value.match(ira_patt);
		if(result){
			email.value = result;
		}else{
			email.value = "";
			email.placeholder='Invalid email Use this format: donjoe@email.com';
		}
	}
	function validate_registration(){
		const reg_number = document.getElementById("reg_number");
		var ira_patt = /[A-Za-z]{3}[0-9]{3}[A-Za-z]{1}|[A-Za-z]{3}[0-9]{3}|[A-Za-z]{3} [0-9]{3}[A-Za-z]{1}|[A-Za-z]{3} [0-9]{3}/g;
		var result = reg_number.value.match(ira_patt);
		if(result){
			// reg_number.value = result[0];
		}else{
			reg_number.value = "";
			reg_number.placeholder='Invalid Registration Use this format: KAA 000A/KAA 000';
		}
	}
	function validate_names(id,value){
		if(value.split(' ').length <=1){
			document.getElementById(id).value ='';
			document.getElementById(id).placeholder="Enter full names";
		}
	}
	function validatePhone(id,value){
	}
	</script>
	<script type = "text/javascript"> 
	window.onload = function(){   
		myFunction();
		var name = document.getElementById("no");
		
		if(name.checked ==false){
			name = document.getElementById("yes");
		}else{
			name = document.getElementById("no");
		}
		validate_referal(name);
	}
	</script>  
	<?php include "chat/chat.php"?>

</body>

</html>
