<?php
    include_once'db/connect_db.php';
    session_start();
    if($_SESSION['username']==""){
      header('location:index.php');
    }else{
        include_once'inc/header_all.php';
      
      }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-success">
            <div class="box-body">
              <?php
                $id = $_GET['id'];
                $select1 = $pdo->prepare("SELECT * FROM tbl_excluded_vehicles WHERE product_id=$id");
                $select1->execute();
                $total_records = $select1->rowCount();
                
                $select = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id=$id");
                $select->execute();
                while($row = $select->fetch(PDO::FETCH_OBJ)){?>

                <div class="col-md-6">
                  <ul class="list-group">

                    <center><p class="list-group-item list-group-item-success">Product Details</p></center>
                    <li class="list-group-item"> <b>Product Number</b>     :<span class="label badge pull-right"><?php echo $row->product_id; ?></span></li>
                    <li class="list-group-item"><b>Product Category</b>    :<span class="label label-info pull-right"><?php echo $row->category; ?></span></li>
                    <li class="list-group-item"><b>Vehicle Class</b>        :<span class="label label-primary pull-right"><?php echo $row->vehicleclass; ?></span></li>
                    <li class="list-group-item"><b>Underwriter</b>  :<span class="label label-warning pull-right"><?php echo $row->underwriter; ?></span></li>
                    <li class="list-group-item"><b>Coverage</b>     :<span class="label label-warning pull-right"><?php echo $row->coverage; ?></span></li>
                    <li class="list-group-item"><b>Clauses</b>           :<span class="label label-success pull-right">Rp. <?php echo $row->clauses; ?></span></li>
                    <li class="list-group-item"><b>Conditional Warranties </b>          :<span class="label label-default pull-right"><?php echo $row->conditionsandwaranties; ?></span></li>
                    <li class="list-group-item"><b>Optional Benefit </b>   :<span class="label label-default pull-right"><?php echo $row->optionalname; ?></span></li>
                    <li class="list-group-item"><b>Optional Benefits Premium</b>               :<span class="label label-default pull-right"><?php echo $row->optionalpremium; ?></span></li>
                    <li class="list-group-item"><b>Optional Benefits Rate</b>    :<span class="label label-default pull-right"><?php echo $row->optionalrate; ?></span></li>
                    <li class="list-group-item" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"></a> <b>Excluded Vehicles</b>:<i class="fa fa-arrow-down" aria-hidden="true"></i><span class="label badge pull-right"><?php echo $total_records; ?></span>
                    <div class="row">
                      <div class="container">
                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                          <?php 
                            if($total_records >0){
                              $i=0;
                              while($row1 = $select1->fetch(PDO::FETCH_OBJ)){$i++?>
                              <div> <?php echo $i . " ". $row1->vehicle_model;?></div>
                              <?php
                                }}
                              ?>
                            </div>
                          </div>
                      </li>
                    <li class="list-group-item col-md-12"><span class="text-muted"><?php echo $row->description ?></span></li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <ul class="list-group">
                    <center><p class="list-group-item list-group-item-success">Product Details</p></center>
                    <li class="list-group-item"> <b>Policy Limits and benefits</b>     :<span class="label badge pull-right"><?php echo $row->policylimits; ?></span></li>

                    <li class="list-group-item"> <b>Annual Rates</b>     :<span class="label badge pull-right"><?php echo $row->annualrates; ?></span></li>
                    <li class="list-group-item"> <b>Monthly Rates</b>     :<span class="label badge pull-right"><?php echo $row->monthlyrates; ?></span></li>
                    <li class="list-group-item"> <b>Weekly Rates</b>     :<span class="label badge pull-right"><?php echo $row->weeklyrates; ?></span></li>
                    <li class="list-group-item"> <b>Fortnight Rates</b>     :<span class="label badge pull-right"><?php echo $row->fortnightrates; ?></span></li>
                    <li class="list-group-item"> <b>Passangers</b>     :<span class="label badge pull-right"><?php echo $row->passangers; ?></span></li>
                    <li class="list-group-item"> <b>Minimum Premium</b>     :<span class="label badge pull-right"><?php echo $row->minimumpremium; ?></span></li>
                    <li class="list-group-item"> <b>Maximum Tonnage</b>     :<span class="label badge pull-right"><?php echo $row->maxage; ?></span></li>
                    <li class="list-group-item"> <b>Minimum Tonnage</b>     :<span class="label badge pull-right"><?php echo $row->minage; ?></span></li>
                    <li class="list-group-item"> <b>Maximum Sum Insured</b>     :<span class="label badge pull-right"><?php echo $row->maxsum; ?></span></li>
                    <li class="list-group-item"> <b>Minimum Sum Insured</b>     :<span class="label badge pull-right"><?php echo $row->minsum; ?></span></li>
                    <li class="list-group-item"> <b>Time Created</b>     :<span class="label badge pull-right"><?php echo $row->time; ?></span></li>

                  </ul>
                </div>
              <?php
                }
              ?>
            </div>
            <div class="box-footer">
                <a href="product.php" class="btn btn-warning">Back</a>
            </div>

        </div>

  
    
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php
    include_once'inc/footer_all.php';
 ?>