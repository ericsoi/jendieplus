<?php 
	@session_start();

	if(!isset($_SESSION["client_details"])) { 
		header("refresh:0;url=./index.php");
	}else{
		include "dashboard/db/connect_db.php";
		// $registration=$_SESSION['client_details']['vehicle_reg'];$make=$_SESSION['client_details']['vehicle_make'];$yom=$_SESSION['client_details']['yom'];
	}
	include "nav/journeyheader.php";
	// print_r($_SESSION);
  ?>

	<!-- End Header 1-->
	<div id="loader">
		<div class="loading-animation"></div>
		<p id="loading-text">Loading...</p>
	</div>

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/description_banner.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Automobile Details</h1>
				<p>Enter Your Vehicle/Motorcycle details below:</p>
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
								<form class="was-validated" method="post" action="processer/handle_quote2.php" autocomplete="off" enctype="multipart/form-data">
										
										<div class="center">
											<h3>Particulars</h3>
										</div>
										<div class="form-group">
											<label>Registration</label>
											<input type="text" class="form-control" name="registration" id = "registration" value="<?php echo $_SESSION["client_details"]["vehicle_reg"]?>" placeholder="enter vehicle registration number" onchange="validate_registration()" readonly>
										</div>
										<div class="form-group">
											<label>Chasis/Frame</label>
											<input type="text" class="form-control" name="chasis"  <?php if(isset($_SESSION['logbook']['chasis'])) echo 'value='.'"'.$_SESSION['logbook']['chasis'].'"'?> required placeholder="Chasis/Frame">
										</div>
										<div class="form-group">
											<label>Make</label>
											<input type="text" class="form-control" name="make" <?php if(isset($_SESSION['client_details']['vehicle_make'])) echo 'value='.'"'.$_SESSION['client_details']['vehicle_make'].'"'; echo 'readonly'; if(isset($_SESSION['logbook']['make'])) echo 'value='.'"'.$_SESSION['logbook']['make'].'"'?> required placeholder="Make">
										</div>
										<div class="form-group">
											<label>Model</label>
											<input type="text" class="form-control" name="model" <?php if(isset($_SESSION['logbook']['model'])) echo 'value='.'"'.$_SESSION['logbook']['model'].'"'?> required placeholder="Model">
										</div>
										<div class="form-group">
											<label>Type</label>
											<input type="text" class="form-control" name="type" <?php if(isset($_SESSION['logbook']['type'])) echo 'value='.'"'.$_SESSION['logbook']['type'].'"'?> required placeholder="Type">
										</div>
										<div class="form-group">
											<label>Body</label>
											<input type="text" class="form-control" name="body" <?php if(isset($_SESSION['logbook']['body'])) echo 'value='.'"'.$_SESSION['logbook']['body'].'"'?> required placeholder="Body">
										</div>
										<div class="form-group">
											<label>Fuel</label>
											<input type="text" class="form-control" name="fuel" <?php if(isset($_SESSION['logbook']['fuel'])) echo 'value='.'"'.$_SESSION['logbook']['fuel'].'"'?> required placeholder="Fuel">
										</div>
										<div class="form-group">
											<label>Man Year</label>
											<?php if(isset($_SESSION['client_details']['man_year'])){
														$man_year=trim($_SESSION['client_details']['man_year']);
													}elseif(isset($_SESSION['logbook']['man_year'])){
														$man_year=trim($_SESSION['logbook']['man_year']);
													}else{
														$man_year='';
													}
											?>
											
											<select name="man_year" class="form-control py-1" <?php if(isset($_SESSION['client_details']['man_year'])) echo 'readonly'?>> 
												<?php for ($i = date('Y'); $i >= 1900; $i--){?>
													<option <?php echo "value='$man_year'"; if($i==$man_year) echo 'selected';?>><?php echo $i;?></option>
												<?php
													}
												?>
											</select>
											
										</div>
										<div class="form-group">
											<label>Rating</label>
											<input type="text" class="form-control" name="rating" <?php if(isset($_SESSION['logbook']['rating'])) echo 'value='.'"'.$_SESSION['logbook']['rating'].'"'?> required placeholder="Rating">
										</div>
										<div class="form-group">
											<label>Engine Number</label>
											<input type="text" class="form-control" name="engine_number" <?php if(isset($_SESSION['logbook']['engine_number'])) echo 'value='.'"'.$_SESSION['logbook']['engine_number'].'"'?> required placeholder="Engine Number">
										</div>
										<div class="form-group">
											<label>Color</label>
											<input type="text" class="form-control" name="color" <?php if(isset($_SESSION['logbook']['color'])) echo 'value='.'"'.$_SESSION['logbook']['color'].'"'?> required placeholder="Color">
										</div>
										<div class="form-group">
											<label>Registration Date</label>
											<input type="date" class="form-control" name="reg_date" <?php if(isset($_SESSION['logbook']['reg_date'])) echo 'value='.'"'.$_SESSION['logbook']['reg_date'].'"'?>>
										</div>
										<div class="form-group">
											<label>Gross Weight</label>
											<input type="number" class="form-control" name="gross_weight" <?php if(isset($_SESSION['logbook']['gross_weight'])) echo 'value='.'"'.$_SESSION['logbook']['gross_weight'].'"'?> required placeholder="Gross Weight">
										</div>
										<div class="form-group">
											<label>Duty</label>
											<?php if(isset($_SESSION['logbook']['duty']))$duty=trim($_SESSION['logbook']['duty']);else $duty='';?>
											<select id="duty" name="duty" class="form-control styled" placeholder="Vehicle Class" required>
												<option value="paid" <?php if($duty=="paid") echo "selected"?>>Paid</option>
												<option value="unpaid" <?php if($duty=="unpaid") echo "selected"?> >Unpaid</option>
											</select>
										</div>
										<div class="form-group">
											<label>Number Of Previous Owners</label>
											<input type="number" class="form-control" name="previous_owners" <?php if(isset($_SESSION['logbook']['previous_owners'])) echo 'value='.'"'.$_SESSION['logbook']['previous_owners'].'"'?> required placeholder="Number Of Previous Owners">
										</div>
											</div>
											<!-- End col -->

											
											<!-- End col -->
										</div>
										<!-- End row -->

										<hr>

							
					
									</div>
									<!-- End Col -->

									<aside class="col-md-6 was-validated">
			
						
									<div class="center">
										<h3>Particulars</h3>
									</div>
									<div class="form-group">
										<label>Passengers</label>
										<input type="number" class="form-control" name="passengers" <?php if(isset($_SESSION['client_details']['passangers'])) {echo 'value='.'"'.$_SESSION['client_details']['passangers'].'"'; echo "readonly";} elseif(isset($_SESSION['logbook']['passengers'])) {echo 'value='.'"'.$_SESSION['logbook']['passengers'].'"';}?> required placeholder="Passengers">
									</div>
									<div class="form-group">
										<label>Tare Weight</label>
										<input type="number" class="form-control" name="tare_weight" <?php if(isset($_SESSION['logbook']['tare_weight'])) echo 'value='.'"'.$_SESSION['logbook']['tare_weight'].'"'?> required placeholder="Tare Weight">
									</div>
									<div class="form-group">
										<label>Tax Class</label>
										<input type="text" class="form-control" name="tax_class" <?php if(isset($_SESSION['logbook']['tax_class'])) echo 'value='.'"'.$_SESSION['logbook']['tax_class'].'"'?> required placeholder="Tax Class">
									</div>
									<div class="form-group">
										<label>Axels</label>
										<input type="number" class="form-control" name="axels" <?php if(isset($_SESSION['logbook']['axels'])) echo 'value='.'"'.$_SESSION['logbook']['axels'].'"'?> required placeholder="Axels">
									</div>
									<div class="form-group">
										<label>Load Capaticity(KG)</label>
										<input type="number" class="form-control" name="load_capacity" <?php if (isset($_SESSION["client_details"]["tonnage"])) {echo 'value='.'"'.$_SESSION['client_details']['tonnage'].'"'; echo "readonly";} elseif(isset($_SESSION['logbook']['load_capacity'])){echo 'value='.'"'.$_SESSION['logbook']['load_capacity'].'"';}?> required placeholder="Load Capaticity(KG)">
									</div>
									<div class="form-group">
										<label>Previous Registration Country</label>
										<input type="text" class="form-control" name="reg_country" <?php if(isset($_SESSION['logbook']['reg_country'])) echo 'value='.'"'.$_SESSION['logbook']['reg_country'].'"'?> required placeholder="Previous Registration Country">
									</div>
									<div class="form-group">
										<label>Previous Registration</label>
										<input type="text" class="form-control" name="previous_reg" <?php if(isset($_SESSION['logbook']['previous_reg'])) echo 'value='.'"'.$_SESSION['logbook']['previous_reg'].'"'?> required placeholder="Previous Registration">
									</div>
									<?php
										
										
									?>
									<div class="form-group">
										<label>Date of Policy</label>
										<input type="date" class="form-control" name="date" min="<?php echo date('Y-m-d'); ?>" <?php if(isset($_SESSION["future_cover"])){$future_date=$_SESSION["future_cover"]->format('Y-m-d'); echo 'value='.'"'.$future_date.'"';  echo "readonly";} elseif(isset($_SESSION['logbook']['date'])){echo 'value='.'"'.$_SESSION['logbook']['date'].'"';} else {echo 'value='.'"'.date('Y-m-d').'"';}?> autofocus>

									</div>
									<div class="form-group">
										<label>Logbook Number</label>
										<input type="text" class="form-control" name="logbook_number" <?php if(isset($_SESSION['logbook']['logbook_number'])) echo 'value='.'"'.$_SESSION['logbook']['logbook_number'].'"'?> required placeholder="Logbook Number">

									</div>
									<div class="form-group">
										<label>Physical Address</label>
										<input type="text" class="form-control" name="physical_address" <?php if(isset($_SESSION['logbook']['physical_address'])) echo 'value='.'"'.$_SESSION['logbook']['physical_address'].'"'?> required placeholder="Enter Physical Addres">

									</div>
									<div class="form-group">
										<label>ID Number</label>
										<input type="text" class="form-control" name="id_number" <?php if(isset($_SESSION['logbook']['id_number'])) echo 'value='.'"'.$_SESSION['logbook']['id_number'].'"'?> required placeholder="ID Number">

									</div>
									
									<div class="form-group">
										<label>Upload ID </label>
										<input type="file" class="form-control" name="clientFiles[]"  <?php if(isset($_SESSION['client_files']['u_id'])) echo 'value='.'"'.$_SESSION['client_files']['u_id'].'"'?> required placeholder="Upload ID Copy">

									</div>
									<div class="form-group">
										<label>KRA Pin Number</label>
										<input type="text" class="form-control" name="kra_number" <?php if(isset($_SESSION['logbook']['kra_number'])) echo 'value='.'"'.$_SESSION['logbook']['kra_number'].'"'?> id="kra_number" required placeholder="KRA PIN Number" onchange="validate_kra()">

									</div>
									<div class="form-group">
										<label>Upload KRA PIN </label>
										<input type="file" class="form-control" name="clientFiles[]" <?php if(isset($_SESSION['client_files']['u_id'])) echo 'value='.'"'.$_SESSION['client_files']['u_id'].'"'?> required placeholder="Upload KRA PIN Copy">

									</div>
									<div class="form-group">
										<label>Upload Logbook Copy </label>
										<input type="file" class="form-control" name="clientFiles[]" <?php if(isset($_SESSION['client_files']['u_logbook'])) echo 'value='.'"'.$_SESSION['client_files']['u_logbook'].'"'?> required placeholder="Upload Logbook Copy">

									</div>
									</aside>
									<div class="">
										<input type="submit" id="submit" value="Register" class="btn_full">
									</div>
								</div>
							</form>
							<!-- End row -->
						</div>
					
						<!-- End Logbook-->

					</div>
					<!-- End container -->
				</div>
			</div>
		</div>
		<?php include "nav/footer.php"?>

	<!-- End footer -->

	<div id="toTop"></div>
	<!-- Back to top button -->
	<!-- Search Menu -->
	<div class="search-overlay-menu">
		<span class="search-overlay-close"><i class="icon_close"></i></span>
		<!-- <form role="search" id="searchform" method="get">
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon-search-6"></i>
			</button>
		</form> -->
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
	<script type="text/javascript">
		function validate_registration(){
			const reg_number = document.getElementById("registration");
			console.log(reg_number.value);
			var ira_patt = /[A-Za-z]{3}[0-9]{3}[A-Za-z]{1}|[A-Za-z]{3}[0-9]{3}|[A-Za-z]{3} [0-9]{3}[A-Za-z]{1}|[A-Za-z]{3} [0-9]{3}/g;
			var result = reg_number.value.match(ira_patt);
			if(result){
				reg_number.value = result;
				console.log(result);
			}else{
				reg_number.value = "";
				reg_number.placeholder='Invalid. Acceptable formats: KAA 000A/KAA 000';
			}
		}
		function validate_kra(){
			const kra_number = document.getElementById("kra_number");
			console.log(kra_number.value);
			var ira_patt = /^[A]{1}[0-9]{9}[a-zA-Z]{1}$/g;
			var result = kra_number.value.match(ira_patt);
			if(result){
				kra_number.value = result;
				console.log(result);
			}else{
				kra_number.value = "";
				kra_number.placeholder='Invalid. Acceptable formats: A001234567Z';
			}
		}
	</script>
	<script>
		// Get the submit button
		var submitButton = document.getElementById("submit");
		// Add a click event listener to the submit button
		submitButton.addEventListener("click", function(event) {
			// Show the loader
			document.getElementById("loader").style.display = "block";
			document.getElementById("loading-text").innerHTML = "Uploading Doccuments....";
		});
	</script>
<?php include "chat/chat.php"?>	
</body>
</html>