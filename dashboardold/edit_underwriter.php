<?php
  include_once 'db/connect_db.php';
  session_start();
  // if((! $_SESSION['role']=="Admin") || (! $_SESSION['role']=="Super-Admin")){
  //   header('location:index.php');
  // }
$owner = $_SESSION["code"];
$underwriter_id = $_GET["id"];
if(isset($_POST['btn_edit'])){
  if(isset($_POST["email"]) && !empty($_POST["email"])){
      $email = $_POST['email'];
      $select = $pdo->prepare("SELECT * FROM  tbl_email where owner='$owner' AND underwriter_id = '$underwriter_id'");
      $select->execute();
      
      if ($select->rowCount()>0){
        $row = $select->fetch(PDO::FETCH_OBJ);
        $underwriter = $row->underwriter;
        $update = $pdo->prepare("UPDATE tbl_email SET email='$email' WHERE owner='$owner' and underwriter='$underwriter'");
        $update->bindParam(':email', $email);
        if($update->rowCount() > 0){
           $message = "Success";
        }elseif($update->execute()){
          $message = "Success";
        }
      }else{
        $select = $pdo->prepare("SELECT * FROM  underwriters where ID='$underwriter_id'");
        $select->execute();
        $row = $select->fetch(PDO::FETCH_OBJ);
        $underwriter = $row->Name;
        $paybill = $row->paybill;
        $insert = $pdo->prepare("INSERT INTO tbl_email(email, owner, underwriter, paybill, underwriter_id)values(:email,:owner,:underwriter,:paybill,:underwriter_id)");
        $insert->bindParam(':email', $email);
        $insert->bindParam(':underwriter', $underwriter);
        $insert->bindParam(':owner', $owner);
        $insert->bindParam(':paybill', $paybill);
        $insert->bindParam(':underwriter_id', $underwriter_id);
        if($insert->execute()){
          $message = "success";
        }
      }
  }
  if(isset($_POST["emailcc"]) && !empty($_POST["emailcc"])){
    $email = $_POST['emailcc'];
    $select = $pdo->prepare("SELECT * FROM  tbl_email where owner='$owner' AND underwriter_id = '$underwriter_id'");
    $select->execute();
    
    if ($select->rowCount()>0){
      $row = $select->fetch(PDO::FETCH_OBJ);
      $underwriter = $row->underwriter;
      $update = $pdo->prepare("UPDATE tbl_email SET emailcc='$email' WHERE owner='$owner' and underwriter='$underwriter'");
      $update->bindParam(':email', $email);
      if($update->rowCount() > 0){
        $message = "Success";
      }elseif($update->execute()){
        $message = "Success";
      }
    }else{
      $select = $pdo->prepare("SELECT * FROM  underwriters where ID='$underwriter_id'");
      $select->execute();
      $row = $select->fetch(PDO::FETCH_OBJ);
      $underwriter = $row->Name;
      $paybill = $row->paybill;
      $insert = $pdo->prepare("INSERT INTO tbl_email(email, owner, underwriter, paybill, underwriter_id)values(:email,:owner,:underwriter,:paybill,:underwriter_id)");
      $insert->bindParam(':email', $email);
      $insert->bindParam(':underwriter', $underwriter);
      $insert->bindParam(':owner', $owner);
      $insert->bindParam(':paybill', $paybill);
      $insert->bindParam(':underwriter_id', $underwriter_id);
      if($insert->execute()){
        $message = "Success";
      }
    }
  } 
}
if(isset($message)){
  echo"<script type='text/javascript'>
          alert('$message');
        </script>";
}
if($id=$_GET['id']){
    $select = $pdo->prepare("SELECT * FROM underwriters WHERE ID = '".$_GET['id']."' ");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_OBJ);
    $name = $row->Name;
}else{
    header('location:underwriters.php');
}
  include_once'inc/header_all.php';

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Edit Email
      </h1>
      <hr>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
       <!-- Category Form-->
      <div class="col-md-2">
            <div class="box box-warning">
                <!-- /.box-header -->
                <!-- form start -->
                <form action="" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="category">Update Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="update email"></td>
                    </div>
                    <div class="form-group">
                      <label for="category">Email CC</label>
                        <input type="text" class="form-control" name="emailcc" id="emailcc" placeholder="Enter email CC"></td>
                      </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btn_edit">Update</button>
                      <a href="underwriters.php" class="btn btn-warning">Back</a>
                  </div>
                </form>
            </div>
      </div>

      <div class="col-md-10">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Name</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Email CC</th>
                      <th>Paybill</th>
                      <th>description</th>
                  </tr>
              </thead>
              <tbody>
              <?php
              $select = $pdo->prepare("SELECT * FROM tbl_email WHERE owner = '$owner'");
              $select->execute();
              while($row=$select->fetch(PDO::FETCH_OBJ)){?>
                <tr>
                    <td><?php echo $row->underwriter;?></td>
                    <td><?php echo $row->email;?></td>
                    <td><?php echo $row->emailcc;?></td>
                    <td><?php echo $row->paybill;?></td>       
                    <td><?php echo $row->description;?></td>                 
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