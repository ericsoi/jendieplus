<?php include "nav/header.php";?>

	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/contact_us.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1>Contact JendiePlus</h1>
				<p>All your motor insurance queries addressed.</p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper add_bottom_30">
		<div class="divider_border"></div>
		<div class="container">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.829821472148!2d36.81983441461415!3d-1.2754343990697334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f172979641d2b%3A0x91586bb3fbf18ad4!2sEquity%20banks!5e0!3m2!1sen!2ske!4v1605593868887!5m2!1sen!2ske" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
			<!-- end map-->
			<div class="row">

				<aside class="col-md-3">
					<div class="box_style_2">
						<h4 class="nomargin_top">Contacts info</h4>
						<p>
							Equity Bank Building Third floor suite 202, Ngara Rd, Nairobi.
							<br>+254722301062 +254 723 775 289
							<br>
							<a href="mailto:info@jendieplus.co.ke">info@jendieplus.co.ke</a>
						</p>
						<h5>Get directions</h5>
						<form action="http://maps.google.com/maps" method="get" target="_blank">
							<div class="form-group">
								<input type="text" name="saddr" placeholder="Enter your location" class="form-control styled">
								<input type="hidden" name="daddr" value="Equity Bank, Ngara">
								<!-- Write here your end point -->
							</div>
							<input type="submit" value="Get directions" class="btn_1 add_bottom_15">
						</form>
						<hr class="styled">
						<h4>Departments</h4>
						<ul class="contacts_info">
							<li>Support
								<br>
								<a href="tel+254722301062 +254723775289"> +254722301062 +254723775289</a>
								<br><a href="mailto:support@jendieplus.co.ke">support@jendieplus.co.ke</a>
								
							</li>
							<li>General Inquiry
								<br>
								<a href="tel:+254722301062+254723775289">+254722301062 +254723775289</a>
								<br><a href="mailto:info@jendieplus.co.ke">info@jendieplus.co.ke</a>
								<br>
								
							</li>
						</ul>
					</div>
				</aside>
				<!--End aside -->

				<div class="col-md-9">
					<h3>Contact us</h3>
					<p>
						Have any questios? Reach out to us.
					</p>
					<div>
						<div id="message-contact"></div>
						<form method="post" action="assets/contact.php" id="contactform">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>First name</label>
										<input type="text" class="form-control styled" id="name_contact" name="name_contact" placeholder="Jhon">
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Last name</label>
										<input type="text" class="form-control styled" id="lastname_contact" name="lastname_contact" placeholder="Doe">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Email:</label>
										<input type="email" id="email_contact" name="email_contact" class="form-control styled" placeholder="jhon@email.com">
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Phone number:</label>
										<input type="text" id="phone_contact" name="phone_contact" class="form-control styled" placeholder="0712 345 678">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Your message:</label>
										<textarea rows="5" id="message_contact" name="message_contact" class="form-control styled" style="height:100px;" placeholder="Hello world!"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Are you human? 3 + 1 =</label>
										<input type="text" id="verify_contact" class=" form-control styled" placeholder=" 3 + 1 =">
									</div>
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
</body>

</html>
