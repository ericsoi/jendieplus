<?php
	include "session.php";
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}    
    $user=select_user($_SESSION["userid"]);
    print_r($user);
?>
<html>
<head>
<meta http-equiv="refresh" content="60">
</head>
</html>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Product List</h3>
                <a href="add_product.php" class="btn btn-success btn-sm pull-right">Add Product</a>
            </div>
            <div class="box-body">
                <div style="overflow-x:auto;">
                    <table class="table table-striped" id="myProduct">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Legal Entity</th>
                                <th>Coverage</th>
                                <th>Risk Covered</th>
                                <th>Product Name</th>
                                <th>Owned By</th>
                                <th>Date Modified</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        <!-- <td><img src="<?php echo $row['path']?>" width="100%" height="100px" class="img-responsive" alt=""></td> -->

                        <tbody>
                            <?php
                            #print_r($_SESSION);
                            $no = 1;
                            if ($_SESSION['role'] == "super_admin"){
                                $select = $pdo->prepare("SELECT * FROM tbl_product");
                            }else{
                                $select = $pdo->prepare("SELECT * FROM tbl_product where owner = '$user->code'");
                            }
                            $select->execute();
                            while($row=$select->fetch(PDO::FETCH_OBJ)){
                                // $underwriter = $row->underwriter;
                                // $select1 = $pdo->prepare("SELECT path, Name FROM tbl_underwriter where Name like '%$underwriter%'");
                                // $select1->execute();
                                // $my_row=$select1->fetch(PDO::FETCH_OBJ);
                                // echo $my_row->path . "<br>";
                                // echo $my_row->Name . "<br>";
                            ?>
                                <tr>
                                <td><?php echo $no++ ;?></td>
                                <td><?php echo $row->underwriter;?>
                                    <!-- <?php echo $row->underwriter;?><img src="<?php echo $my_row->path?>" width="40%" height="10px" class="img-responsive" alt=""> -->
                                    <!-- <a href="edit_product.php?id=<?php echo $row->product_id; ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                    <button type="submit" class="btn btn-lg btn-sm btn-danger">View Products</button> -->
                                </td>
                                <td><?php echo $row->coverage; ?></td>
                                <td><?php echo $row->vehicleclass; ?></td>
                                <td><?php echo $row->category;?></td>
                                <th><?php echo $row->owner;?></td>
                                <td><?php echo $row->time;?></td>

                                <td>
                                        <a href="product.php?id=<?php echo $row->product_id; ?>"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        <a href="edit_product.php?id=<?php echo $row->product_id; ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                        <a href="edit_product.php?id=<?php echo $row->product_id; ?>&&coverage=<?php echo $row->coverage;?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a>
                                        <a href="added_product.php?id=<?php echo $row->product_code;?>" class="btn btn-info btn-sm"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></i></a>
                                        <a href="view_product.php?id=<?php echo $row->product_id; ?>" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>


                                </td>
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
      $('#myProduct').DataTable();
  } );
  </script>

 <?php
    include_once'inc/footer_all.php';
 ?>