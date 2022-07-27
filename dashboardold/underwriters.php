<?php
    include_once'db/connect_db.php';
    session_start();
    // if($_SESSION['username']==""){
    //     header('location:index.php');
    // }else{
        // if(($_SESSION['role']=="Admin") || ($_SESSION['role']=="Super-Admin")){
    include_once'inc/header_all.php';
        // }else{
        //     include_once'inc/header_all_operator.php';
        // }
    // }

    error_reporting(0);

    $id = $_GET['id'];

    $delete_query = "DELETE tbl_invoice , select FROM tbl_invoice INNER JOIN tbl_invoice_detail ON tbl_invoice.invoice_id =
    tbl_invoice_detail.invoice_id WHERE tbl_invoice.invoice_id=$id";
    $delete = $pdo->prepare($delete_query);
    if($delete->execute()){
        echo'<script type="text/javascript">
            jQuery(function validation(){
            swal("Info", "under construction", "info", {
            button: "Continue",
                });
            });
            </script>';
    }
?>

<html>
<head>
<meta http-equiv="refresh" content="60">
</head>
</html>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Underwriters
      </h1>
      <hr>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">List of underwriters</h3>
                <!-- <a href="create_order.php" class="btn btn-success btn-sm pull-right">Edit</a> -->
            </div>
            <div class="box-body">
                <div style="overflow-x:auto;">
                    <table class="table table-striped" id="myOrder">
                        <thead>
                            <tr>
                                <th style=";">No</th>
                                <th style="">Name</th>
                                <th style="">Pay Bill</th>
                                <th style="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $select = $pdo->prepare("SELECT * FROM underwriters ORDER BY ID DESC");
                            $select->execute();
                            while($row=$select->fetch(PDO::FETCH_OBJ)){
                                // print_r($row);
                            ?>
                                <tr>
                                <td><?php echo $no++ ; ?></td>
                                <td class="text-uppercase"><?php echo $row->Name; ?></td>
                                <td><?php echo $row->paybill; ?></td>
                                <td><a href="edit_underwriter.php?id=<?php echo $row->ID; ?>"class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a></td>
                                
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
  $(document).ready( function () {
      $('#myOrder').DataTable();
  } );
  </script>

 <?php
    include_once'inc/footer_all.php';
 ?>