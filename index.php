<?php
	if (isset($_SESSION)) {
		session_unset();
	}
	session_start();
	include "dashboard/db/connect_db.php";
?>

<script>
	function showHint(str) {
		if (str.length == 0) {
			document.getElementById("txtHint").innerHTML = "";
			return;
		} else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
					document.getElementById("txtHint").innerHTML = this.responseText;
					var underwriterlist = document.getElementById("underwriterlist");
					var childs = underwriterlist.childNodes
					let array = []
					
					console.log(array);
					if(this.responseText == "" || this.responseText == "no suggestion"){
						document.getElementById('underwriterlistseen').style.display = 'block';
					}else{
					let inputSerch = this.responseText.replace(/ /g,'').split(",")
						document.getElementById('underwriterlistseen').style.display = 'none';
						for (i = 0; i < childs.length; i++) {
							// console.log(childs[i].id);
							if(childs[i].id){
								array.push(childs[i].id)
								if(inputSerch.indexOf(childs[i].id) !== -1){
									document.getElementById(childs[i].id).style.display = 'block';
								}else{
									document.getElementById(childs[i].id).style.display = 'none';
								}
							}
							
						}
			
					}
											
				}
			}
			xmlhttp.open("GET", "results.php?q="+str, true);
			xmlhttp.send();
		}
	}
	
