<?php
  include_once'db/connect_db.php';
  session_start();
  // if((! $_SESSION['role']=="Admin") || (! $_SESSION['role']=="Super-Admin")){
  //   header('location:index.php');
  // }


if(isset($_POST['btn_edit'])){
      $is_active = '';
      $role = $_POST['role'];
      switch ($role) {
        case "inactive":
          $is_active = "0";
          break;
        case "active":
          $is_active = "1";
          break;
        default:
          $is_active = "inactive";
          
      }
      $update = $pdo->prepare("UPDATE tbl_user SET is_active='$is_active' WHERE user_id='".$_GET['id']."'");
      $update->bindParam(':is_active', $is_active);
      if($update->rowCount() > 0){
        echo'<script type="text/javascript">
        jQuery(function validation(){
        swal("Warning", "Failure", "warning",{
        button: "Continue",
            });
        });
        </script>';
      }elseif($update->execute()){
        echo'<script type="text/javascript">
        jQuery(function validation(){
        swal("Success", "Updaded Successfully", "success", {
        button: "Continue",
            });
        });
        </script>';
      }
  }
  if(isset($_POST["valluecommission"]) && !empty($_POST["valluecommission"])){
    $commission_value = $_POST["valluecommission"];
    $update = $pdo->prepare("UPDATE tbl_user SET commission_value='$commission_value' WHERE user_id='".$_GET['id']."' ");
    $update->bindParam(':commission_value', $commission_value);
    if($update->rowCount() > 0){
      echo'<script type="text/javascript">
        alert("there was an error updating commission");
      </script>';
    }elseif($update->execute()){
      echo'<script type="text/javascript">
        alert("Succcess");
      </script>';
      
    }
  }
  if(isset($_POST["percentagecommission"]) && !empty($_POST["percentagecommission"])){
      $commission_percentage = $_POST["percentagecommission"];
      $update = $pdo->prepare("UPDATE tbl_user SET commission_percentage='$commission_percentage' WHERE user_id='".$_GET['id']."' ");
      $update->bindParam(':commission_percentage', $commission_percentage);
      if($update->rowCount() > 0){
          echo'<script type="text/javascript">
            alert("there was an error updating commission");
          </script>';
      }elseif($update->execute()){
          echo'<script type="text/javascript">
            alert("Succcess");
          </script>';
      }
  }
if($id=$_GET['id']){
    $select = $pdo->prepare("SELECT * FROM tbl_user WHERE user_id = '".$_GET['id']."' ");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_OBJ);
}else{
    header('location:agent.php');
}
  include 'inc/header_all.php';

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Activation
      </h1>
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
                      <label for="category">Update User</label>
                      <select class="form-control" name="role">
                          <option selected>active</option>
                          <option>inactive</option>
                      </select>
                    </div>
                    <div class="form-group">
                    <label for="category">Commission</label>
                      <table class="table">
                        <tr>
                          <td>
                              <input type="number" class="form-control" name="valluecommission" id="valluecommission" placeholder="Enter Amount" onchange="vallueCommission()"></td>
                          <td>    
                              <input type="number" min = "1" max = 100 class="form-control" name="percentagecommission" id="percentagecommission" placeholder="Enter %" onchange="vallueRate()"></td>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btn_edit">Update</button>
                      <a href="agent.php" class="btn btn-warning">Back</a>
                  </div>
                </form>
            </div>
      </div>
      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Name</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Comapny</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Status</th>


                  </tr>
              </thead>
              <tbody>
              <?php
              $no = 1;
              $select = $pdo->prepare("SELECT * FROM tbl_user WHERE user_id = '".$_GET['id']."' ");
              $select->execute();
              while($row=$select->fetch(PDO::FETCH_OBJ)){?>
                <tr>
                    <td><?php echo $no++    ;?></td>
                    <td><?php echo $row->firstname; ?></td>
                    <td><?php echo $row->lastname; ?></td>
                    <td><?php echo $row->companyname; ?></td>
                    <td><?php echo $row->emailaddress; ?></td>
                    <td><?php echo $row->role; ?></td>
                    <td><?php 
                      if($row->is_active == "1"){
                        echo "active";
                      }else{
                        echo "inactive";
                      } 
                      ?>
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
  <script type="text/javascript">
  function vallueCommission(){
		const valluecommission = document.getElementById("valluecommission");
    let commission = valluecommission.value;
		if (commission.length > 0){
      document.getElementById("percentagecommission").readOnly = true;
    }else{
      document.getElementById("percentagecommission").readOnly = false;
    }
	}
function vallueRate(){
  const percentagecommission = document.getElementById("percentagecommission");
  let commission = percentagecommission.value;
  if (commission.length > 0){
      document.getElementById("valluecommission").readOnly = true;
    }else{
      document.getElementById("valluecommission").readOnly = false;
    }
}
  // percentagecommission
  </script>
<?php
    include_once'inc/footer_all.php';
?>