<?php
include_once'db/connect_db.php';
session_start();
include_once'inc/header_all.php';

if(isset($_POST['submit'])){
    $satuan = $_POST['satuan'];
    if(isset($_POST['satuan'])){

            $select = $pdo->prepare("SELECT id FROM tbl_quote WHERE id='$satuan'");
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
                    $insert = $pdo->prepare("INSERT INTO tbl_quote(id) VALUES(:satuan)");

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
          Quotes
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
            <h3 class="box-title">All Quotes</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="overflow-x:auto;">
            <table class="table table-striped" id="mySatuan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Vehicle Reg</th>
                        <th>Coverage</th>
                        <th>Quatation Date</th>
                        <th>Agent name</th>
                        <th>Action</th>


                    </tr>

                </thead>
                <tbody>
                <?php
                $no = 1;
                $select = $pdo->prepare('SELECT * FROM tbl_quote');
                $select->execute();
                while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                  <tr>
                    <td><?php echo $no ++ ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->vehicle_reg; ?></td>
                    <td><?php echo $row->coverage; ?></td>
                    <td><?php echo $row->quatation_date; ?></td>
                    <td><?php echo $row->agent; ?></td>
                    <td>
                        <a href="#?id=<?php echo $row->kd_satuan; ?>"
                        class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a>
                        <a href="#?id=<?php echo $row->kd_satuan; ?>"
                        onclick="return confirm('Delete?')"
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