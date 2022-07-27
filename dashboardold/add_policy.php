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
            $insert = $pdo->prepare("INSERT INTO tbl_policy(user_identifier, agent_admin, agent, data, status) VALUES(:benefit_name,:benefit_value,:benefit_rate,:product_id)");
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
      <div class="col-md-12">
            <div class="box box-success">
                <!-- /.box-header -->
                <!-- form start -->
                <form action="" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="category">Add Policy</label>
                      
                      
                      </select>
                    </div>
                    <div class="form-group" id="entity">
                      <input type="text" class="form-control styled text-center" id="premium" name="benefit_value" placeholder="Enter First Name" required>
                    </div>
                    <div class="form-group" id="rater">
                      <input type="text" min="1" max="100" class="form-control styled text-center" id="rate" name="benefit_rate" placeholder="Last Name" required>
                    </div>
                    <div class="form-group" id="rater">
                      <input type="text" min="1" max="100" class="form-control styled text-center" id="rate" name="benefit_rate" placeholder="Intermediary" required>
                    </div>
                    <div class="form-group" id="rater">
                      <input type="text" min="1" max="100" class="form-control styled text-center" id="rate" name="benefit_rate" placeholder="Policy Number" required>
                    </div>
                    <div class="form-group" id="rater">
                      <input type="text" min="1" max="100" class="form-control styled text-center" id="rate" name="benefit_rate" placeholder="Vehicle Details" required>
                    </div>
                    <div class="form-group" id="rater">
                      <input type="text" min="1" max="100" class="form-control styled text-center" id="rate" name="benefit_rate" placeholder="Coverage" required>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select class="form-control" name="underwriter">
                          <option>Active</option>
                          <option>Inactive</option>

                        </select>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                      <a href="policies.php?id=<?php echo $product_id; ?>" class="btn btn-danger">Back</a>

                  </div>
                </form>
            </div>
      </div>
        <!-- Category Table -->
      


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- DataTables Function -->
  <script type="text/javascript">
  function myFunction() {
		var x = document.getElementById("mySelect1");
		var text=x.options[x.selectedIndex].text;
		console.log(text);
    if ((text == "POLITICAL_VIOLENCE_AND_TERRORISM") || (text == "EXCESS_PROTECTOR")){
      document.getElementById("entity").innerHTML = '<div class="form-group" id="value">\
        <input type="number" class="form-control styled text-center" id="premium" name="benefit_value" placeholder="Enter Premium" required>\
      </div>';
      document.getElementById("rater").innerHTML = '<div class="form-group" id="rate">\
        <input type="number" type="number" min="1" max="100" class="form-control styled text-center" id="rate" name="benefit_rate" placeholder="Enter Rate" required>\
      </div>';
    }else if(text == "AA_ROAD_RESQUE" || text == "INFAMA_ROAD_RESQUE" || text == "AMREF" || text == "BIMALIFE" || text == "PERSONAL_ACCIDENT"){
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
  </script>
  <script>
  $(document).ready( function () {
      $('#myCategory').DataTable();
  } );
  </script>

<?php
  include_once'inc/footer_all.php';
?>