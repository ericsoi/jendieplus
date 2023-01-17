<?php 
	@session_start();

	// print_r($_SESSION);
	function vehicleClass($str){
		$no=explode(".", $str)[0];
		$vclass=explode(".", $str)[1];
		switch ($no){
			case $no <=3:
				return "Motorcycle " . $vclass;
				break;
			case $no >3&& $no <=5:
				return "Tricycle ".$vclass;
				break;
			case $no >5:
				return "Motorvehicle ".$vclass;
				break;
			default:
				return "";
		}
	}
	if(!isset($_SESSION["client_details"])) { 
		header("refresh:0;url=./index.php");
	}else{
		$copy = $_SESSION['client_details'];
        foreach ($copy as $key => $value) {
            if ($value == "1 week") {
                $value = "weeklyrates";
            }elseif ($value == "2 weeks"){
                $value = "fortnightrates";
            }elseif ($value == "1 month"){
                $value= "monthlyrates";
            }elseif ($value == "1 year"){
                $value = "annualrates";
            }
            $copy[$key] = $value;
        }
	}
	if(isset($_SESSION['client_details']["passangers"])){
		$passangers="-".$_SESSION['client_details']["passangers"];
	}else{
		$passangers='';
	}
	
	function getRange($value,$lowerlimit,$upperlimit){
	if($value >= $lowerlimit && $value <= $upperlimit){
		$value=$value;
	}else{
		$value=false;
	}
	return $value;
	}

	
    include "dashboard/db/connect_db.php";
	// if (isset($_SESSION["client_details"])){
	// 	unset($_SESSION["client_details"]);
	// }
	if(isset($_SESSION["product"])){
		unset ($_SESSION['product']);
	}
    if(!isset($_SESSION["client_details"])) { 
		header("refresh:0;url=./index.php");
	}else{
		$underwriter = trim($_SESSION["underwriter"]["Name"]);
		$description = trim($_SESSION["underwriter"]["description"]);
        $coverage =  trim($_SESSION["cover"]);
        $referal_code = trim($_SESSION["client_details"]["referal_code"]);
        $vehicleclass = trim($_SESSION["client_details"]["vehicleclass"]);
		$productcode=strtolower("-".$referal_code."-".$underwriter."-".$vehicleclass."-".$coverage);
		$productcode= preg_replace('[ ]', '', $productcode);

	}
	//echo $productcode;
