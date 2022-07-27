<?php
include_once'db/connect_db.php';
session_start();
if(($_SESSION['role']==!"Admin") || ($_SESSION['role']==!"Super-Admin") || ($_SESSION['role']==!"Agent")){
header('location:index.php');
}
include_once'inc/header_all.php';

if(isset($_POST['submit'])){
    $satuan = $_POST['satuan'];
    if(isset($_POST['satuan'])){

            $select = $pdo->prepare("SELECT nm_satuan FROM tbl_satuan WHERE nm_satuan='$satuan'");
            $select->execute();

            if($select->rowCount() > 0 ){
                echo'<script type="text/javascript">
                    jQuery(function validation(){
                    swal("Warning", "Satuan Telah Ada", "warning", {
                    button: "Continue",
                        });
                    });
                    </script>';
                }else{
                    $insert = $pdo->prepare("INSERT INTO tbl_satuan(nm_satuan) VALUES(:satuan)");

                    $insert->bindParam(':satuan', $satuan);

                    if($insert->execute()){
                        echo '<script type="text/javascript">
                        jQuery(function validation(){
                        swal("Success", "Satuan Baru Telah Dibuat", "success", {
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Clients
      </h1>
      <hr>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
       <!-- Category Form-->
      
        <!-- Category Table -->
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">My clients</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="overflow-x:auto;">
            <table class="table table-striped" id="mySatuan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Cover</th>
                        <th>Date Onboarded</th>
                        <th>Last Renewal Date<th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $user_id = $_SESSION["code"];
                if($_SESSION['role'] == "Super-Admin"){
                  $select = $pdo->prepare("SELECT * FROM tbl_client");
                }else{
                  $select = $pdo->prepare("SELECT * FROM tbl_client where owner = '$user_id'");
                  }
                $select->execute();
                while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                  <tr>
                    <td><?php echo $no ++ ?></td>
                    <td><?php echo $row->firstname; ?></td>
                    <td><?php echo $row->lastname; ?></td>
                    <td><?php echo $row->phonenumber; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->time; ?></td>
                    <td><?php echo $row->time; ?></td>

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
      $('#mySatuan').DataTable();
  } );
  </script>

<?php
  include_once'inc/footer_all.php';
?>