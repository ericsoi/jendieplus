<?php
    include_once'db/connect_db.php';
    include_once'../config/db.php';
    include 'livechat.php';

    if(session_id() == ''){
      session_start();
      
    }
    include_once"permmission.php";
    
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- get alert stock -->
        <?php
        $user_id = $_SESSION["code"];
        if($_SESSION['role']=="Super-Admin"){
          $result = $pdo->prepare("SELECT count(*) FROM tbl_user where role = 'Agent'"); 
        } else{
          $result = $pdo->prepare("SELECT count(*) FROM tbl_user where agent = '$user_id' AND role = 'Agent'"); 
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
        if($_SESSION['role']=="Super-Admin"){
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
        if($_SESSION['role']=="Super-Admin"){
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
        if($_SESSION['role']=="Super-Admin"){
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
        if($_SESSION['role']=="Super-Admin"){
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
<div class="container-fluid" id="underwriters">
  <div class="main_title">
    <h4>Partner<span> Insurance</span> Companies</h4>
    <h5>Select your preferred Insurer among our Partner Insurance Companies</h5>
  </div>
  <div class="row">
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
    $UnderwriterQuery  = "SELECT * FROM `underwriters` WHERE NOT (Name LIKE '%life%' or Name LIKE '%Pioneer Assurance Company Limited%' or Name LIKE '%Health%') ORDER BY Name LIMIT $start_from, $record_per_page";
    $UnderwriterResult  = mysqli_query($connection, $UnderwriterQuery);
    while($UnderwriterRow = mysqli_fetch_assoc($UnderwriterResult)){
    ?>
    <div class="col-md-4 col-sm-6 wow fadeIn animated" data-wow-delay="0.2s">
      <div class="img_wrapper">
        <div class="img_container" style="height:233px;">
          <a>
            <img src="<?php echo $UnderwriterRow['path']?>" width="100%" height="100px" class="img-responsive" alt="">
            <div class="short_info">
              <h3><?php echo $UnderwriterRow["Name"]?></h3>
              <em>Comprehensive &amp; Third-party</em>
              <p>
                <?php echo $UnderwriterRow["description"]?>
              </p>
                <form action="underwriter.php" method="post">
                  <input type="hidden" name="description" value="<?php echo $UnderwriterRow['description']?>">
                  <input type="hidden" name="underwriter" value="<?php echo $UnderwriterRow['Name']?>">
                  <button type="submit" class="btn btn-lg btn-huge btn-danger">View Products</button>
                </form>

              <div class="score_wp">
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
        $page_query = "SELECT * FROM `underwriters` WHERE NOT (Name LIKE '%life%' or Name LIKE '%Pioneer Assurance Company Limited%' or Name LIKE '%Health%') ORDER BY Name DESC";
        $page_result = mysqli_query($connection, $page_query);
        $total_records = mysqli_num_rows($page_result);
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
  $(document).ready( function () {
      $('#myBestProduct').DataTable();
  } );
  </script>


 <?php
    include_once'inc/footer_all.php';
 ?>