function t2($val, $min, $max) {
	return ($val >= $min && $val <= $max);
}
$select = $pdo->prepare("SELECT * FROM tbl_product where product_code = '$productcode'");
$select->execute();
$product=False;$tonnage=0; $suinsured=0; $passengers=0;
if($select->rowCount()>0){
	$name=$_SESSION["client_details"]['name_contact'];$phone=$_SESSION["client_details"]['phone_number'];
	$email=$_SESSION["client_details"]['email'];$vehicle_reg=$_SESSION["client_details"]['vehicle_reg'];
	$vehicle_class=$_SESSION["client_details"]['vehicleclass'];$coverage=$_SESSION["cover"];
	$period=$_SESSION["client_details"]['coverperiod'];$underwriter=$_SESSION["underwriter"]['Name'];
	$quatation_date=date("d/m/Y h:i:s");$premium="";$agency='';$agent=$_SESSION["client_details"]["referal_code"];
	$saminsured="";$tonnage="";$passengers="";$details='';
	while($row = $select->fetch(PDO::FETCH_ASSOC)){
		$product_code = preg_replace('[ ]', '', $row["product_code"]); 
		$uniqueidentifier = preg_replace('[ ]', '', $row["uniqueidentifier"]); 
		// weeklyrates fortnightrates monthlyrates annualrates
		if ($product_code==$uniqueidentifier){
			if(strlen($row[$copy["coverperiod"]])>=1){
				$product=True;$tonnage=0;$passangers=0;$saminsured=0;
				// $product=True;$tonnage["name"]='Tonnage';$tonnage["value"]= 0; $suinsured["name"]='Sum Insured';$suinsured["value"]= 0;$passengers["name"]='Passengers';$passengers["value"]= 0;
				$_SESSION['product'] = $row;
				$_SESSION['basicpremium']=$row[$copy["coverperiod"]]?$row[$copy["coverperiod"]]:0;
				$coverperiod=$_SESSION['client_details']["coverperiod"];
				$agency=$row["owner"];
				include_once "premiumcalcuator.php";
				grossCalculater();
				$premium=$_SESSION["grosspremium"];
				break;
			}else{
				$_SESSION["product"]['vehicleclass'] = "Product Not Found. Kindly contact the agent code owner";$_SESSION["product"]['coverperiod'] = False;$_SESSION["product"]['policylimits']= False;$coverperiod=false;$_SESSION["grosspremium"]=false;
			}
		}else{
			// echo $product_code ."<br>";
			// echo $uniqueidentifier . "<br>";
			if(isset($copy['tonnage'])){
				if(getRange($copy['tonnage'],$row['mintonnage'],$row['maxtonnage']) && strlen($row[$copy["coverperiod"]])>1){
					$product=True;$tonnage=$copy['tonnage'];$passangers=0;$saminsured=0;
					// $product=True;$tonnage["name"]='Tonnage';$tonnage["value"]= $copy['tonnage']; $suinsured["name"]='Sum Insured';$suinsured["value"]= 0;$passengers["name"]='Passengers';$passengers["value"]= 0;
					$_SESSION['product'] = $row;
					$_SESSION['basicpremium']=$row[$copy["coverperiod"]]?$row[$copy["coverperiod"]]:0;
					$coverperiod=$_SESSION['client_details']["coverperiod"];
					$agency=$row["owner"];
					include_once "premiumcalcuator.php";
					grossCalculater();
					$premium=$_SESSION["grosspremium"];
					$tonnage= $copy["tonnage"];
					break;
				}else{
					$_SESSION["product"]['vehicleclass'] = "Product Not Found. Kindly contact the agent code owner";$_SESSION["product"]['coverperiod'] = False;$_SESSION["product"]['policylimits']= False;$coverperiod=false;$_SESSION["grosspremium"]=false;
				}
			}
			if(isset($copy["passangers"])){
				// print_r($copy);
				if(strlen($row[$copy["coverperiod"]])>1 && $row['passangers'] == $copy["passangers"] ){
					$product=True;$tonnage=0;$passangers=$copy["passangers"];$saminsured=0;

					// $product=True;$tonnage["name"]='Tonnage';$tonnage["value"]= 0; $suinsured["name"]='Sum Insured';$suinsured["value"]= 0;$passengers["name"]='Passengers';$passengers["value"]= $copy["passangers"];
					$_SESSION['product'] = $row;
					$_SESSION['basicpremium']=$row[$copy["coverperiod"]]?$row[$copy["coverperiod"]]:0;
					$coverperiod=$_SESSION['client_details']["coverperiod"];
					$agency=$row["owner"];
					include_once "premiumcalcuator.php";
					grossCalculater();
					$premium=$_SESSION["grosspremium"];
					$passengers=$copy["passangers"];
					break;
				}else{
					$_SESSION["product"]['vehicleclass'] = "Product Not Found. Kindly contact the agent code owner";$_SESSION["product"]['coverperiod'] = False;$_SESSION["product"]['policylimits']= False;$coverperiod=false;$_SESSION["grosspremium"]=false;					
				}	
			}
			
			if($row["coverage"] == "Comprehensive"){
				$age=date("Y")-$copy["man_year"];
				$age +=1;
				// if ($age ==0){
					
				// }
				if(getRange($age, $row["minage"], $row["maxage"]) && getRange($copy['sum_insured'], $row["minsum"], $row["maxsum"])){
					$_SESSION['product'] = $row;
					$product=True;$tonnage=0;$passangers=0;$saminsured=$copy['sum_insured'];
					// $product=True;$tonnage["name"]='Tonnage';$tonnage["value"]= 0; $suinsured["name"]='Sum Insured';$suinsured["value"]= 0;$passengers["name"]='Passengers';$passengers["value"]= 0;
					$suinsured=$copy['sum_insured'];
					$_SESSION['product']['sum_insured']=$suinsured;
					$premium=$copy['sum_insured']*($row[$copy["coverperiod"]]/100);
					// echo $premium;
					// echo $row[$copy["coverperiod"]];
					$agency=$row["owner"];
					if($premium<=$row["minimumpremium"]){
						$_SESSION['basicpremium']=$row["minimumpremium"];
					}elseif($premium>=$row["minimumpremium"]){
						$_SESSION['basicpremium']=$premium;
					}
					$coverperiod=$_SESSION['client_details']["coverperiod"];
					include_once "premiumcalcuator.php";
					grossCalculater();
					break;
				}else{
					$_SESSION["product"]['vehicleclass'] = "Product Not Found. Kindly contact the agent code owner";$_SESSION["product"]['coverperiod'] = False;$_SESSION["product"]['policylimits']= False;$coverperiod=false;$_SESSION["grosspremium"]=false;
				}
			}
		}
	}
}else{
	$_SESSION["product"]['vehicleclass'] = "Product Not Found. Kindly contact the agent code owner";$_SESSION["product"]['coverperiod'] = False;$_SESSION["product"]['policylimits']= False;$coverperiod=false;$_SESSION["grosspremium"]=false;
}
include "nav/journeyheader.php";
if($product){
	$reg = $_SESSION['client_details']['vehicle_reg'];
	$select = $pdo->prepare("SELECT * FROM tbl_quote where vehicle_reg = '$reg'");
	$select->execute();
	if($select->rowCount()>0){
		$update = $pdo->prepare("UPDATE tbl_quote SET name='$name', phone='$phone', email='$email', vehicle_reg='$vehicle_reg', vehicle_class='$vehicle_class', coverage='$coverage', period='$period', underwriter='$underwriter', quatation_date='$quatation_date', premium='$premium', agency='$agency', agent='$agent', saminsured='$saminsured', tonnage='$tonnage', passengers='$passengers', details='$details' WHERE vehicle_reg='$vehicle_reg'");
		 if($update->execute()){
			echo "<script> console.log('added')</script>";
		  }
	} else{
		$insert = $pdo->prepare("INSERT INTO tbl_quote(name,phone,email,vehicle_reg,vehicle_class,coverage,period,underwriter,quatation_date,premium,agency,agent,saminsured,tonnage,passengers,details) VALUES(:name,:phone,:email,:vehicle_reg,:vehicle_class,:coverage,:period,:underwriter,:quatation_date,:premium,:agency,:agent,:saminsured,:tonnage,:passengers,:details)");
		$insert->bindParam(':name',$name);
		$insert->bindParam(':phone',$phone);
		$insert->bindParam(':email',$email);
		$insert->bindParam(':vehicle_reg',$vehicle_reg);
		$insert->bindParam(':vehicle_class',$vehicle_class);
		$insert->bindParam(':coverage',$coverage);
		$insert->bindParam(':period',$period);
		$insert->bindParam(':underwriter',$underwriter);
		$insert->bindParam(':quatation_date',$quatation_date);
		$insert->bindParam(':premium',$premium);
		$insert->bindParam(':agency',$agency);
		$insert->bindParam(':agent',$agent);
		$insert->bindParam(':saminsured',$saminsured);
		$insert->bindParam(':tonnage',$tonnage);	
		$insert->bindParam(':passengers',$passengers);
		$insert->bindParam(':details',$details);
	
		if($insert->execute()){
		  echo "<script> console.log('added')</script>";
		}
	}
}
// 		$insert = $pdo->prepare("INSERT INTO tbl_quote(name,phone,email,vehicle_reg,vehicle_class,coverage,period,underwriter,quatation_date,premium,agency,agent,saminsured,tonnage,passengers,details) VALUES(:name,:phone,:email,:vehicle_reg,:vehicle_class,:coverage,:period,:underwriter,:quatation_date,:premium,:agency,:agent,:saminsured,:tonnage,:passengers,:details)");
// 		$insert->bindParam(':name',$name);
// 		$insert->bindParam(':phone',$phone);
// 		$insert->bindParam(':email',$email);
// 		$insert->bindParam(':vehicle_reg',$vehicle_reg);
// 		$insert->bindParam(':vehicle_class',$vehicle_class);
// 		$insert->bindParam(':coverage',$coverage);
// 		$insert->bindParam(':period',$period);
// 		$insert->bindParam(':underwriter',$underwriter);
// 		$insert->bindParam(':quatation_date',$quatation_date);
// 		$insert->bindParam(':premium',$premium);
// 		$insert->bindParam(':agency',$agency);
// 		$insert->bindParam(':agent',$agent);
// 		$insert->bindParam(':saminsured',$saminsured);
// 		$insert->bindParam(':tonnage',$tonnage);	
// 		$insert->bindParam(':passengers',$passengers);
// 		$insert->bindParam(':details',$details);
	
