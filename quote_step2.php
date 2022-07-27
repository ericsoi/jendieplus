<?php 
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if (isset($_SESSION["optionalbenefits"])){
		unset($_SESSION["optionalbenefits"]);
	}
    if(isset($_GET)){
		#print_r($_GET);
		// print_r($_SESSION);
		$_SESSION["optionalbenefits"] = $_GET;
	}if(!isset($_SESSION["underwriter"])) { 
	
		header("refresh:0;url=./index.php");
	}else{
		include "dashboard/db/connect_db.php";
		// $registration=$_SESSION['client_details']['vehicle_reg'];$make=$_SESSION['client_details']['vehicle_make'];$yom=$_SESSION['client_details']['yom'];
	}
	include "nav/journeyheader.php";
  ?>

	<!-- End Header 1-->

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
									
									<form method="post" action="confirmationpage.php" autocomplete="off" enctype="multipart/form-data">
						
										<div class="center">
											<h3>Particulars</h3></div>
							<div class="form-group">
								<label>Registration</label>
								<input type="text" class="form-control" name="registration" id = "registration" placeholder="enter vehicle registration number" onchange="validate_registration()">
							</div>
							<div class="form-group">
								<label>Chasis/Frame</label>
								<input type="text" class="form-control" name="chasis" required placeholder="Chasis/Frame">
							</div>
							<div class="form-group">
								<label>Make</label>
								<input type="text" class="form-control" name="make" required placeholder="Make">
							</div>
							<div class="form-group">
								<label>Model</label>
								<input type="text" class="form-control" name="model" required placeholder="Model">
							</div>
							<div class="form-group">
								<label>Type</label>
								<input type="text" class="form-control" name="type" required placeholder="Type">
							</div>
							<div class="form-group">
								<label>Body</label>
								<input type="text" class="form-control" name="body" required placeholder="Body">
							</div>
							<div class="form-group">
								<label>Fuel</label>
								<input type="text" class="form-control" name="fuel" required placeholder="Fuel">
							</div>
							<div class="form-group">
								<label>Man Year</label>
								<select name="man_year" class="form-control py-1"> <?php for ($i = date('Y'); $i >= 1900; $i--){echo "<option>$i</option>"; }?></select>
							</div>
							<div class="form-group">
								<label>Rating</label>
								<input type="text" class="form-control" name="rating" required placeholder="Rating">
							</div>
							<div class="form-group">
								<label>Engine Number</label>
								<input type="text" class="form-control" name="engine_number" required placeholder="Engine Number">
							</div>
							<div class="form-group">
								<label>Color</label>
								<input type="text" class="form-control" name="color" required placeholder="Color">
							</div>
										<div class="form-group">
								<label>Registration Date</label>
								<input type="date" class="form-control" name="reg_date">
							</div>
							<div class="form-group">
								<label>Gross Weight</label>
								<input type="number" class="form-control" name="gross_weight" required placeholder="Gross Weight">
							</div>
							<div class="form-group">
								<label>Duty</label>
								<select id="duty" name="duty" class="form-control styled" placeholder="Vehicle Class" required>
									<option value="paid">Paid</option>
									<option value="unpaid">Unpaid</option>
								</select>
							</div>
							<div class="form-group">
								<label>Number Of Previous Owners</label>
								<input type="number" class="form-control" name="previous_owners" required placeholder="Number Of Previous Owners">
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
							<div class="form-group">
								<label>Passengers</label>
								<input type="number" class="form-control" name="passengers" required placeholder="Passengers">
							</div>
							<div class="form-group">
								<label>Tare Weight</label>
								<input type="number" class="form-control" name="tare_weight" required placeholder="Tare Weight">
							</div>
							<div class="form-group">
								<label>Tax Class</label>
								<input type="text" class="form-control" name="tax_class" required placeholder="Tax Class">
							</div>
							<div class="form-group">
								<label>Axels</label>
								<input type="number" class="form-control" name="axels" required placeholder="Axels">
							</div>
							<div class="form-group">
								<label>Load Capaticity(KG)</label>
								<input type="number" class="form-control" name="load_capacity" required placeholder="Load Capaticity(KG)">
							</div>
							<div class="form-group">
								<label>Previous Registration Country</label>
								<input type="text" class="form-control" name="reg_country" required placeholder="Previous Registration Country">
							</div>
							<div class="form-group">
								<label>Previous Registration</label>
								<input type="text" class="form-control" name="previous_reg" required placeholder="Previous Registration">
							</div>
						<div class="form-group">
						<label>Date of Policy</label>
						<input type="date" class="form-control" name="date" min="<?php echo date('Y-m-d'); ?>" value = "<?php echo date('Y-m-d');?>" autofocus>

						</div>
						<div class="form-group">
						<label>ID Number</label>
							<input type="text" class="form-control" name="id_number" required placeholder="ID Number">

						</div>
						<div class="form-group">
						<label>Upload ID </label>
							<input type="file" class="form-control" name="clientFiles[]" required placeholder="Upload ID Copy">

						</div>
						<div class="form-group">
						<label>KRA Pin Number</label>
							<input type="text" class="form-control" name="kra_number" id="kra_number" required placeholder="KRA PIN Number" onchange="validate_kra()">

						</div>
						<div class="form-group">
						<label>Upload KRA PIN </label>
							<input type="file" class="form-control" name="clientFiles[]" required placeholder="Upload KRA PIN Copy">

						</div>
						<div class="form-group">
						<label>Upload Logbook Copy </label>
							<input type="file" class="form-control" name="clientFiles[]" required placeholder="Upload Logbook Copy">

						</div>
				</aside>
					<div class="">
								<input type="submit" value="Register" class="btn_full">
							</div>
			</div>
			<!-- End row -->
					</div>
				<!-- End Logbook-->
		</div>
		<!-- End container -->

		<?php include "nav/footer.php"?>

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
<?php include "chat/chat.php"?>	
</body>

</html>