</script>


	<?php include "nav/header.php";?>
	
	<!-- End Header 1-->
	

	<!-- Slider -->
	<div id="full-slider-wrapper">
		<div id="layerslider" style="width:100%;height:700px;">
			<!-- first slide -->
			<div class="ls-slide" data-ls="slidedelay: 5000; transition2d:85;">
				<img src="img/slides/Slider1.jpg" class="ls-bg" alt="Slide background">
				<h3 class="ls-l slide_typo" style="top: 55%; left: 50%;" data-ls="offsetxin:0;durationin:2000;delayin:1000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;offsetxout:0;rotatexout:90;transformoriginout:50% bottom 0;"><span style="color:blue;">Smart </span><span style="color:red;">INSURANCE</span><span style="color:blue;"> Mkononi</span></h3>
				<p class="ls-l slide_typo_2" style="top: 65%; left:50%;" data-ls="durationin:2000;delayin:1000;easingin:easeOutElastic;">
					Changing How Insurance works
				</p>
				<!-- <a class="ls-l button_intro_2 outline" style="top:75%; left:50%;white-space: nowrap;" data-ls="durationin:2000;delayin:1400;easingin:easeOutElastic;" href='quote.php'>Get Quote</a> -->
				<a class="ls-l button_intro_2 outline" style="top:75%; left:50%;white-space: nowrap;" data-ls="durationin:2000;delayin:1400;easingin:easeOutElastic;" href='#wrapper' >Get Quote</a>
			</div>
			<div id="wrapper"></div>
		</div>
	</div>
	<!-- End layerslider -->

	<section class="wrapper">
		<div class="divider_border"></div>
	
		<div class="container" id="underwriters">

			<div class="main_title">
				<div class="" data-toggle="">
					<label class="">
						<h2>Partner<span> Insurance</span> Companies</h2>
					</label>
					<label class="btn btn-secondary">
						<input type="email" class="form-control" id="exampleInputEmail1" onkeyup="showHint(this.value)" aria-describedby="emailHelp" placeholder="Search">
					</label>
					<label class="btn btn-secondary">
						<button type="button" class="form-control" id="clear" onclick="handleClear(this.id)"  aria-describedby="emailHelp">clear</button>
					</label>
				</div>				
				<p>Select your preferred Insurer among our Partner Insurance Companies</p>
				<p>Suggestions: <span id="txtHint"></span></p>
			</div>

			<div class="row" id="underwriterlist" >
			
				<?php		
					$select = $pdo->prepare("SELECT * FROM `tbl_underwriter` WHERE NOT (Name LIKE '%life%' or Name LIKE '%Pioneer Assurance Company Limited%' or Name LIKE '%Health%' or Name LIKE '%Jubilee General Insurance Limited%')");
					$select->execute();
					while($row = $select->fetch(PDO::FETCH_ASSOC)){
						extract($row);		
					?>
					<div class="col-md-4 col-sm-6 wow fadeIn animated" id = "<?php echo str_replace(' ', '', $row['Name'])?>" hidden="hidden" data-wow-delay="0.2s">
						<div class="img_wrapper">
							<div class="img_container" style="height:233px; ">
							 <a href="processer/handle_index.php?q=<?php echo $row['ID']?>" class="fill" id="underwriter">
								<img src="<?php echo $row['path'] ?>" width="100%" height="100%" class="img-responsive" alt="">
									<div class="short_info">
										<h3><?php echo $row["Name"]?></h3>
										<em>Comprehensive &amp; Third-party</em>
										<p>
											<?php echo $row["description"]?>
										</p>
										<div class="score_wp">Superb
											<div class="score">7.5</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						<!-- End img_wrapper -->
					</div>
					<?php
						}
					?> 


			</div>


			<div class="row" id="underwriterlistseen">
			
				<?php		
					$record_per_page = 6;
					$page = '';
					if(isset($_GET["page"])){
						$page = $_GET["page"];
						$search = @$_GET['page']; 
					}else {
						$page = 1;
					}

					$start_from = ($page-1)*$record_per_page;	
					$select = $pdo->prepare("SELECT * FROM `tbl_underwriter` WHERE NOT (Name LIKE '%life%' or Name LIKE '%Pioneer Assurance Company Limited%' or Name LIKE '%Health%' or Name LIKE '%Jubilee General Insurance Limited%') ORDER BY Name LIMIT $start_from, $record_per_page");
					$select->execute();
					while($row = $select->fetch(PDO::FETCH_ASSOC)){
						extract($row);		
					?>
					<div class="col-md-4 col-sm-6 wow fadeIn animated" data-wow-delay="0.2s">
						<div class="img_wrapper">
							<div class="img_container" style="height:233px;">
							 <a href="processer/handle_index.php?q=<?php echo $row['ID']?>">
								<img src="<?php echo $row['path']?>" width="100%" height="100px" class="img-responsive" alt="">
									<div class="short_info">
										<h3><?php echo $row["Name"]?></h3>
										<em>Comprehensive &amp; Third-party</em>
										<p>
											<?php echo $row["description"]?>
										</p>
										<div class="score_wp">Superb
											<div class="score">7.5</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						<!-- End img_wrapper -->
					</div>
					<?php
						}
					?> 


			</div>

			<nav class="pagination-wrapper">
				<ul class="pagination">
					<?php
						$select = $pdo->prepare("SELECT * FROM `underwriters` WHERE NOT (Name LIKE '%life%' or Name LIKE '%Pioneer Assurance Company Limited%' or Name LIKE '%Health%') ORDER BY Name DESC");
						$select->execute();
						$total_records = $select->rowCount();
						$total_pages = ceil($total_records/$record_per_page);
						$start_loop = $page;
						$difference = $total_pages - $page;
					
						if($difference <= 5){
							$start_loop = $total_pages - 5;
						}
						#$active = "active";
						$end_loop = $start_loop + 4;
						if($page > 1){
							
							echo "<li><a href='?page=1#underwriters'>First</a></li>";
							echo "<li><a href='?page=".($page - 1)."#underwriters'><<</a></li>";
						}
						for($i=$start_loop; $i<=$end_loop; $i++){
							$active = $i == $page ? 'class="active"' : '';     
							echo "<li $active><a href='?page=".$i."#underwriters'>".$i."</a><li>";
						}
						if($page <= $end_loop){
							echo "<li><a href='?page=".($page + 1)."#underwriters'>>></a></li>";
							echo "<li><a href='?page=".$total_pages."#underwriters'>Last</a></li>";
						}
					?>
				</ul>
			</nav>
		</div>
	</section>
	<!-- End section -->

	<section class="container margin_60">
		<div class="main_title">
			<h3>Why choose Us</h3>
			<p>We are relentless in striving to offer innovative products while leveraging on advancing technology for an automated, transparent and seamless processes.</p>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="box_how">
					<div class="icon_how"><span class="icon_set_1_icon-81"></span>
					</div>
					<h4>Best price guarantee</h4>
					<p>Compare prices from multiple companies to get the best deals.</p>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box_how">
					<div class="icon_how"><span class="icon_set_1_icon-94"></span>
					</div>
					<h4>Professional Team</h4>
					<p>Our team is well trained and ready to assist on any issue 24/7.</p>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box_how">
					<div class="icon_how"><span class="icon_set_1_icon-92"></span>
					</div>
					<h4>Certificate in Minutes</h4>
					<p>Get your insurance certificate delivered instantly to your email.</p>
				</div>
			</div>
		</div>
		<!-- End Row -->
	</section>
	<!-- End Container -->

	<section class="promo_full">
		<div class="promo_full_wp">
			<div>
				<h3>What People say<span>Testimonials from people who have used JendiePlus</span></h3>
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<div class="carousel_testimonials">
								<div>
									<div class="">
										<div class="pic">
											<figure><img src="img/avator.jpg" alt="" class="img-circle responsive">
											</figure>
											<h4>Roberta<small>30 January 2022</small></h4>
										</div>
										<div class="comment">
											"The best Insurance services provider. The innovation is surreal."
										</div>
									</div>
									<!-- End box_overlay -->
								</div>

								<div>
									<div class="box_overlay">
										<div class="pic">
											<figure><img src="img/avator.jpg" alt="" class="img-circle responsive">
											</figure>
											<h4>Timothy<small>12 March 2022</small></h4>
										</div>
										<div class="comment">
											"I got my Insurance instantly on email. Kudos guys."
										</div>
									</div>
									<!-- End box_overlay -->
								</div>

							</div>
							<!-- End carousel_testimonials -->
						</div>
						<!-- End col-md-8 -->
					</div>
					<!-- End row -->
				</div>
				<!-- End container -->
			</div>
			<!-- End promo_full_wp -->
		</div>
		<!-- End promo_full -->
	</section>
	<!-- End section -->

	<?php include "nav/footer.php"?>;
	<!-- End Search Menu -->

	<!-- COMMON SCRIPTS -->
	<script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/common_scripts_min.js"></script>
	<script src="assets/validate.js"></script>
	<script src="js/jquery.tweet.min.js"></script>
	<script src="js/functions.js"></script>

	 <!-- SPECIFIC SCRIPTS -->
    <script src="layerslider/js/greensock.js"></script>
    <script src="layerslider/js/layerslider.transitions.js"></script>
    <script src="layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
    <script type="text/javascript">
        'use strict';
        $('#layerslider').layerSlider({
            autoStart: true,
            navButtons: false,
            navStartStop: false,
            showCircleTimer: false,
            responsive: true,
            responsiveUnder: 1280,
            layersContainer: 1200,
            skinsPath: 'layerslider/skins/'
                // Please make sure that you didn't forget to add a comma to the line endings
                // except the last line!
        });
		
		$(".myBox").click(function() {
		window.location = $(this).find("a").attr("href"); 
			return false;
		});
    </script>
	<script>
		<script>history.replaceState({},'','$url');</script>
		function handleClear(id){
			document.getElementById("txtHint").innerHTML = "";
			document.getElementById('underwriterlistseen').style.display = 'block';
			document.getElementById("underwriterlist").style.display = 'none';
			location.reload();
			return false;

			// document.getElementById(id).removeEventListener("click", function(e) { e.preventDefault(); }, false);
		}
	</script>
	<?php include "chat/chat.php"?>
</body>

</html>