// 		if($insert->execute()){
// 		  echo "<script> console.log('added')</script>";
// 		}
// 	}
// }
// 	// print_r($_SESSION);
// 	$details="";$name= $_SESSION['client_details']['name_contact']; $phone=$_SESSION['client_details']['phone_number']; $email=$_SESSION['client_details']['email']; $vehicle_reg=$_SESSION['client_details']['vehicle_reg']; $vehicle_class=vehicleClass($_SESSION['client_details']['vehicleclass']); $coverage=$_SESSION['product']['coverage']; $period=$_SESSION['client_details']['coverperiod']; $underwriter=$_SESSION['underwriter']['Name']; $quatation_date=date("D M d/m/Y"); $premium=$_SESSION['grosspremium']; $agency=$_SESSION['product']['owner']; $agent=$_SESSION['client_details']['referal_code'];$saminsured=$_SESSION['client_details']['coverperiod'];
// 	$select = $pdo->prepare("SELECT * FROM tbl_product where product_code = '$productcode'");
// 	$select->execute();
// 	if($select->rowCount()>0){
// 		 $update = $pdo->prepare("UPDATE tbl_quote SET name='$name', phone='$phone', email='$email', vehicle_reg='$vehicle_reg', vehicle_class='$vehicle_class', coverage='$coverage', period='$period', underwriter='$underwriter', quatation_date='$quatation_date', premium='$premium', agency='$agency', agent='$agent', saminsured='$saminsured', tonnage='$tonnage', passengers='$passengers', details='$details' WHERE vehicle_reg='$vehicle_reg'");
// 		 if($update->execute()){
// 			echo "<script> console.log('added')</script>";
// 		  }
// 	} else{
// 		$insert = $pdo->prepare("INSERT INTO tbl_quote(name,phone,email,vehicle_reg,vehicle_class,coverage,period,underwriter,quatation_date,premium,agency,agent,saminsured,tonnage,passengers,details) VALUES(:name,:phone,:email,:vehicle_reg,:vehicle_class,:coverage,:period,:underwriter,:quatation_date,:premium,:agency,:agent,:saminsured,:tonnage,:passengers,:details)");
// 		$insert->bindParam(':name',$name);
// 		$insert->bindParam(':phone',$phone);
// 		$insert->bindParam(':email',$email);
// 		$insert->bindParam(':vehicle_reg',$vehicle_reg);
// 		$insert->bindParam(':vehicle_class',$vehicle_class);
// 		$insert->bindParam(':coverage',$coverage);
// 		$insert->bindParam(':period',$period);
// 		$insert->bindParam(':underwriter',$underwriter);
// 		$insert->bindParam(':quatation_date',$quatation_date);
// 		$insert->bindParam(':premium',$premium);
// 		$insert->bindParam(':agency',$agency);
// 		$insert->bindParam(':agent',$agent);
// 		$insert->bindParam(':saminsured',$saminsured);
// 		$insert->bindParam(':tonnage',$tonnage);	
// 		$insert->bindParam(':passengers',$passengers);
// 		$insert->bindParam(':details',$details);
	
