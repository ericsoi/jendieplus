<?php
    include_once'db/connect_db.php';
    session_start();
    if($_SESSION['role']=="Admin"){
      include_once'inc/header_all.php';
    }else{
        include_once'inc/header_all_operator.php';
    }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <!-- get alert stock -->
        <?php
        $select = $pdo->prepare("SELECT * FROM tbl_product");
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $total1 = $row->product_code;
        //print_r($row);
        ?>
        <!-- get alert notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-archive"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Agents</span>
              <?php if($total1==true){ ?>
              <span class="info-box-number"><small><?php echo 0;?></small></span>
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
        $select = $pdo->prepare("SELECT count(product_code) as t FROM tbl_product");
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $total = $row->t;
        ?>

        <!-- get total products notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-cubes"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Policies</span>
              <span class="info-box-number"><small><?php echo $row->t ?></small></span>
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
              <span class="info-box-number"><small><?php echo $row->t ?></small></span>
            </div>
            
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- get total products notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-btc"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PREMIUM Payments</span>
              <span class="info-box-number"><small><?php echo $row->t ?></small></span>
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
              <span class="info-box-number"><small><?php echo $row->t ?></small></span>
            </div>
            
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- get total products notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Clients</span>
              <span class="info-box-number"><small><?php echo $row->t ?></small></span>
            </div>
            
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- get today transactions -->
        <?php
        $select = $pdo->prepare("SELECT count(invoice_id) as i FROM tbl_invoice WHERE order_date = CURDATE()");
        $select->execute();
        $row=$select->fetch(PDO::FETCH_OBJ);
        $invoice = $row->i ;
        ?>
         <!-- get today transactions notification -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Quotes</span>
              <span class="info-box-number"><small><?php echo $row->i ?></small></span>
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

      <div class="col-md-offset-1 col-md-10">
        <div class="box box-success">
          <div class="box-header with-border">
              <h3 class="box-title">Latest Quotes</h3>
          </div>
          <div class="box-body">
            <div class="col-md-offset-1 col-md-10">
              <div style="overflow-x:auto;">
                  <table class="table table-striped" id="myBestProduct">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Name</th>
                              <th>Vehicle Reg</th>
                              <th>Coverage</th>
                              <th>Quatation Date</th>
                              <th>Pendapatan</th>
                          </tr>

                      </thead>
                      <tbody>
                          <?php
                          $no = 1;
                          $select = $pdo->prepare("SELECT product_code,product_name,price,product_satuan,sum(qty) as q, sum(qty*price) as total FROM
                          tbl_invoice_detail GROUP BY product_id ORDER BY sum(qty) DESC LIMIT 30");
                          $select->execute();
                          while($row=$select->fetch(PDO::FETCH_OBJ)){
                          ?>
                              <tr>
                              <td><?php echo $no++ ;?></td>
                              <td><?php echo $row->product_name; ?></td>
                              <td><?php echo $row->product_code; ?></td>
                              <td><?php echo $row->q; ?>
                              <span><?php echo $row->product_satuan; ?></span>
                              </td>
                              <td>Rp <?php echo number_format($row->price);?></td>
                              <td>Rp <?php echo number_format($row->total); ?></td>
                              </tr>

                        <?php
                          }
                        ?>
                      </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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

#2780c2