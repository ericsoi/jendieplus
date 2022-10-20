<?php
    include_once'misc/plugin.php';
    include_once'db/connect_db.php';
    session_start();
    // if(($_SESSION['role']!=="Admin")||($_SESSION['role']!=="Super-Admin")){
    //     header('location:index.php');
    // }
    print_r($_GET);
    print_r($_POST);
    if($id=$_GET['id']){
    $select = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id=$id");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);
    print_r($row);
    $unique = md5(uniqid(rand(), true));
    $productCode_db  = $row["product_code"];
    $productName_db  = $row["category"];
    $vehicleclass_db = $row["vehicleclass"];
    $underwriter_db = $row["underwriter"];
    $coverage_db = $row["coverage"];
    $description_db = $row["description"];
    $clauses_db = $row["clauses"];
    $conditionsandwaranties_db = $row["conditionsandwaranties"];
    $optionalname_db = $row["optionalname"];
    $optionalpremium_db =$row["optionalpremium"];
    $optionalrate_db = $row["optionalrate"];
    $policylimits_db = $row["policylimits"];
    $mintonnage_db = $row["mintonnage"];
    $maxtonnage_db = $row["maxtonnage"];
    $weeklyrates_db = $row["weeklyrates"];
    $fortnightrates_db = $row["fortnightrates"];
    $passangers_db = $row["passangers"];
    $monthlyrates_db = $row["monthlyrates"];
    $annualrates_db = $row["annualrates"];
    $excludedvehicles_db = $row["excludedvehicles"];
    $minimumpremium_db = $row["minimumpremium"];
    $maxage_db = $row["maxage"];
    $minage_db = $row["minage"];
    $maxsum_db = $row["maxsum"];
    $minsum_db = $row["minsum"];

    }else{
    header('location:product.php');
    }
    if(isset($_POST['update_product'])){
        $product_code =$productCode_db;
        if(isset($_POST["optionalname"]) && !empty($_POST["optionalname"])){
            $optionalname = $_POST["optionalname"];
        }else{
            $optionalname = $unique;
        }

        if(isset($_POST["optionalpremium"]) && !empty($_POST["optionalpremium"])){
            $optionalpremium = $_POST["optionalpremium"];
        }else{
            $optionalpremium = $unique;
        }

        if(isset($_POST["optionalrate"]) && !empty($_POST["optionalrate"])){
            $optionalrate = $_POST["optionalrate"];
        }else{
            $optionalrate = $unique;
        }

        if(isset($_POST["policylimits"]) && !empty($_POST["policylimits"])){
            $policylimits = $_POST["policylimits"];
        }else{
            $policylimits = $unique;
        }

        if(isset($_POST["mintonnage"]) && !empty($_POST["mintonnage"])){
            $mintonnage = $_POST["mintonnage"];
        }else{
            $mintonnage = $unique;
        }

        if(isset($_POST["maxtonnage"]) && !empty($_POST["maxtonnage"])){
            $maxtonnage = $_POST["maxtonnage"];
        }else{
            $maxtonnage = $unique;
        }

        if(isset($_POST["weeklyrates"]) && !empty($_POST["weeklyrates"])){
            $weeklyrates = $_POST["weeklyrates"];
        }else{
            $weeklyrates = $unique;
        }

        if(isset($_POST["fortnightrates"]) && !empty($_POST["fortnightrates"])){
            $fortnightrates = $_POST["fortnightrates"];
        }else{
            $fortnightrates = $unique;
        }

        if(isset($_POST["passangers"]) && !empty($_POST["passangers"])){
            $passangers = $_POST["passangers"];
        }else{
            $passangers = $unique;
        }

        if(isset($_POST["monthlyrates"]) && !empty($_POST["monthlyrates"])){
            $monthlyrates = $_POST["monthlyrates"];
        }else{
            $monthlyrates = $unique;
        }

        if(isset($_POST["annualrates"]) && !empty($_POST["annualrates"])){
            $annualrates = $_POST["annualrates"];
        }else{
            $annualrates = $unique;
        }

        if(isset($_POST["excludedvehicles"]) && !empty($_POST["excludedvehicles"])){
            $excludedvehicles = $_POST["excludedvehicles"];
        }else{
            $excludedvehicles = $unique;
        }

        if(isset($_POST["minimumpremium"]) && !empty($_POST["minimumpremium"])){
            $minimumpremium = $_POST["minimumpremium"];
        }else{
            $minimumpremium = $unique;
        }

        if(isset($_POST["maxage"]) && !empty($_POST["maxage"])){
            $maxage = $_POST["maxage"];
        }else{
            $maxage = $unique;
        }

        if(isset($_POST["minage"]) && !empty($_POST["minage"])){
            $minage = $_POST["minage"];
        }else{
            $minage = $unique;
        }
        if(isset($_POST["minage"]) && !empty($_POST["minage"])){
            $maxsum = $_POST["minage"];
        }else{
            $maxsum = $unique;
        }
        if(isset($_POST["minage"]) && !empty($_POST["minage"])){
            $minsum = $_POST["minage"];
        }else{
            $minsum = $unique;
        }


        $insert = $pdo->prepare("INSERT INTO tbl_edited_product(product_code, optionalname, optionalpremium, optionalrate, policylimits, mintonnage, maxtonnage, weeklyrates, fortnightrates, passangers, monthlyrates, annualrates, excludedvehicles, minimumpremium, maxage, minage, maxsum, minsum)
        values(:product_code,:optionalname,:optionalpremium,:optionalrate,:policylimits,:mintonnage,:maxtonnage,:weeklyrates,:fortnightrates,:passangers,:monthlyrates,:annualrates,:excludedvehicles,:minimumpremium,:maxage,:minage,:maxsum,:minsum)");   
        
        $insert->bindParam(':product_code', $product_code);
        $insert->bindParam(':optionalname', $optionalname);
        $insert->bindParam(':optionalpremium', $optionalpremium);
        $insert->bindParam(':optionalrate', $optionalrate);
        $insert->bindParam(':policylimits', $policylimits);
        $insert->bindParam(':mintonnage', $mintonnage);
        $insert->bindParam(':maxtonnage', $maxtonnage);
        $insert->bindParam(':weeklyrates', $weeklyrates);
        $insert->bindParam(':fortnightrates', $fortnightrates);
        $insert->bindParam(':passangers', $passangers);
        $insert->bindParam(':monthlyrates', $monthlyrates);
        $insert->bindParam(':annualrates', $annualrates);
        $insert->bindParam(':excludedvehicles', $excludedvehicles);
        $insert->bindParam(':minimumpremium', $minimumpremium);
        $insert->bindParam(':maxage', $maxage);
        $insert->bindParam(':minage', $minage);
        $insert->bindParam(':maxsum', $maxsum);
        $insert->bindParam(':minsum', $minsum);
        if($insert->execute()){
            $success='<script type="text/javascript">
                    jQuery(function validation(){
                    swal("success", "Product Updated Successfully", "success", {
                    button: "Continue",
                        });
                    });
                    </script>';
                echo $success;
            #header('location:view_product.php?id='.urlencode($id));
        }else{
            $error='<script type="text/javascript">
                    jQuery(function validation(){
                    swal("Warning", "Product Code Already Registered", "warning", {
                    button: "Continue",
                        });
                    });
                    </script>';
                echo $error;
        }

    }else{
        echo 'Gagal Upload File';
    }
    include_once 'inc/header_all.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-success">
            <div class="box-body">
            <?php
                $id = $_GET['id'];

                $select = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id=$id");
                $select->execute();
                while($row = $select->fetch(PDO::FETCH_OBJ)){?>
                <form action="" method="POST" name="form_product">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <center><p class="list-group-item list-group-item-success">Edit Product</p></center>
                            <div class="form-group">
                                <label for="">Minimum Tonnage</label>
                                <input type="number" class="form-control"
                                name="mintonnage" id="mintonnage" value="<?php echo $mintonnage_db; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Maximum Tonnage</label>
                                <input type="text" class="form-control"
                                name="maxtonnage" id="maxtonnage" value="<?php echo $maxtonnage_db; ?>">
                            </div>
                            
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            <center><p class="list-group-item list-group-item-success">Edit Product</p></center>
                            
                            <div class="form-group">
                                <label for="">Monthly Rates</label>
                                <input type="text" class="form-control"
                                name="monthlyrates" id="monthlyrates"  value="<?php echo $monthlyrates_db; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Annual Rates</label>
                                <input type="text" class="form-control"
                                name="annualrates" id="annualrates" value="<?php echo $annualrates_db; ?>">
                            </div>
                        </ul>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"
                        name="update_product">Add</button>
                        <a href="product.php" class="btn btn-warning">Back</a>
                    </div>
                </form>
            <?php
                }
            ?>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include_once'inc/footer_all.php';
 ?>