// 		if($insert->execute()){
// 		  echo "<script> console.log('added')</script>";
// 		}
// 	}

// }
?>

	<!-- End Header 1-->

	<!-- SubHeader =============================================== -->
	<div id="loader">
		<div class="loading-animation"></div>
		<p id="loading-text">Loading...</p>
	</div>
	<section class="parallax_window_in" data-parallax="scroll" data-image-src="img/description_banner.jpg" data-natural-width="1400" data-natural-height="470">
		<div id="sub_content_in">
			<div id="animate_intro">
				<h1><?php echo $underwriter?></h1>
				<p><?php echo $description?></p>
			</div>
		</div>
	</section>
	<!-- End section -->
	<!-- End SubHeader ============================================ -->

	<section class="wrapper">
		<div class="divider_border"></div>

		<div class="container">
		<form method="get" action="processer/handle_detail_page.php">

			<div class="row">
				<div class="col-md-8">

					<div class="owl-carousel add_bottom_15">
						<div class="item"><img src="img/description.jpg" alt="">
												</div>
					</div>

					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">Overview</a>
						</li>
						<li><a href="#" data-toggle="tab">Reviews</a>
						</li>
											</ul>

					<div class="tab-content container">
						<div class="tab-pane in active" id="tab_1">
							<div>
								<h3>double insurance status</h3>
								<?php
								    $now = new DateTime();
									if(isset($_SESSION["future_cover"])){
										unset($_SESSION["future_cover"]);
									}
									if(count($_SESSION["DMVIC"]->Error)<1){
										$CoverEndDate=$_SESSION["DMVIC"]->callbackObj["DoubleInsurance"][0]["CoverEndDate"];
										$InsuranceCertificateNo=$_SESSION["DMVIC"]->callbackObj["DoubleInsurance"][0]["InsuranceCertificateNo"];
										$MemberCompanyName=$_SESSION["DMVIC"]->callbackObj["DoubleInsurance"][0]["MemberCompanyName"];
										$RegistrationNumber=$_SESSION["DMVIC"]->callbackObj["DoubleInsurance"][0]["RegistrationNumber"];
										$ChassisNumber=$_SESSION["DMVIC"]->callbackObj["DoubleInsurance"][0]["ChassisNumber"];

										$EndDate = DateTime::createFromFormat("d/m/Y H:i", $CoverEndDate);
										$enddate=unserialize(serialize($EndDate));
																			
										if ($now > $EndDate) {
											echo "<h4 style='color:green;'>Your cover with ". $MemberCompanyName ." expired on ". $enddate->format('d-m-Y')."</h4>";
											// echo "The date is less than today's date.<br>" . $EndDate->format('d-m-Y') . "<br>" . $now->format('d-m-Y');
										} else {											
											$coverextenddate = "+".$_SESSION["client_details"]["coverperiod"];
											$EndDate->modify($coverextenddate);
											
											$_SESSION["future_cover"] = $EndDate;
											echo "<h4 style='color:red;'>Your cover with ". $MemberCompanyName ." expires on ". $enddate->format('d-m-Y')."<br>Extend cover to " . $EndDate->format('d-m-Y')." ($coverextenddate)?</h4>";
											// echo "The date is greater than or equal to today's date.<br>" . $EndDate->format('d-m-Y') . "<br>" . $now->format('d-m-Y');
										}
									}else{
										echo "<h4 style='color:green;'>No cover history</h4>";
									}
									// $CoverEndDate = $_SESSION["DMVIC"]["DoubleInsurance"][0]["CoverEndDate"];
								?>
							</div>
							<hr>
							<h3>Product Overview</h3>
							<hr>
							<div class="row">
								<div class="col-md-7">
									<div class="">
										
										<div class="feature-box-info">
											<h5><?php $_SESSION['class']=vehicleClass($_SESSION["product"]["vehicleclass"]); echo $_SESSION['class'];?></h5>
											<p><?php echo $coverage;?></p>
										</div>
									</div>
									<hr>
									<div class="">
										
										<div class="feature-box-info">
											<h5>Cover Period: <?php echo $coverperiod;?></h5>
										</div>
									</div>
									<hr>
									<div class="">
										
										<div class="feature-box-info">
											<h5>POLICY BENEFITS:</h5>
											<p><?php echo $_SESSION["product"]["policylimits"];?> </p>
										</div>
									</div>
									<hr>
								</div>
								<!-- End col -->
								
								<div class="col-md-5">
									<?php
										if(isset($_SESSION["product"]["product_id"])){
											
											$product_id = $_SESSION["product"]["product_id"];
                                            $select = $pdo->prepare("SELECT * FROM `tbl_benefits` where product_id = '$product_id'");
                                            $select->execute();
                                            if($select->rowCount()>0){
                                                echo "<p>Optional Benefits</p>";
                                                $i = 1;
                                                while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                                    extract($row);
                                                    $i++;
									?>		
									<div class="form-check">
										<div class="form-check form-switch display-7">
											<input type="checkbox" id="<?php echo $row['benefit_id']?>" name = "<?php echo $row['benefit_name']?>" class="form-check-input" value="<?php echo htmlspecialchars( json_encode($row), ENT_COMPAT ); ?>" onchange= "handleoptional_benefits(this)">
											<label class="form-check-label" for="<?php echo $row['benefit_id']?>"><?php echo str_replace("_", " ", $row["benefit_name"])?></label>
											<div hidden id="<?php echo 'input'.$row['benefit_id']?>" class="form-group">
												<div class="form-check-label" id="inputslabel"></div>
												<input type="number" class="form-control" id="<?php echo 'inputs'.$row['benefit_id']?>" aria-describedby="basic-addon3" onchange="handle_input(this)">
											</div>
										</div>
									</div>
									
									<?php
										}
                                    
									?>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text" id="btnGroupAddon">Total</div>
										</div>
										<input type="text" class="input-group-text" id="benefitstotal" placeholder="0" aria-label="Input group example" aria-describedby="btnGroupAddon">
									</div>

									<?php
                                        }
                                    }		
                                ?>
										
								</div>
								<!-- End col -->
							</div>
							<!-- End row -->
							<hr>
						</div>
						<!-- End tab_1 -->

						<div class="tab-pane fade" id="tab_2">
							<div class="reviews-container">
							</div>
							<hr>
						</div>
						<!-- End tab_2 -->
					</div>
					<!-- End tabs -->
				</div>
				<!-- End Col -->
				<aside class="col-md-4">
					<div class="box_style_1">
						<div class="price overflow-hidden">
							<small>GROSS PREMIUM</small><br>
							<input class="form-control text-white fs-2 border-0 border-bottom-0" STYLE="background-color: #2780c2;" id="grosspremium" name="grosspremium" value='KSH <?php echo $_SESSION["grosspremium"]?>' aria-describedby="basic-addon3" readonly/>

						</div>
						<ul class="list_ok" id="optionalbenefits">
							
						</ul>
						<small>*Terms and Conditions apply</small>
					</div>
					<div class="box_style_2">
						<h3>Summary<span>Certificate Will Be Delivered To Email or Whatsapp</span></h3>
						<div id="message-booking"></div>
						
							
							<div class="form-group">
								<label><b>Full Names:</b> <?php echo $_SESSION["client_details"]["name_contact"]?></label>
								
							</div>
							<div class="form-group">
								<label><b>Email:</b> <?php echo $_SESSION["client_details"]["email"]?></label>
								
							</div>
							<div class="form-group">
								<label><b>Phone Number:</b> <?php echo $_SESSION["client_details"]["phone_number"]?></label>
								
							</div>
							<div class="form-group">
								<label><b>Vehicle Class:</b> <?php $str=$_SESSION['product']['vehicleclass']; echo explode(".", $str)[1];?></label>
								</div>
							<div class="form-group">
								<label><b>Registration Number:</b>  <?php echo $_SESSION["client_details"]["vehicle_reg"]?></label>
								
							</div>
							
							<?php if(isset($_SESSION["product"]['product_id'])){echo '<div class="form-group"><input type="submit" value="Buy now" id="submit" class="btn_full"></div>';}else{echo'';}?>
							
						<hr>
						<a href="javascript:;" class="btn_outline2"> Share Quotation</a>
						<a href="get_quote.php" class="btn_outline"> Back</a>
						<a href="tel:+254733566464" id="phone_2"><i class="icon_set_1_icon-91"></i>+254 723 775 289</a>
						<a href="tel:+254733566464" id="phone_2"><i class="icon_set_1_icon-91"></i>+254 723 775 289</a>

					</div>
				</aside>
			</div>
			<!-- End row -->
		</div>
		<form>
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
			<input type="search" placeholder="Search..." />
			<button type="button"><i class="icon-search-6"></i>
			</button>
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
	<!-- JQuery -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.3/js/tether.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.3/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.1.1/js/mdb.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

	<script type="text/javascript">
		document.getElementById("inputslabel").innerHTML="Select Number of Days";
		let benefitstotal = Number(document.getElementById("benefitstotal").placeholder);
		let grosspremium = document.getElementById("grosspremium").value;
		grosspremium=parseFloat(grosspremium.replace('KSH ', ''));
		function handleoptional_benefits(benefit){
			let values = JSON.parse(benefit.value);
			inputArray = ["WINDSCREEN", "RADIO_CASSETE", "PASSENGER_LEGAL_LIABILITY","COURTESY_CAR"];
			let inputs = document.getElementById("input"+values.benefit_id);
			let inputsform = document.getElementById("inputs"+values.benefit_id);
			let ul = document.getElementById("optionalbenefits");
			let li = document.createElement("li");
			if (inputArray.includes(values.benefit_name)){
				if (benefit.checked){
					li.setAttribute('id',values.benefit_id + "optional" );
					li.appendChild(document.createTextNode(values.benefit_name));
					ul.appendChild(li);
					
					inputs.removeAttribute("hidden");
					if(values.benefit_name=="COURTESY_CAR"){
						let amounts=values.benefit_amount.split(",");
						let select = document.createElement('select');
						select.setAttribute('id',inputsform.getAttribute('id'));
						select.setAttribute("class","input-group")
						select.setAttribute("onchange","handle_input(this)")
						inputsform.setAttribute("name",values.benefit_name);
						inputsform.parentNode.replaceChild(select,inputsform);
						values.benefit_days.split(",").forEach(myFunction);
						inputs.setAttribute("class","form-group");
						
						let option= document.createElement('option');
						option.value = 0;
						option.innerHTML = "Select Days";
						option.setAttribute("selected","")
						select.appendChild(option);
						function myFunction(item, index) {
							let option= document.createElement('option');
							option.value = amounts[index];
							option.innerHTML = item + " Days:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" + amounts[index] + " Ksh";
							select.appendChild(option);
						}
					}else{
						inputsform.setAttribute("placeholder","Enter Value");
						inputsform.setAttribute("name",values.benefit_name);
						// inputsform.setAttribute("required","");
					}

				}else{
					inputs.setAttribute("hidden", "");
					let elem = document.getElementById(values.benefit_id + "optional" );
					let benefit_freelimit = values;
					elem.parentNode.removeChild(elem);
					let inputval = Number(document.getElementById("inputs"+values.benefit_id).value);
					switch(values.benefit_name){
						case "WINDSCREEN":
						case "RADIO_CASSETE":
							if(inputval>Number(values.benefit_freelimit)){
								let diff = inputval - Number(values.benefit_freelimit)
								let i = Math.ceil(((Number(values.benefit_rate)/100)*diff));
								benefit_premium = Math.ceil(((0.45/100)*i)+i);
								benefitstotal-=benefit_premium;
								document.getElementById("benefitstotal").placeholder = benefitstotal;
								grosspremium-=Number(benefit_premium);
								document.getElementById("grosspremium").value = "KSH " + grosspremium;
								document.getElementById("inputs"+values.benefit_id).value='';
							}
							break;
						case "PASSENGER_LEGAL_LIABILITY":
							let benefit_amount = Number(values.benefit_amount);
							let premium = benefit_amount*inputval;
							benefit_premium = Math.ceil((0.45/100)*premium+premium);
							benefitstotal-=benefit_premium;
							document.getElementById("benefitstotal").placeholder = benefitstotal;
							grosspremium-=Number(benefit_premium);
							document.getElementById("grosspremium").value = "KSH " + grosspremium;
							document.getElementById("inputs"+values.benefit_id).value='';
							break;
						case "COURTESY_CAR":
							benefit_premium = Math.ceil((0.45/100)*inputval+inputval);
							benefitstotal-=benefit_premium;
							document.getElementById("benefitstotal").placeholder = benefitstotal;
							grosspremium-=Number(benefit_premium);
							document.getElementById("grosspremium").value = "KSH " + grosspremium;
							break;
					}					
				}
			}else{
				if (benefit.checked){
					li.setAttribute('id',values.benefit_id + "optional" );
					li.appendChild(document.createTextNode(values.benefit_name));
					ul.appendChild(li);
					if(values.benefit_amount){
						benefitstotal+=Number(values.benefit_amount);
						document.getElementById("benefitstotal").placeholder = benefitstotal;
						grosspremium+=Number(values.benefit_amount);
						document.getElementById("grosspremium").value = "KSH " + grosspremium;
					}
					if(values.benefit_minimum_premium){
						let suinsured = "<?php echo"$suinsured"?>";
						let benefit_premium=(Number(values.benefit_rate)*suinsured)/100;
						benefit_premium = Math.ceil((0.45/100)*benefit_premium+benefit_premium);

						if(benefit_premium<Number(values.benefit_minimum_premium)){
							benefitstotal+=Number(values.benefit_minimum_premium);
							document.getElementById("benefitstotal").placeholder = benefitstotal;
							grosspremium+=Number(values.benefit_minimum_premium);
							document.getElementById("grosspremium").value = "KSH " + grosspremium;
						}else{
							//capture decimal foward 
							benefitstotal+=Number(benefit_premium);
							document.getElementById("benefitstotal").placeholder = benefitstotal;
							grosspremium+=benefit_premium;
							document.getElementById("grosspremium").value = "KSH " + grosspremium;
						}
						
					}
				}else{
					let elem = document.getElementById(values.benefit_id + "optional" );
					elem.parentNode.removeChild(elem);
					if(values.benefit_amount){
						benefitstotal=Number(benefitstotal)-Number(values.benefit_amount);
						grosspremium-=Number(values.benefit_amount);
						document.getElementById("grosspremium").value = "KSH " + grosspremium;
						document.getElementById("benefitstotal").placeholder = benefitstotal;
					}
					if (values.benefit_minimum_premium){
						let suinsured = "<?php echo"$suinsured"?>";
						let benefit_premium=(values.benefit_rate*suinsured)/100
						benefit_premium = Math.ceil((0.45/100)*benefit_premium+benefit_premium);

						if(benefit_premium<Number(values.benefit_minimum_premium)){
							benefitstotal-=Number(values.benefit_minimum_premium);
							document.getElementById("benefitstotal").placeholder = benefitstotal;
							grosspremium-=Number(values.benefit_minimum_premium);
							document.getElementById("grosspremium").value = "KSH " + grosspremium;
						}else{
							//capture decimal foward 
							benefitstotal-=Number(benefit_premium);
							document.getElementById("benefitstotal").placeholder = benefitstotal;
							grosspremium-=benefit_premium;
							document.getElementById("grosspremium").value = "KSH " + grosspremium;
						}

					}

				}
			}
			// console.log(values);


		}
		function handle_input(input){
			let id = input.id.replace(/inputs/gi, "");
			let parrent = document.getElementById(id);
			let inputval = Number(input.value);
			values=JSON.parse(parrent.value);
			switch(values.benefit_name){
				case "WINDSCREEN":
				case "RADIO_CASSETE":
					if(Number(inputval)>Number(values.benefit_freelimit)){
						let diff = inputval - Number(values.benefit_freelimit)
						
						let i = Math.ceil(((Number(values.benefit_rate)/100)*diff));
						// console.log(i);
						benefit_premium = Math.ceil(((0.45/100)*i)+i);
						benefitstotal+=benefit_premium;
						document.getElementById("benefitstotal").placeholder = benefitstotal;
						grosspremium+=Number(benefit_premium);
						document.getElementById("grosspremium").value = "KSH " + grosspremium;
						console.log(grosspremium);
					}
					break;
				case "PASSENGER_LEGAL_LIABILITY":
					let benefit_amount = Number(values.benefit_amount);
					let premium = benefit_amount*inputval;
					benefit_premium = Math.ceil((0.45/100)*premium+premium);
					benefitstotal+=benefit_premium;
					document.getElementById("benefitstotal").placeholder = benefitstotal;
					grosspremium+=Number(benefit_premium);
					document.getElementById("grosspremium").value = "KSH " + grosspremium;
					break;
				case "COURTESY_CAR":
					benefit_premium = Math.ceil((0.45/100)*inputval+inputval);
					benefitstotal+=benefit_premium;
					document.getElementById("benefitstotal").placeholder = benefitstotal;
					grosspremium+=Number(benefit_premium);
					document.getElementById("grosspremium").value = "KSH " + grosspremium;
					break;
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
			document.getElementById("loading-text").innerHTML = "Processing....";
		});
	</script>
<?php include "chat/chat.php"?>

</body>

</html>
