<?php 
	session_start(); 
    include 'config/db.php';
    if(!isset($_SESSION["underwriter"])) { 
      header("refresh:0;url=./index.php");
	}

	$_SESSION["confirmed_items"] = $_POST;
	#if($insert->execute()){
	$underwriter = trim($_SESSION["underwriter"]["Name"]);
	$emailsql= "SELECT EMAIL_ADDRESS FROM tbl_underwriter where Name  like '%$underwriter'";
	if($res = mysqli_query($connection, $emailsql)){
									
		while($row = mysqli_fetch_array($res)){
			$_SESSION["underweiter_email"] = $row["EMAIL_ADDRESS"];
		}
	}
	include "nav/journeyheader.php";
	// if(isset($_POST["payments"])){
	// 	if ($_POST["payments"] == "credit"){
	// 		echo "<script> alert('Kindly wait for your agency to process your request'); <script/>";
	// 	}
	// }
?>


	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/mpesa.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Pay Using Your Phone</h1>
				<p>Pay using Mpesa</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->
	<section class="wrapper">
		<div class="divider_border"></div>	
		<div class="container">
			<div class="row">
				<div class="col-md-10">
				

				<div id="myDIV" style="display:none !important;" class="d-flex justify-content-around">
					<!-- <div class="spinner-border text-primary" role="status">
						<span class="sr-only" style="width: 6rem; height: 6rem;">Loading...</span>
					</div>
					<div class="spinner-border text-secondary" role="status">
						<span class="sr-only"  style="width: 6rem; height: 6rem;">Loading...</span>
					</div>
					<div class="spinner-border text-success" role="status">
						<span class="sr-only"  style="width: 6rem; height: 6rem;">Loading...</span>
					</div> -->
					<div id = "countdown" style="color:red;font-size:20px;">
					</div>
					<div class="d-flex justify-content-around">
						kindly wait as we process your request
					</div>
					
					<!-- <div class="spinner-border text-primary" role="status">
						<span class="sr-only" style="width: 6rem; height: 6rem;">Loading...</span>
					</div>
					<div class="spinner-border text-secondary" role="status">
						<span class="sr-only"  style="width: 6rem; height: 6rem;">Loading...</span>
					</div>
					<div class="spinner-border text-success" role="status">
						<span class="sr-only"  style="width: 6rem; height: 6rem;">Loading...</span>
					</div><br> -->
					
				</div>
					<h2>Customer  Details</h2>
					<h5>Confirm mobile number for m-pesa payment</h5>
					<!-- <form action="#" method="post" autocomplete="off" > -->
					<form action="<?php echo ($_POST['payments'] == 'mpesa')? 'transactions/stk.php':'#';?>" method="post" autocomplete="off" >
						<div class="input-container">
							<i class="icon-mobile-6 icon"></i>
							<input class="input-field" id="phone" type="text" name="phone" value='<?php echo $_SESSION["client_details"]["phone_number"]?>'>
						</div>
						<h5>Confirm email address receiving insurance certificate</h5>
						<div class="input-container">
							<i class="icon-mobile-6 icon"></i>
							<input class="input-field" id="email" type="text" name="email" value='<?php echo $_SESSION["client_details"]["email"]?>'>
							<input class="input-field" id="email" type="hidden" name="payments" value='<?php echo ($_POST['payments'] == 'mpesa')? 'mpesa':'credit';?>'>

						</div>				
						<div class="form-group">
							<input type="submit" value="Make Payment" class="btn_full" onclick="myFunction()">
						</div>
					</form>
				</div>
				<div class="divider_border">
			</div>
		</section>
		<div class="divider_border"></div><br><br>
									
		<!-- End container -->

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
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#date_pick').datepicker();
	</script>
	<script src="js/sidebar_carousel_detail_page_func.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js"></script>
	<script src="js/map.js"></script>
	<script src="js/infobox.js"></script>
	<script>
	function myFunction() {
		var x = document.getElementById("myDIV");
		if (x.style.display === "block") {
			x.style.display = "none";
		} else {
			x.style.display = "block";
		}
	}
	</script>
	<script>
	function countdown( elementName, minutes, seconds ){
			var element, endTime, hours, mins, msLeft, time;

			function twoDigits( n ){
				return (n <= 1.5 ? "0" + n : n);
			}

			function updateTimer(){
				msLeft = endTime - (+new Date);
				if ( msLeft < 1000 ) {
					element.innerHTML = "Time is up!";
				} else {
					time = new Date( msLeft );
					hours = time.getUTCHours();
					mins = time.getUTCMinutes();
					element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
					setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
				}
			}

			element = document.getElementById( elementName );
			endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
			updateTimer();
		}

		countdown( "countdown", 1.5, 0 );

	</script>

<?php include "chat/chat.php"?>
</body>

</html>