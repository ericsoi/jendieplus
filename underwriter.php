<?php
	@session_start();
	if(!isset($_SESSION["underwriter"])) { 
        header("refresh:0;url=./index.php");
    }else{
		$underwriter = $_SESSION["underwriter"];
	}
	include "./nav/journeyheader.php";
?>


	<!-- SubHeader =============================================== -->
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/underwriter_page.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1><?php echo $_SESSION["underwriter"]["Name"]?></h1>
				<h5 style="color:white;"><?php echo $_SESSION["underwriter"]["description"]?></h5>
				
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">

			<div class="row">
				<div class="col-md-9">
					<div class="bloglist">
							<div class="row wow fadeIn">
								<div class="col-sm-4">
									<a><img alt="" class="img-responsive img-thumbnail" src="img/third_party.jpg">
									</a>								
								</div>
								<div class="col-sm-8">
									<h4><a href="javascript:;">Third-Party Cover</a></h4>
									<ul class="list-inline">
										<li><a href="#"><i class="icon_folder-alt"></i> (14) Covers Issued</a>
										</li>
										<li><a href="#"><i  class="icon-share"></i> Share Cover</a>
										</li>
										
									</ul>
									<p>Descriptions of the Cover.</p>
										<a href="processer/handle_underwriter.php?cover=Third Party Only" id ='get_quote' class="btn_1">Get Quote</a>
									</p>
								</div>
							</div>
						
						<!-- end row -->

						<hr>
					
						<div class="row wow fadeIn">
							<div class="col-sm-4">
								<a><img alt="" class="img-responsive img-thumbnail" src="img/comprehensive.jpg">
								</a>
							</div>
							<div class="col-sm-8">
								<h4><a href="javascript:;">Comprehensive Cover</a></h4>
								<ul class="list-inline">
									<li><a href="#"><i class="icon_folder-alt"></i> (14) Covers Issued</a>
									</li>
									<li><a href="#"><i  class="icon-share"></i> Share Cover</a>
									</li>
									
								</ul>
								<p>Descriptions of the Cover. </p>
								<a href="processer/handle_underwriter.php?cover=Comprehensive" id ="get_quote" class="btn_1">Get Quote</a>
							</div>
						</div>
						
						<!-- end row -->

					</div>
					<!-- end store-list -->
				</div>
				<!-- end col -->

				<aside id="sidebar" class="col-md-3">
					<div class="widget">
						<form>
							<div class="form-group">
								<input type="text" name="search" id="search" class="form-control" placeholder="Search...">
							</div>
							<button type="submit" id="submit" class="btn_1"> Search Insurance Company</button>
						</form>
					</div>
					<!-- end widget -->

					
					<div class="widget">
						<div class="widget-title">
							<h4>Popular Tags</h4>
						</div>
						<!-- end widget-title -->

						<div class="tags">
							<a href="#">Third-Party</a>
							<a href="#">Fire Protection</a>
							<a href="#">Comprehensive</a>
							
						</div>
						<!-- end tags -->
					</div>
					<!-- end widget -->
				</aside>
				<!-- end col -->
			</div>
			<!-- end row -->

			<nav class="pagination-wrapper">
				<ul class="pagination">
					<li><a href="#">1</a>
					</li>
					
					<li>
						<a href="#" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				</ul>
			</nav>
			<!-- End pagination -->

		</div>
		<!-- End container -->
	</section>
	<!-- End section -->

	
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3">
					<h3>Need help?</h3>
					<a href="tel:+254723775289" id="phone">+254 723 775 289</a>
					<a href="mailto:info@jendieplus.co.ke" id="email_footer">info@jendieplus.co.ke</a>
				</div>
				<div class="col-md-2 col-sm-3">
					<h3>Quick Links</h3>
					<ul>
						<li><a href="#">About us</a>
						</li>
						<li><a href="#">FAQ</a>
						</li>
						<li><a href="../../jendieplus/login.php">Login</a>
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
					
					<span id="copy">Copyright © 2022. JendiePlus Technologies - All rights reserved</span>
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
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>
	<?php include "chat/chat.php"?>

</body>

</html>