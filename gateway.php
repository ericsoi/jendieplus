<?php 
	@session_start();
    include 'config/db.php';
    if(!isset($_SESSION["underwriter"])) { 
      header("refresh:0;url=./index.php");
	}
	$underwriter = trim($_SESSION["underwriter"]["Name"]);
	$owner=$_SESSION['client_details']["referal_code"];
	// $emailsql= "SELECT EMAIL_ADDRESS FROM tbl_underwriter where Name  like '%$underwriter'";
	
	// if($res = mysqli_query($connection, $emailsql)){
									
	// 	while($row = mysqli_fetch_array($res)){
	// 		$_SESSION["underweiter_email"] = $row["EMAIL_ADDRESS"];
	// 	}
	// }

	// $query = "SELECT Username, Password FROM geek";
      
    // // Execute the query and store the result set
    $result = mysqli_query($connection, "SELECT * from tbl_email where underwriter like '%$underwriter' and owner = '$owner'");
	if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		if(!filter_var($row["emailcc"], FILTER_VALIDATE_EMAIL) && filter_var($row["email"], FILTER_VALIDATE_EMAIL)){
			$_SESSION["underweiter_email"] =  $row["email"];  
			$_SESSION["email_cc"]= $row["email"];
		}elseif(filter_var($row["emailcc"], FILTER_VALIDATE_EMAIL) && filter_var($row["email"], FILTER_VALIDATE_EMAIL)){
			$_SESSION["underweiter_email"] =  $row["email"];  
			$_SESSION["email_cc"]= $row["emailcc"];
		}else{
			$result = mysqli_query($connection,"SELECT EMAIL_ADDRESS FROM tbl_underwriter where Name  like '%$underwriter'");
			if(mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_array($result);
				$_SESSION["underweiter_email"] =  $row["EMAIL_ADDRESS"];  
				$_SESSION["email_cc"]= $row["EMAIL_ADDRESS"];
			}
		}
		
	}else{
		$result = mysqli_query($connection,"SELECT EMAIL_ADDRESS FROM tbl_underwriter where Name  like '%$underwriter'");
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_array($result);
			$_SESSION["underweiter_email"] =  $row["EMAIL_ADDRESS"];  
			$_SESSION["email_cc"]= $row["EMAIL_ADDRESS"];
		}
	}
        // it return number of rows in the table.
        
          
    //        if ($row)
    //           {
    //              printf("Number of row in the table : " . $row);
    //           }
    //     // close the result.
    //     mysqli_free_result($result);
    // }

	include "nav/journeyheader.php";
	// if(isset($_POST["payments"])){
	// 	if ($_POST["payments"] == "credit"){
	// 		echo "<script> alert('Kindly wait for your agency to process your request'); <script/>";
	// 	}
	// }
	// print_r($_SESSION);
?>


	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/mpesa.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Pay Using Your Phone</h1>
				<p>Pay using Mpesa</p>
				<?php
				// print_r($_SESSION);
				echo $underwriter;
				echo $owner;
				?>
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
					<form action="processer/handle_gateway.php" method="get" autocomplete="off" >
						<div class="input-container">
							<i class="icon-mobile-6 icon"></i>
							<input class="input-field" id="phone" type="text" name="phone" value='<?php echo $_SESSION["client_details"]["phone_number"]?>'>
						</div>
						<h5>Confirm email address receiving insurance certificate</h5>
						<div class="input-container">
							<i class="icon-mobile-6 icon"></i>
							<input class="input-field" id="email" type="text" name="email" value='<?php echo $_SESSION["client_details"]["email"]?>'>
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

<?php include "nav/footer.php";

?>

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
<?php
if(isset($_SESSION["message"])){
	$message=$_SESSION["message"];
	echo "<script>var message = '$message'; alert(message);</script>";
	unset($_SESSION["message"]);
}
?>

</html>