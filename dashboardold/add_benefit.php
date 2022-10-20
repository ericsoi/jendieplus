<?php
  include_once'db/connect_db.php';
  session_start();
  // if($_SESSION['role']!=="Admin"){
  //   header('location:index.php');
  // }
  include_once'inc/header_all.php';
  $product_id =$_GET['id'];
  if(isset($_POST['submit'])){
    if(isset($_POST['benefit_name'])){
      $benefit_name = trim($_POST['benefit_name']);
      if (isset($_POST["benefit_rate"])){
        $benefit_rate = $_POST["benefit_rate"];
      }else{
        $benefit_rate = "1";
      }
      $benefit_value = trim($_POST['benefit_value']);
      $select = $pdo->prepare("SELECT benefit_name FROM tbl_benefits WHERE benefit_name='$benefit_name' AND product_id='$product_id'");
      $select->execute();
      if($select->rowCount() > 0 ){
          echo'<script type="text/javascript">
              jQuery(function validation(){
              swal("Warning", "Benefit Already Available", "warning", {
              button: "Continue",
                  });
              });
              </script>';
          }else{
            $insert = $pdo->prepare("INSERT INTO tbl_benefits(benefit_name, benefit_value, benefit_rate, product_id) VALUES(:benefit_name,:benefit_value,:benefit_rate,:product_id)");
            $insert->bindParam(':benefit_name', $benefit_name);
            $insert->bindParam(':benefit_value', $benefit_value);
            $insert->bindParam(':benefit_rate', $benefit_rate);
            $insert->bindParam(':product_id', $product_id);

            if($insert->execute()){
              echo '<script type="text/javascript">
              jQuery(function validation(){
              swal("Success", "New Benefit Added", "success", {
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
                <form action="" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="category">Add Optional Benefit</label>
                      <select class="form-control" name="benefit_name" id="mySelect1" onchange="myFunction()">
                        <?php
                          $select_benefit = $pdo->prepare("SELECT * FROM tbl_benefits_list ORDER BY benefit_name ASC");
                          $select_benefit->execute();
                          while($row_benefit=$select_benefit->fetch(PDO::FETCH_OBJ)){?>
                            <option selected><?php echo $row_benefit->benefit_name?></option>
                        <?php
                          }
                        ?>
                      
                      </select>
                    </div>
                    <div class="form-group" id="entity">
                      <input type="number" class="form-control styled text-center" id="premium" name="benefit_value" placeholder="Enter Free Limit Value" required>
                    </div>
                    <div class="form-group" id="rater">
                      <input type="number" min="1" max="100" class="form-control styled text-center" id="rate" name="benefit_rate" placeholder="Enter Free Limit Rate" required>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <?php if ($_SESSION["role"] == "Super-Admin"){?>
                          <a href="benefits.php?id=<?php echo $product_id; ?>" class="btn btn-warning">Add Benefits</a>
                        <?php
                          }
                        ?>
                      <a href="edit_product.php?id=<?php echo $product_id; ?>" class="btn btn-danger">Back</a>

                  </div>
                </form>
            </div>
      </div>
        <!-- Category Table -->
      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Optional Benefits list</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="overflow-x:auto;">
            <table class="table table-striped" id="myCategory">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Benefit Name</th>
                        <th>Benefit Premium</th>
                        <th>Benefit Rate</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                <?php
                $no = 0;
                $select = $pdo->prepare("SELECT * FROM tbl_benefits Where product_id='$product_id'");
                $select->execute();
                while($row=$select->fetch(PDO::FETCH_OBJ)){?>
                  <tr>
                    <td><?php echo $no ++; ?></td>
                    <td><?php echo $row->benefit_name; ?></td>
                    <td><?php echo $row->benefit_value; ?></td>
                    <?php if ($row->benefit_rate == "1"){?>
                      <td>-</td>
                    <?php
                    } else {?>
                      <td><?php echo $row->benefit_rate; ?> </td>
                    <?php
                    }
                    ?>
                    <td>
                        <a href="edit_benefit.php?id=<?php echo $row->benefit_id; ?>"
                        class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a>
                        <a href="delete_benefit.php?id=<?php echo $row->benefit_id; ?>"
                        onclick="return confirm('Delete Benefit?')"
                        class="btn btn-danger btn-sm" name="btn_delete"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php
                }
                ?>
Microsoft!5
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
  <script type="text/javascript">
  function myFunction() {
		var x = document.getElementById("mySelect1");
		var text=x.options[x.selectedIndex].text;
		console.log(x);
    if ((text == "POLITICAL_VIOLENCE_AND_TERRORISM") || (text == "EXCESS_PROTECTOR")){
      // document.getElementById("entity").innerHTML = '<div class="form-group" id="value">\
      //   <input type="number" class="form-control styled text-center" id="premium" name="benefit_value" placeholder="Enter Premium" required>\
      // </div>';
      document.getElementById("entity").innerHTML ="";
      document.getElementById("rater").innerHTML = '<div class="form-group" id="rate">\
        <input type="text" type="number" min="0" max="2" step="any" class="form-control styled text-center" id="rate1" name="benefit_rate" placeholder="Enter Rate" required onchange="handeChange(this.id, this.value)">\
      </div>';
    }else if(text == "AA_ROAD_RESQUE" || text == "PASSENGER_LEGAL_LIABILITY" || text == "INFAMA_ROAD_RESQUE" || text == "AMREF" || text == "BIMALIFE" || text == "PERSONAL_ACCIDENT"){
      document.getElementById("entity").innerHTML = '<div class="form-group" id="value">\
        <input type="number" class="form-control styled text-center" id="premium" name="benefit_value" placeholder="Enter Value" required>\
      </div>';
      document.getElementById("rater").innerHTML ="";
    }else{
      document.getElementById("entity").innerHTML = '<div class="form-group" id="value">\
        <input type="number" class="form-control styled text-center" id="premium" name="benefit_value" placeholder="Enter Free Limit" required>\
      </div>';
      document.getElementById("rater").innerHTML = '<div class="form-group" id="rate">\
        <input type="number"  type="number" min="1" max="100" class="form-control styled text-center" id="rate" name="benefit_rate" placeholder="Enter Free Limit Rate" required>\
      </div>';
    }
  }
  function handeChange(id, value){
    if(parseFloat(value) > 1 || parseFloat(value)< 0){
      document.getElementById(id).value = "";
      alert("Allowed Values(0-1)")
    }
  }
  </script>
  <script>
  $(document).ready( function () {
      $('#myCategory').DataTable();
  } );
  </script>

<?php
  include_once'inc/footer_all.php';
?>