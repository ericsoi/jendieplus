<?php
    include_once'db/connect_db.php';
    session_start();
    if($_SESSION['username']==""){
        header('location:index.php');
    }else{
        if(($_SESSION['role']=="Admin") || ($_SESSION['role']=="Super-Admin") || ($_SESSION['role']=="Agent")){
            include_once'inc/header_all.php';
        }else{
            include_once'inc/header_all_operator.php';
        }
        
    
    }
    $code = $_SESSION["code"];
    // contact;
    // address;
    // personidentitydocs;
    // relationship;

    error_reporting(0);

    $id = $_GET['id'];

    $delete = $pdo->prepare("DELETE FROM tbl_product WHERE product_id=".$id);

    if($delete->execute()){
        echo'<script type="text/javascript">
            jQuery(function validation(){
            swal("Info", "Product Has Been Deleted", "info", {
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
                            if ($_SESSION['role'] == "Super-Admin"){
                                $select = $pdo->prepare("SELECT * FROM tbl_product");
                            }else{
                                $select = $pdo->prepare("SELECT * FROM tbl_product where owner = '$code'");
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
                                    <?php if(($_SESSION['role']=="Admin")||($_SESSION['role']=="Super-Admin")) {
                                            if( $row->coverage == "Third Party Only" && ($row->vehicleclass == "15. PSV - Matatu" || $row->vehicleclass =="17. PSV - BUS")){?>
                                                <a href="product.php?id=<?php echo $row->product_id; ?>"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                <a href="edit_product_third_party_bas_matatu.php?id=<?php echo $row->product_id; ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a href="edit_product_third_party_bas_matatu.php?id=<?php echo $row->product_id; ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a>
                                                <a href="added_product.php?id=<?php echo $row->product_code; ?>" class="btn btn-info btn-sm"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></i></a>

                                    <?php }elseif( $row->coverage == "Third Party Only" && ($row->vehicleclass == "7. commercial Own goods" || $row->vehicleclass == "8. General Cartage Lorries,Trucks and Tankers")){?>
                                        <a href="product.php?id=<?php echo $row->product_id; ?>"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                <a href="edit_product_third_party_tonnage.php?id=<?php echo $row->product_id; ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a href="edit_product_third_party_tonnage.php?id=<?php echo $row->product_id; ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a>
                                                <a href="added_product.php?id=<?php echo $row->product_code; ?>" class="btn btn-info btn-sm"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></i></a>

                                    <?php }elseif( $row->coverage == "Comprehensive"){?>
                                        <a href="product.php?id=<?php echo $row->product_id; ?>"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                <a href="edit_product.php?id=<?php echo $row->product_id; ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a href="edit_product.php?id=<?php echo $row->product_id; ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a>
                                                <a href="added_product.php?id=<?php echo $row->product_code; ?>" class="btn btn-info btn-sm"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></i></a>

                                    <?php }else{?>
                                        <a href="product.php?id=<?php echo $row->product_id; ?>"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                <a href="edit_product_third_party.php?id=<?php echo $row->product_id; ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a href="edit_product_third_party.php?id=<?php echo $row->product_id; ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a>
                                                <a href="added_product.php?id=<?php echo $row->product_code; ?>" class="btn btn-info btn-sm"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></i></a>

                                    <?php
                                    }}
                                    ?>
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