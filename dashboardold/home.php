<?php
	include "session.php";
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}    
    $user=select_user($_SESSION["userid"]);
    // print_r($user);
?>
<!-- <html>
<head>
<meta http-equiv="refresh" content="60">
</head>
</html> -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <!-- <section class="content container-fluid"> -->
      <div class="row md-3">
        <!-- get alert stock -->
        <?php
        $user_id = $_SESSION["code"];
        if($_SESSION['role']=="super_admin"){
          $result = $pdo->prepare("SELECT count(*) FROM tbl_user where role = 'agent'"); 
        } else{
          $result = $pdo->prepare("SELECT count(*) FROM tbl_user where agent = '$user_id' AND role = 'agent'"); 
        }
        $result->execute();
        $number_of_rows = $result->fetchColumn(); 
        ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-archive"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Agents</span>
              <?php if($number_of_rows > 0){?>
              <span class="info-box-number"><small><?php echo $number_of_rows;?></small></span>
              <?php }else{?>
              <span class="info-box-text"><strong>0</strong></span>
              <?php }?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


        <!-- get total products-->
        <?php
        #print_r($_SESSION);
        if($_SESSION['role']=="super_admin"){
          $result = $pdo->prepare("SELECT count(*) FROM tbl_policy");
        }else{
          $result = $pdo->prepare("SELECT count(*) FROM tbl_policy where agent = '$user_id'"); 
        }
        $result->execute(); 
        $number_of_rows = $result->fetchColumn(); 
        ?>
        <!-- get total products notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-archive"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Policies</span>
              <?php if($number_of_rows > 0){?>
              <span class="info-box-number"><small><?php echo $number_of_rows;?></small></span>
              <?php }else{?>
              <span class="info-box-text"><strong>0</strong></span>
              <?php }?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

         <!-- get total products notification -->
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-align-right"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Endorsements</span>
              <span class="info-box-number"><small><?php echo 0 ?></small></span>
            </div>
            
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- get total products notification -->
        <?php
        if($_SESSION['role']=="super_admin"){
          $result = $pdo->prepare("SELECT count(*) FROM tbl_user");
        }else{
          $result = $pdo->prepare("SELECT count(*) FROM tbl_user where agent = '$user_id'"); 
        }
        $result->execute(); 
        $number_of_rows = $result->fetchColumn(); 
        ?>

        <!-- get total products notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-archive"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">My Users</span>
              <?php if($number_of_rows > 0){?>
              <span class="info-box-number"><small><?php echo $number_of_rows;?></small></span>
              <?php }else{?>
              <span class="info-box-text"><strong>0</strong></span>
              <?php }?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- get total products notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-umbrella"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Claims</span>
              <span class="info-box-number"><small><?php echo 0 ?></small></span>
            </div>
            
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- get total products notification -->
        <?php
        if($_SESSION['role']=="super_admin"){
          $result = $pdo->prepare("SELECT count(*) FROM tbl_client"); 
        }else{
          $result = $pdo->prepare("SELECT count(*) FROM tbl_client where owner = '$user_id'"); 
        }
        
        $result->execute(); 
        $number_of_rows = $result->fetchColumn(); 
        ?>

        <!-- get total products notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-archive"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Clients</span>
              <?php if($number_of_rows > 0){?>
              <span class="info-box-number"><small><?php echo $number_of_rows;?></small></span>
              <?php }else{?>
              <span class="info-box-text"><strong>0</strong></span>
              <?php }?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- get today transactions -->
        <?php
        if($_SESSION['role']=="super_admin"){
          $result = $pdo->prepare("SELECT count(*) FROM tbl_quote");
        }else{
          $result = $pdo->prepare("SELECT count(*) FROM tbl_quote where agent = '$user_id'"); 
        }
        $result->execute(); 
        $number_of_rows = $result->fetchColumn(); 
        ?>

        <!-- get total products notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-archive"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Quotes</span>
              <?php if($number_of_rows > 0){?>
              <span class="info-box-number"><small><?php echo $number_of_rows;?></small></span>
              <?php }else{?>
              <span class="info-box-text"><strong>0</strong></span>
              <?php }?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- get today income -->
        <?php
        $select = $pdo->prepare("SELECT sum(total) as total FROM tbl_invoice WHERE order_date = CURDATE()");
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $total = $row->total ;
        ?>
         <!-- get today income -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">My Cash</span>
              <span class="info-box-number"><small>Ksh. <?php echo number_format($total,0); ?></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

      </div>
    </section>
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
            $select = $pdo->prepare("SELECT * FROM `underwriters` WHERE NOT (Name LIKE '%life%' or Name LIKE '%Pioneer Assurance Company Limited%' or Name LIKE '%Health%' or Name LIKE '%Jubilee General Insurance Limited%')");
            $select->execute();
            while($row = $select->fetch(PDO::FETCH_ASSOC)){
                extract($row);		
            ?>
            <div class="col-md-4 col-sm-6 wow fadeIn animated" id = "<?php echo str_replace(' ', '', $row['Name'])?>" hidden="hidden" data-wow-delay="0.2s">
                <div class="img_wrapper">
                    <div class="img_container" style="height:233px; ">
                        <a href="underwriter.php?<?php echo $row['Name']?>" class="fill" id="underwriter">
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
            $select = $pdo->prepare("SELECT * FROM `underwriters` WHERE NOT (Name LIKE '%life%' or Name LIKE '%Pioneer Assurance Company Limited%' or Name LIKE '%Health%' or Name LIKE '%Jubilee General Insurance Limited%') ORDER BY Name LIMIT $start_from, $record_per_page");
            $select->execute();
            while($row = $select->fetch(PDO::FETCH_ASSOC)){
                extract($row);		
            ?>
            <div class="col-md-4 col-sm-6 wow fadeIn animated" data-wow-delay="0.2s">
                <div class="img_wrapper">
                    <div class="img_container" style="height:233px;">
                    <a href="../underwriter.php?underwriter=<?php echo $row['Name']?>&&description=<?php echo $row['description']?>">
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
  <!-- /.content-wrapper -->

<script>
$(document).ready( function () {
    $('#myProduct').DataTable();
} );
</script>
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
				xmlhttp.open("GET", "../results.php?q="+str, true);
				xmlhttp.send();
			}
		}
        function handleClear(id){
			document.getElementById("txtHint").innerHTML = "";
			document.getElementById('underwriterlistseen').style.display = 'block';
			document.getElementById("underwriterlist").style.display = 'none';
			location.reload();
			return false;

			// document.getElementById(id).removeEventListener("click", function(e) { e.preventDefault(); }, false);
		}
	</script>
<?php
include_once'inc/footer_all.php';
?>