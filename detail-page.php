<?php 
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
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
    if(isset($_GET)){
        $copy = $_GET;
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
	if(isset($_GET["passangers"])){
		$passangers="-".$_GET["passangers"];
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
	if (isset($_SESSION["client_details"])){
		unset($_SESSION["client_details"]);
	}
	if(isset($_SESSION["product"])){
		unset ($_SESSION['product']);
	}
    $_SESSION["client_details"] = $_GET;
    if(!isset($_SESSION["underwriter"])) { 
		header("refresh:0;url=./index.php");
	}else{
		$underwriter = trim($_SESSION["underwriter"]["Name"]);
		$description = trim($_SESSION["underwriter"]["description"]);
        $coverage =  trim($_SESSION["cover"]["cover"]);
        $referal_code = trim($_SESSION["client_details"]["referal_code"]);
        $vehicleclass = trim($_SESSION["client_details"]["vehicleclass"]);
		$productcode=strtolower("-".$referal_code."-".$underwriter."-".$vehicleclass."-".$coverage);
		$productcode= preg_replace('[ ]', '', $productcode);

	}


function t2($val, $min, $max) {
	return ($val >= $min && $val <= $max);
}


$select = $pdo->prepare("SELECT * FROM tbl_product where product_code = '$productcode'");
$select->execute();
$product=False;$tonnage=0; $suinsured=0; $passengers=0;
if($select->rowCount()>0){
	// print_r($_SESSION);
	$name=$_SESSION["client_details"]['name_contact'];$phone=$_SESSION["client_details"]['phone_number'];
	$email=$_SESSION["client_details"]['email'];$vehicle_reg=$_SESSION["client_details"]['vehicle_reg'];
	$vehicle_class=$_SESSION["client_details"]['vehicleclass'];$coverage=$_SESSION["cover"]["cover"];
	$period=$_SESSION["client_details"]['coverperiod'];$underwriter=$_SESSION["underwriter"]['Name'];
	$quatation_date=date("d/m/Y h:i:s");$premium="";$agency='';$agent=$_SESSION["client_details"]["referal_code"];
	$saminsured="";$tonnage="";$passengers="";$details='';
	while($row = $select->fetch(PDO::FETCH_ASSOC)){
		if ($row["product_code"]==$row["uniqueidentifier"] ){
			if(strlen($row[$copy["coverperiod"]])>1){
				$product=True;$tonnage=0;$passangers=0;$saminsured=0;
				// $product=True;$tonnage["name"]='Tonnage';$tonnage["value"]= 0; $suinsured["name"]='Sum Insured';$suinsured["value"]= 0;$passengers["name"]='Passengers';$passengers["value"]= 0;
				$_SESSION['product'] = $row;
				$_SESSION['basicpremium']=$row[$copy["coverperiod"]]?$row[$copy["coverperiod"]]:0;
				$coverperiod=$_GET["coverperiod"];
				$agency=$row["owner"];
				include_once "premiumcalcuator.php";
				grossCalculater();
				$premium=$_SESSION["grosspremium"];
				break;
			}else{
				$_SESSION["product"]['vehicleclass'] = "Product Not Found. Kindly contact the agent code owner";$_SESSION["product"]['coverperiod'] = False;$_SESSION["product"]['policylimits']= False;$coverperiod=false;$_SESSION["grosspremium"]=false;
			}
		}else{
			if(isset($copy['tonnage'])){
				if(getRange($copy['tonnage'],$row['mintonnage'],$row['maxtonnage']) && strlen($row[$copy["coverperiod"]])>1){
					
					$product=True;$tonnage=$copy['tonnage'];$passangers=0;$saminsured=0;
					// $product=True;$tonnage["name"]='Tonnage';$tonnage["value"]= $copy['tonnage']; $suinsured["name"]='Sum Insured';$suinsured["value"]= 0;$passengers["name"]='Passengers';$passengers["value"]= 0;
					$_SESSION['product'] = $row;
					$_SESSION['basicpremium']=$row[$copy["coverperiod"]]?$row[$copy["coverperiod"]]:0;
					$coverperiod=$_GET["coverperiod"];
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
					$coverperiod=$_GET["coverperiod"];
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
				$age=date("Y")-$copy["yom"];
				// echo getRange($copy['sum_insured'], $row["minsum"], $row["maxsum"]);
			
				// echo "<br>".$row["minage"];
				// echo  getRange($age, $row["minage"], $row["maxage"]);
				if(getRange($age, $row["minage"], $row["maxage"]) && getRange($copy['sum_insured'], $row["minsum"], $row["maxsum"])){
					$_SESSION['product'] = $row;
					// print_r($row);
					$product=True;$tonnage=0;$passangers=0;$saminsured=$copy['sum_insured'];
					// $product=True;$tonnage["name"]='Tonnage';$tonnage["value"]= 0; $suinsured["name"]='Sum Insured';$suinsured["value"]= 0;$passengers["name"]='Passengers';$passengers["value"]= 0;
					$suinsured=$copy['sum_insured'];
					$premium=$copy['sum_insured']*($row[$copy["coverperiod"]]/100);
					$agency=$row["owner"];
					if($premium<=$row["minimumpremium"]){
						$_SESSION['basicpremium']=$row["minimumpremium"];
					}elseif($premium>=$row["minimumpremium"]){
						$_SESSION['basicpremium']=$premium;
					}
					$coverperiod=$_GET["coverperiod"];
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
		<form method="get" action="quote_step2.php">

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

					<div class="tab-content">
						<div class="tab-pane in active" id="tab_1">
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
													$value=$row["benefit_rate"]."-".$row["benefit_freelimit"]."-".$row["benefit_days"]."-".$row["benefit_amount"];
												
									?>		
									<div class="form-check">	
										<div class="feature-box-icon">
											<input type="checkbox" name = "<?php echo $row['benefit_name']?>" class="form-check-input" value = "<?php echo $value ?>" id="<?php echo $row['benefit_id']?>" onchange= "handleoptional_benefits(this)">
											<label class="form-check-label" for="<?php echo $row['benefit_id']?>"><?php echo str_replace("_", " ", $row["benefit_name"])?></label>
				
											<div id="<?php echo 'input'.$row['benefit_id']?>">
											</div>
										</div>
									</div>
									<?php
										}
                                    
									?>
									<input type="hidden" class="form-group" id="benefittotal"value="Total: 0" readonly> </input>
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
						<div class="price">
							<small>GROSS PREMIUM</small><br><small id="grosspremium">KSH <?php echo $_SESSION["grosspremium"]?></small>
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
							
							<?php if(isset($_SESSION["product"]['product_id'])){echo '<div class="form-group"><input type="submit" value="Buy now" class="btn_full"></div>';}else{echo'';}?>
							
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
			<input value="" name="q" type="search" placeholder="Search..." />
			<button type="submit"><i class="icon-search-6"></i>
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
	<script type="text/javascript">

		var added=[]
		var grossfinal = "";
		function calculateGrosspremium(premium, id){
			basicpremium=Math.ceil(premium+(0.45/100 * premium))
			var grosspremium = document.getElementById("grosspremium").innerHTML;
			grosspremium=parseFloat(grosspremium.replace('KSH ', ''));
			grosspremium+=basicpremium;
			added.push({"id":id,"premium":basicpremium});
			grossfinal = grosspremium
			document.getElementById("grosspremium").innerHTML = "KSH " + grosspremium;
		}	
		function removepremium(premium){
			var grosspremium = document.getElementById("grosspremium").innerHTML;
			grosspremium=parseFloat(grosspremium.replace('KSH ', ''));
			grosspremium = grossfinal - premium;
			document.getElementById("grosspremium").innerHTML = "KSH " + grosspremium;
		}	
		function handlewindscreen(id,freelimit,inputvalue){
			document.getElementById(id).readOnly = true;
			var rate = freelimit.split("-")[0];
			freelimit = freelimit.split("-")[1];
			var premium = 0;
			if(inputvalue-freelimit < 0){
				premium=0;
			}else{
				premium=(rate/100)*(inputvalue-freelimit);
			}
			
			calculateGrosspremium(premium, id);
		}
		
		function handlepassanger(id,passangers,value){
			document.getElementById(id).readOnly = true;
			console.log(id,passangers,value);
			premium=passangers*value;
			calculateGrosspremium(premium, id)
			// document.getElementById(id).readOnly = true;
			// var rate = freelimit.split("-")[0];
			// freelimit = freelimit.split("-")[1];
			// var premium = 0;
			// if(inputvalue-freelimit < 0){
			// 	premium=0;
			// }else{
			// 	premium=(rate/100)*(inputvalue-freelimit);
			// }
			
			// calculateGrosspremium(premium, id);
		}
		function handlevalue(id,value){
			var grosspremium = document.getElementById("grosspremium").innerHTML;
			grosspremium=parseFloat(grosspremium.replace('KSH ', ''));
			grosspremium+=parseFloat(value);
			added.push({"id":id,"premium":value});
			grossfinal = grosspremium
			document.getElementById("grosspremium").innerHTML = "KSH " + grosspremium;
		}
		
		function handleoptional_benefits(input){
			inputArray = ["WINDSCREEN", "RADIO_CASSETE", "PASSENGER_LEGAL_LIABILITY","COURTESY_CAR"];
			var benefitlist=[];
			var targetInput = 'input'+input.id;
			// console.log(input.value)
			if (inputArray.includes(input.name) && input.checked){
				if ((input.name == "WINDSCREEN" || input.name == "RADIO_CASSETE")){
					// calculateGrosspremium();
					var value = input.value.split("-")[0] +"-"+ input.value.split("-")[1];
					document.getElementById(targetInput).innerHTML = '\
						<div class="md-form form-sm">\
							<input type="number" tag="ewew" id=form'+input.id+' name='+value+' class="form-control" onchange="handlewindscreen(this.id,this.name, this.value)"></input>\
							<label for='+targetInput+'>Enter Value</label>\
						</div>';
				}else if(input.name == "PASSENGER_LEGAL_LIABILITY"){
					var value = input.value.split("-");
					value = value.pop();
					document.getElementById(targetInput).innerHTML = '\
						<div class="md-form form-sm">\
							<input type="number" tag="ewew" id=form'+input.id+' name='+value+' class="form-control" onchange="handlepassanger(this.id,this.name, this.value)"></input>\
							<label for='+targetInput+'>Enter Value</label>\
						</div>';
				}else if(input.name == "COURTESY_CAR"){
					document.getElementById(targetInput).innerHTML = '\
						<div class="md-form form-sm">\
						<input type="number" tag="ewew" id='+targetInput+' name='+input.value+' class="form-control" onkeyup="handleChange(this.id,this.name)"></input>\
							<label for='+targetInput+'>No of Days</label>\
						</div>';
				}else{
					console.log(" dssdsdsdsdsds ");
					// calculateGrosspremium();
				}
			}else{
				document.getElementById(targetInput).innerHTML = '';
				// added.forEach(add => {
				// for (let key in add) {
				// 	console.log(add[key]);
				// }});
				added.forEach(add => {
					for (let key in add) {
						if(add["id"] == "form"+input.id){
							console.log(add["premium"]);
							removepremium(add["premium"]);
						}
					}});
				
			}
			if (!(inputArray.includes(input.name)) && input.checked){
				console.log(input.value);
				var value = input.value.split("-");
				value = value.pop();
				console.log(value);
				handlevalue("form"+input.id, value);
			}
			if (input.checked){
				benefitlist.push(input.name)
				var ul = document.getElementById("optionalbenefits");
				var li = document.createElement("li");
				li.setAttribute('id',input.id + "optional" );
				li.appendChild(document.createTextNode(input.name));
				ul.appendChild(li);
			}else{
				// console.log(input.id+"optional");
				var elem = document.getElementById(input.id+"optional");
				elem.parentNode.removeChild(elem);
			}
		}


		// $row["benefit_rate"]."-".$row["benefit_freelimit"]."-".$row["benefit_days"]."-".$row["benefit_amount"]
		// var inputs = 0;
		// function handle_input(selector, idString, selectorId){
		// 	var frontName = selector.name.replaceAll("_", " ")
		// 	if(idString.indexOf(selector.name) == -1){
		// 		idString = selector[idString.indexOf(selector.name)];
		// 	}else{
		// 		idString = selector.value;
		// 	}
		// 	if (selector.checked) {
		// 		var ul = document.getElementById("optionalbenefits");
		// 		var li = document.createElement("li");
		// 		console.log(selector.value);
		// 		console.log(idString);
		// 		if (selector.value.indexOf(idString) !== -1){
		// 			var variables = selector.value.split("-");
		// 			console.log("Checked");
		// 			var name = selector.value + "-checked"
		// 			var rate = variables.pop();
		// 			var freeLimit = variables[0];
		// 			// console.log(name);
		// 			// var premium = (rate/100) * freeLimit;
		// 			var targetInput = "input-" + selector.id;
					document.getElementById(targetInput).innerHTML = '\
					<div class="md-form form-sm">\
						<input type="number" tag="ewew" id='+targetInput+' name='+name+' class="form-control" onkeyup="handleChange(this.id,this.name, this.value)"></input>\
						<label for='+targetInput+'>Value</label>\
					</div>';
		// 			li.setAttribute('id',selector.id + "optional" );
		// 			li.appendChild(document.createTextNode(frontName));
		// 			ul.appendChild(li);
		// 		}else{
		// 			var variables = selector.value.split("-");
		// 			var rate = parseFloat(variables.pop())
		// 			var value = parseFloat(variables[0]);
		// 			var premium = value * rate
		// 			var benefittotal = parseFloat(document.getElementById("benefittotal").value.split(": ").pop()) + premium
		// 			// console.log(benefittotal)
		// 			document.getElementById("benefittotal").value = "Total: " + benefittotal;
		// 			li.setAttribute('id',selector.id + "optional" );
		// 			li.appendChild(document.createTextNode(frontName));
		// 			ul.appendChild(li);
		// 		}
        //         // console.log(selector.id);
				
				
				

        //         var grossPremium = parseInt(document.getElementById("grosspremium").innerHTML.split(" ").pop());
		// 		// var totalgrossPremium = grossPremium + subTotal;
		// 		// document.getElementById("grosspremium").value = "KSH " + totalgrossPremium;
				
		// 	}
		// 	else {
		// 		var ul = document.getElementById("optionalbenefits");
		// 		var candidate = document.getElementById(selector.id + "optional");
		// 		var targetInput = "input-" + selector.id;
				
		// 		if (selector.value.indexOf(idString) !== -1){
		// 			var variables = selector.value.split("-");
		// 			var name = selector.value + "-notchecked"
		// 			var rate = variables.pop();
		// 			var freeLimit = variables[0];
		// 			var benefittotal = parseFloat(document.getElementById("benefittotal").value.split(": ").pop()) - parseFloat(inputs)
		// 			document.getElementById("benefittotal").value = "Total: " + benefittotal;
		// 			console.log(inputs);

		// 		}else{
		// 			var variables = selector.value.split("-");
		// 			var name = selector.value + "-notchecked"
		// 			var rate = parseFloat(variables.pop());
		// 			var value = parseFloat(variables[0]);
		// 			var premium = rate*value
		// 			var benefittotal = parseFloat(document.getElementById("benefittotal").value.split(": ").pop()) - parseFloat(premium)
		// 			document.getElementById("benefittotal").value = "Total: " + benefittotal;
		// 			console.log(benefittotal);
		// 		}

		// 		document.getElementById(targetInput).innerHTML = "";
		// 		ul.removeChild(candidate);	
        //     }				
		// }
		// function handleoptional_benefits(clicked_id){
		// 	inputArray = ["WINDSCREEN", "RADIO_CASSETE", "PASSENGER_LEGAL_LIABILITY","COURTESY_CAR"]
		// 	var benefitSelector = document.getElementById(clicked_id);
		// 	handle_input(benefitSelector, inputArray, clicked_id)
		// 	var basicpremium = parseFloat(document.getElementById("grosspremium").innerHTML.split(" ").pop())
		// 	var totalBenefits = parseFloat(document.getElementById("benefittotal").value.split(": ").pop())
		// 	var grossPremium = basicpremium + totalBenefits
		// 	console.log(basicpremium)
		// 	console.log(totalBenefits)
		// 	document.getElementById("grosspremium").innerHTML = "KSH " + grossPremium
		// }
		// function handleChange(id,name,input_value){
		// 	console.log(id, name, input_value)
		// 	isChecked = name.split("-").pop()
		// 	rate = name.split("-")[1]
		// 	value = name.split("-")[0]
		// 	// console.log(value, input_value, rate);
		// 	if (parseFloat(input_value) > parseFloat(value)){
		// 		var premium = (parseFloat(input_value) - parseFloat(value))*parseFloat(rate);
		// 		console.log(premium, "ppp")
		// 		inputs = premium;
		// 		var benefittotal = parseFloat(document.getElementById("benefittotal").value.split(": ").pop()) + premium
		// 		console.log(benefittotal)
		// 		document.getElementById("benefittotal").value = "Total: " + benefittotal;
		// 		console.log(inputs, "lll");
		// 	}

		// 	var additionalOptional = parseInt(name);
		// 	var additionalinput = parseInt(document.getElementById(id).value);
		// 	// if (additionalinput > additionalOptional){
		// 	// 	aditionalTotal = additionalinput = additionalOptional;
		// 	// 	var subTotalOptional = document.getElementById("benefittotal").value.split(": ").pop()
		// 	// 	subTotal = parseInt(subTotalOptional) + parseInt(aditionalTotal);
		// 	// 	document.getElementById("benefittotal").value = "Total: " + subTotal;
		// 	// 	var grossPremium = parseInt(document.getElementById("grosspremium").innerHTML.split(" ").pop());
		// 	// 	var totalgrossPremium = grossPremium + subTotal;
		// 	// 	document.getElementById("grosspremium").innerHTML = "KSH " + totalgrossPremium;

		// 	// }
			
		// }
		
	</script>
<?php include "chat/chat.php"?>

</body>

</html>