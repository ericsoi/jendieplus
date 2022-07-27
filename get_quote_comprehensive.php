<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
		#print_r($_SESSION);
	}
	include "dashboard/db/connect_db.php";
	if (isset($_SESSION['cover'])){
		unset($_SESSION['cover']);
	}
	if (isset($_GET["cover"])){
		$_SESSION["cover"] = $_GET;
	}	
	if(!isset($_SESSION["underwriter"])) { 
	
		header("refresh:0;url=./index.php");
	}else{
		$underwriter = $_SESSION["underwriter"]["Name"];
		$description = $_SESSION["underwriter"]["description"];
		if(isset($_SESSION["product"])){
			unset ($_SESSION['product']);
		}
	}
	include "nav/journeyheader.php";	
?>
	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/get_quote_page.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1 style="color:red;">Get Quote</h1>
				<h1><?echo $underwriter?></h1>
				<h5 style="color:white;"><?echo $_SESSION["description"]?></h5>
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
						<form method="get" action="detail-page.php">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Client Name</label>
										<input type="text" class="form-control styled" id="name_contact" name="name_contact" placeholder="Full Name" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control styled" id="email" name="email" placeholder="Client Email" required onchange="validateEmail()">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Phone Number:</label>
										<input type="text" id="_phone_contact" name="phone_number" class="form-control styled" placeholder="Phone Number" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Choose Vehicle Class:</label>
										<select id="mySelect1" name="vehicleclass" class="form-control styled" placeholder="Vehicle Class" onchange="myFunction()" required>
										<optgroup label="1. MOTORCYCLE">
											<?php
											$select = $pdo->prepare("SELECT * FROM tbl_vehicleclass where type = 'MOTORCYCLE'");
											$select->execute();
											while($row = $select->fetch(PDO::FETCH_ASSOC)){
												extract($row);
												$row = array_map('trim', $row);
											?>
												<option><?php echo $row["ID"].".  ".$row["class"] ?></option>
												
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
											?>  
												<option><?php echo $row["ID"].".  ".$row["class"] ?></option>
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

											?>
												<option><?php echo $row["ID"].".  ".$row["class"] ?></option>
											<?php
											}
											?>
										</optgroup>
										<!-- <?php 	
											$select = $pdo->prepare("SELECT * FROM tbl_vehicleclass");
											$select->execute();
											while($row = $select->fetch(PDO::FETCH_ASSOC)){
												extract($row);
												?>
													<option value="<?php echo $row["type"] . ' ' . $row["class"];?>"><?php echo $row["type"] . ": " . $row["class"];?></option> 
												<?php 
													}
												?> -->
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Vehicle Registration Number:</label>
										<input type="text" class="form-control styled" id="reg_number" name="vehicle_reg" placeholder="Vehicle Registration Number" onchange="validate_registration()" required>
									</div>
								</div>
								 
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Sum Insured:</label>
										<input type="number" class="form-control styled" id="sum_insured" name="sum_insured" placeholder="Sum Insured" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Year of Manufacture:</label>
										<select name="yom" class="form-control py-1"> <?php for ($i = date('Y'); $i >= 1900; $i--){echo "<option>$i</option>"; }?></select>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Vehicle Make:</label>
										<input type="text" class="form-control styled" id="vehicle_make" name="vehicle_make" placeholder="Make of your vehicle" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Choose Cover Period:</label>
										<select name="coverperiod" id="coverperiod" class="form-control py-1">
											<option>1 year</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label class="styled text-center">Have a Agent code?:</label>
									<input type="text" class="form-control styled text-center" name="referal_code" id="referal_code" placeholder="Enter refaral code" onchange="validate_referal()">
								</div>
							</div>
							<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<div id="tonnage">
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<label>Confirm Submission:</label>
										<input type="Submit" class="form-control styled btn-danger"/>
									</div>
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
	<?php include "nav/footer.php"?>;													
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
	<script type="text/javascript">
    if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
	</script>
	<script>
		function myFunction() {
			var x = document.getElementById("mySelect1");
			var text=x.options[x.selectedIndex].text;
			console.log(text);
			if ((text == "MOTORVEHICLE: commercial Own goods")||(text == "MOTORVEHICLE: General Cartage Lorries,Trucks and Tankers")) {
				document.getElementById("tonnage").innerHTML ='\
				<label>Enter Tonnage</label>\
				<input type="number" class="form-control styled text-center" id="tonnage" name="tonnage" placeholder="Tonnage" required>';
				document.getElementById("passangers").innerHTML = "";
			}else{
					document.getElementById("tonnage").innerHTML ="";
			}
			// if ((text == "MOTORVEHICLE: PSV - Matatu") || (text == "MOTORVEHICLE: PSV - BUS") || (text == "MOTORVEHICLE: commercial Own goods") || (text == " MOTORVEHICLE: General Cartage Lorries,Trucks and Tankers")){
			// 	if ((text == "MOTORVEHICLE: commercial Own goods") || (text == " MOTORVEHICLE: General Cartage Lorries,Trucks and Tankers")){
			// 		document.getElementById("coveroptional").innerHTML ='<select name="coverperiod" id="coverperiod" class="form-control py-1">\
			// 		<option>1 month</option>\
			// 		<option>1 year</option>\
			// 	</select>';
			// 	}else{
			// 	document.getElementById("passangers").innerHTML ='<label class="text-center">Seating Capacity:</label>\
			// 	<input type="number" class="form-control styled text-center" name="passangers" placeholder="Enter seating capacity" required>';
			// 	document.getElementById("coveroptional").innerHTML ='<select name="coverperiod" id="coverperiod" class="form-control py-1">\
			// 		<option>1 week</option>\
			// 		<option>2 weeks</option>\
			// 		<option>1 month</option>\
			// 		<option>1 year</option>\
			// 	</select>';
			// 	}
				
			// }else{
			// 	document.getElementById("passangers").innerHTML ="";
			// 	document.getElementById("coveroptional").innerHTML ='<select name="coverperiod" id="coverperiod" class="form-control py-1">\
			// 		<option>1 month</option>\
			// 		<option>1 year</option>\
			// 	</select>';
			// }
			// Get the value of the input field with id="numb"
			

		}
		function validate_referal(){
			const referal_code = document.getElementById("referal_code");
			console.log(referal_code.value);
			var ira_patt = /[0-9]{5,6}[-][0-9]+[-][0-9]+|[A-Z]{3}[/][0-9]{2}[/][0-9]{5}[/][0-9]{4}|[0-9]{5,6}[-][0-9]+|[0-9]{5,6}/im;
			var result = referal_code.value.match(ira_patt);
			if(result){
				referal_code.value = result;
				console.log(result);
			}else{
				referal_code.value = " ";
				referal_code.placeholder='Invalid Referal code: Use this format: IRA00';
			}
		}
		function validateEmail(){
			const email = document.getElementById("email");
			console.log(email.value);
			var ira_patt = /[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/g;
			var result = email.value.match(ira_patt);
			if(result){
				email.value = result;
				console.log(result);
			}else{
				email.value = "";
				email.placeholder='Invalid email Use this format: donjoe@email.com';
			}
		}
		function validate_registration(){
			const reg_number = document.getElementById("reg_number");
			console.log(reg_number.value);
			var ira_patt = /[A-Za-z]{3}[0-9]{3}[A-Za-z]{1}|[A-Za-z]{3}[0-9]{3}|[A-Za-z]{3} [0-9]{3}[A-Za-z]{1}|[A-Za-z]{3} [0-9]{3}/g;
			var result = reg_number.value.match(ira_patt);
			if(result){
				reg_number.value = result;
				console.log(result);
			}else{
				reg_number.value = "";
				reg_number.placeholder='Invalid Registration Use this format: KAA 000A/KAA 000';
			}
		}
	</script>
</body>

</html>