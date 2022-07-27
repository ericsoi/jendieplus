<?php
include_once'db/connect_db.php';
session_start();
if(($_SESSION['role']==!"Admin") || ($_SESSION['role']==!"Super-Admin")){
header('location:index.php');
}
include_once'inc/header_all.php';
if($id=$_GET['id']){
  $select = $pdo->prepare("SELECT * FROM tbl_edited_product WHERE product_code='$id'");
}else{
  header('location:product.php');
}

  $select->execute();

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Procuct
      </h1>
      <hr>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
       <!-- Category Form-->
      
        <!-- Category Table -->
      <div class="col-md-12">
        <a href="product.php" class="btn btn-warning">Back</a>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Product</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="overflow-x:auto;">
            <table class="table table-striped" id="mySatuan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th> name</th>
                        <th>Action</th>


                    </tr>

                </thead>
                <tbody>
                <?php
                $no = 1;
                $select = $pdo->prepare("SELECT * FROM tbl_edited_product WHERE product_code='$id'");
                $select->execute();
                while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                  <tr>
                    <td><?php echo $no ++ ?></td>
                    <td><?php echo $row->nm_satuan; ?></td>
                    <td><?php echo $row->nm_satuan; ?></td>
                    <td><?php echo $row->nm_satuan; ?></td>
                    <td><?php echo $row->nm_satuan; ?></td>
                    <td><?php echo $row->nm_satuan; ?></td>
                    <td>
                        <a href="edit_satuan.php?id=<?php echo $row->kd_satuan; ?>"
                        class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a>
                        <a href="delete_satuan.php?id=<?php echo $row->kd_satuan; ?>"
                        onclick="return confirm('Hapus Satuan?')"
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