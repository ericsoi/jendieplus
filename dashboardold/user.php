<?php
include_once'db/connect_db.php';
session_start();
#print_r($_SESSION);
include_once'inc/header_all.php';
$owner = $_SESSION['code'];

if(isset($_POST['submit'])){
    $user = $_POST['user'];
    if(isset($_POST['user'])){

            $select = $pdo->prepare("SELECT username FROM tbl_user WHERE username='$user'");
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
                    $insert = $pdo->prepare("INSERT INTO tbl_user(username) VALUES(:user)");

                    $insert->bindParam(':username', $username);

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
          My Users
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
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="overflow-x:auto;">
            <table class="table table-striped" id="mySatuan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>Company</th>
                        <th>Role</th>
                        <th>Code</th>
                        <th>OwenedBy</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $user_id = $_SESSION["code"];
                if ($_SESSION["role"] == "super_admin"){
                  $select = $pdo->prepare("SELECT * FROM tbl_user");
                }else{
                  $select = $pdo->prepare("SELECT * FROM tbl_user where agent_admin = '$owner'");
                }
                $select->execute();
                while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                  <tr>
                    <td><?php echo $no ++ ?></td>
                    <td><?php echo $row->username ; ?></td>
                    <td><?php echo $row->firstname; ?></td>
                    <td><?php echo $row->lastname; ?></td>
                    <td><?php echo $row->companyname; ?></td>
                    <td><?php echo $row->role;?></td>
                    <td><?php echo $row->sub_agent;?></td>
                    <td><?php echo $row->contactperson?></td>
                    <td><?php if ($row->role == "Operator"){?>
                        <i class="fa fa-circle red-color " ></i>
                        <?php
                        }else{
                        ?>
                        <i class="fa fa-circle green-color " ></i>
                         <?php
                          }
                          ?>
                      </td>

                    <td>
                        <a href="edit_user.php?id=<?php echo $row->user_id; ?>"
                        class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a>
                        <a href="delete_user.php?id=<?php echo $row->user_id; ?>"
                        onclick="return confirm('Delete User <?php $username?>?')"
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
      $('#mySatuan').DataTable();
  } );
  </script>

<?php
  include_once'inc/footer_all.php';
?>