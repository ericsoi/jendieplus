<?php
  include_once'db/connect_db.php';
  session_start();
  if($_SESSION['role']!=="Admin"){
    header('location:index.php');
  }

  if(isset($_POST['btn_edit'])){
      $vehicle_model = $_POST['vehicle_model'];
      $update = $pdo->prepare("UPDATE tbl_excluded_vehicles SET vehicle_model='$vehicle_model' WHERE vehicle_id='".$_GET['id']."' ");
      $update->bindParam(':cat_name', $vehicle_model);
      if($update->execute()){
        echo'<script type="text/javascript">
        jQuery(function validation(){
        swal("Success", "Vehicle list Has Been Updated", "success", {
        button: "Continue",
            });
        });
        </script>';
      }else{
        echo'<script type="text/javascript">
        jQuery(function validation(){
        swal("Success", "Vehicle added success", "success", {
        button: "Continue",
            });
        });
        </script>';
      }
  }

  if($id=$_GET['id']){
    $select = $pdo->prepare("SELECT * FROM tbl_excluded_vehicles WHERE vehicle_id = '".$_GET['id']."' ");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_OBJ);
    $cat_name = $row->cat_name;
  }else{
    header('location:excluded_vehicles.php');
  }

  include_once'inc/header_all.php';

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Excluded Vehicles
      </h1>
      <hr>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
       <!-- Category Form-->
      <div class="col-md-4">
            <div class="box box-warning">
                <!-- /.box-header -->
                <!-- form start -->
                <form action="" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="vehicle_model">Vehicle Model</label>
                      <input type="text" class="form-control" name="vehicle_model" placeholder="Enter Vehicle Model"
                      value="<?php echo $vehicle_model; ?>" required>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary" name="btn_edit">Update</button>
                      <a href="excluded_vehicles.php" class="btn btn-warning">Back</a>
                  </div>
                </form>
            </div>
      </div>

      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Kategori</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Vehicle Model</th>
                  </tr>
              </thead>
              <tbody>
              <?php
              $select = $pdo->prepare('SELECT * FROM tbl_excluded_vehicles');
              $select->execute();
              while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                <tr>
                  <td><?php echo $row->vehicle_id; ?></td>
                  <td><?php echo $row->vehicle_model; ?></td>
                </tr>
              <?php
              }
              ?>

              </tbody>
          </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
    include_once'inc/footer_all.php';
?>
