<?php
  include_once'db/connect_db.php';
  session_start();
  // if($_SESSION['role']!=="Admin"){
  //   header('location:index.php');
  // }
  include_once'inc/header_all.php';
  $product_id =$_GET['id'];
  if(isset($_POST['submit'])){
    $vehicle_model = trim($_POST['vehicle_model']);
    if(isset($_POST['vehicle_model'])){
      $select = $pdo->prepare("SELECT vehicle_model FROM tbl_excluded_vehicles WHERE vehicle_model='$vehicle_model' AND product_id='$product_id'");
      $select->execute();
      if($select->rowCount() > 0 ){
          echo'<script type="text/javascript">
              jQuery(function validation(){
              swal("Warning", "Vehiclet Already Available", "warning", {
              button: "Continue",
                  });
              });
              </script>';
          }else{
            $insert = $pdo->prepare("INSERT INTO tbl_excluded_vehicles(vehicle_model, product_id) VALUES(:vehicle_model,:product_id)");

            $insert->bindParam(':vehicle_model', $vehicle_model);
            $insert->bindParam(':product_id', $product_id);

            if($insert->execute()){
              echo '<script type="text/javascript">
              jQuery(function validation(){
              swal("Success", "New vehicle Added", "success", {
              button: "Continue",
                  });
              });
              </script>';
            }
          }
    }
  }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
       <!-- Category Form-->
      <div class="col-md-4">
          <div class="box box-success">
              <!-- /.box-header -->
              <!-- form start -->
              <form action="#" method="POST">
                <div class="box-body">
                  <div class="form-group">
                  <label for="exampleInputEmail1">Add Vehicle</label>
                    <input type="text" class="form-control" name="vehicle_model" id="searchvehicle" aria-describedby="emailHelp" autocomplete="off" placeholder="Search Vehicle" onkeyup="showHint(this.value)">
                    <p><span ></span></p>
                    
                    
                  </div>
                  
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <a href="edit_product.php?id=<?php echo $product_id; ?>" class="btn btn-warning">Back</a>
                </div>
                <div class="overflow-scroll">
                  <div id="txtHint"></div>
                </div>
              </form>
          </div>
      </div>
        <!-- Category Table -->
      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Excluded Vehicle List</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="overflow-x:auto;">
            <table class="table table-striped" id="myCategory">
                <thead>
                    <tr>
                        <th>Model</th>
                    </tr>

                </thead>
                <tbody>
                <?php
                $select = $pdo->prepare("SELECT * FROM tbl_excluded_vehicles Where product_id='$product_id'");
                $select->execute();
                while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                  <tr>
                    <td><?php echo $row->vehicle_model; ?></td>
                    <td>
                        <a href="edit_vehicle.php?id=<?php echo $row->vehicle_id ; ?>"
                        class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a>
                        <a href="delete_vehicle.php?id=<?php echo $row->vehicle_id ; ?>"
                        onclick="return confirm('Delete Vehicle?')"
                        class="btn btn-danger btn-sm" name="btn_delete"><i class="fa fa-trash"></i></a>
                    </td>
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

  <!-- DataTables Function -->
  <script>
  $(document).ready( function () {
      $('#myCategory').DataTable();
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
          }
        };
        xmlhttp.open("GET", "results.php?q=" + str, true);
        xmlhttp.send();
      }
    }
    function handleChange(id, value){
      console.log(id, value);
      document.getElementById("searchvehicle").value = value;
    }
  </script>

<?php
  include_once'inc/footer_all.php';
?>