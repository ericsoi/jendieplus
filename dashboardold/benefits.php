<?php
  include_once'db/connect_db.php';
  session_start();
  if($_SESSION['role']!=="Super-Admin"){
    header('location:index.php');
  }
  include_once'inc/header_all.php';
  $id = $_GET["id"];
  if(isset($_POST['submit'])){
    $benefit_name = $_POST['benefit_name'];
    if(isset($_POST['benefit_name'])){
      $select = $pdo->prepare("SELECT benefit_name FROM tbl_benefits_list WHERE benefit_name='$benefit_name'");
      $select->execute();

      if($select->rowCount() > 0 ){
          echo'<script type="text/javascript">
              jQuery(function validation(){
              swal("Warning", "Category Already Available", "warning", {
              button: "Continue",
                  });
              });
              </script>';
          }else{
            $insert = $pdo->prepare("INSERT INTO tbl_benefits_list(benefit_name) VALUES(:benefit_name)");

            $insert->bindParam(':benefit_name', $benefit_name);

            if($insert->execute()){
              echo '<script type="text/javascript">
              jQuery(function validation(){
              swal("Success", "New Product Added", "success", {
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
                      <input type="text" class="form-control" name="benefit_name" placeholder="Enter Benefit Name">
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                      <a href="add_benefit.php?id=<?php echo $id; ?>" class="btn btn-warning">Back</a>
                  </div>
                </form>
            </div>
      </div>
        <!-- Category Table -->
      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Optional Benefits List</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="overflow-x:auto;">
            <table class="table table-striped" id="myCategory">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Benefit Name</th>
                        <!-- <th>Action</th> -->
                    </tr>

                </thead>
                <tbody>
                <?php
                $select = $pdo->prepare('SELECT * FROM tbl_benefits_list ORDER BY benefit_name ASC');
                $select->execute();
                $no = 0;
                while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                  <tr>
                    <td><?php echo $no ++; ?></td>
                    <td><?php echo $row->benefit_name; ?></td>
                    <!-- <td>
                        <a href="edit_category.php?id=<?php echo $row->id; ?>"
                        class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a>
                        <a href="delete_category.php?id=<?php echo $row->id; ?>"
                        onclick="return confirm('Delete Category?')"
                        class="btn btn-danger btn-sm" name="btn_delete"><i class="fa fa-trash"></i></a>
                    </td> -->
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
      $('#myCategory').DataTable();
  } );
  </script>

<?php
  include_once'inc/footer_all.php';
?>