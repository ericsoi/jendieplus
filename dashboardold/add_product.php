<?php
   include_once'db/connect_db.php';
   session_start();
   if($_SESSION['username']==""){
     header('location:index.php');
   }else{
    include_once'inc/header_all.php';
   }
    $unique = md5(uniqid(rand(), true));
    if(isset($_POST['add_product'])){
        
        $_POST = array_map('trim', $_POST); $product_code = trim($_POST["product_code"]); $category = $_POST["category"]; $vehicleclass = $_POST["vehicleclass"]; $underwriter = trim($_POST["underwriter"]); $coverage = $_POST["coverage"]; $description = $_POST["description"]; $clauses = $_POST["clauses"]; $conditionsandwaranties = $_POST["conditionsandwaranties"]; $policylimits = $_POST["policylimits"]; $mintonnage = $_POST["mintonnage"]; $maxtonnage = $_POST["mintonnage"]; $weeklyrates = $_POST["weeklyrates"]; $fortnightrates = $_POST["fortnightrates"]; $passangers = $_POST["passangers"]; $monthlyrates = $_POST["monthlyrates"]; $annualrates = $_POST["annualrates"]; $excludedvehicles = $_POST["excludedvehicles"]; $minimumpremium = $_POST["minimumpremium"]; $maxage = $_POST["maxage"]; $minage = $_POST["minage"]; $maxsum = $_POST["maxsum"]; $minsum = $_POST["minsum"];
        $owner = trim($_SESSION["code"]);
        $typearr = explode(".", $vehicleclass);
        $type = (int) $typearr[0];
        $vehicle_class = trim(explode(".", $_POST["vehicleclass"])[1]);
        if(($vehicle_class == "PSV - Matatu" || $vehicle_class == "PSV - BUS" ) && $coverage == "Third Party Only") {
            $uniqueidentifier = $underwriter."|".$coverage."|".$vehicle_class."|".$passangers."|".$owner;
        }elseif($vehicle_class != "PSV - Matatu" || $vehicle_class  !=  "PSV - BUS" ||  $vehicle_class  !=  "General Cartage Lorries,Trucks and Tankers" || $vehicle_class == "commercial Own goods" && $coverage == "Third Party Only"){
            $uniqueidentifier = $underwriter."|".$coverage."|".$vehicle_class."|".$owner;
        }elseif($vehicle_class  !=  "General Cartage Lorries,Trucks and Tankers" || $vehicle_class  !=  "commercial Own goods"  && $coverage == "Third Party Only"){
            $uniqueidentifier = $underwriter."|".$coverage."|".$vehicle_class."|".$owner;
        }elseif(($vehicle_class  !=  "General Cartage Lorries,Trucks and Tankers" || $vehicle_class  !=  "commercial Own goods") && $coverage == "Comprehensive"){
            $uniqueidentifier = $underwriter."|".$coverage."|".$vehicle_class."|".$maxage."|".$minage."|".$maxsum."|".$minsum."|".$owner;
        }elseif(($vehicle_class  ==  "General Cartage Lorries,Trucks and Tankers" || $vehicle_class  ==  "commercial Own goods") && $coverage == "Comprehensive"){
            $uniqueidentifier = $underwriter."|".$coverage."|".$vehicle_class."|".$maxtonnage."|".$mintonnage."|".$maxage."|".$minage."|".$maxsum."|".$minsum."|".$owner;
        }elseif(($vehicle_class  ==  "General Cartage Lorries,Trucks and Tankers" || $vehicle_class  ==  "commercial Own goods") && $coverage == "Third Party Only"){
            $uniqueidentifier = $underwriter."|".$coverage."|".$vehicle_class."|".$maxtonnage."|".$mintonnage."|".$owner;
        }else{
            $uniqueidentifier = $underwriter."|".$coverage."|".$vehicle_class;
        }       
        if ($type < 4){
            $vehicleclass = "Motorcycle" . $typearr[1];
        } elseif ($type > 3 && $type <6) {
            $vehicleclass = "Trycycle" . $typearr[1];
        } else {
            $vehicleclass = "Motorvehicle" . $typearr[1];
        }
        if(isset($_POST['product_code'])){
            

            $select = $pdo->prepare("SELECT uniqueidentifier FROM tbl_product WHERE uniqueidentifier='$uniqueidentifier'");
            $select->execute();

            if($select->rowCount() > 0 ){
                $error='<script type="text/javascript">
                    jQuery(function validation(){
                    swal("Warning", "Product Already Registered", "warning", {
                    button: "Continue",
                        });
                    });
                    </script>';
                echo $error;
            }else{
                if(!isset($error)){
                    $selectunderwriter = $pdo->prepare("SELECT underwriter FROM tbl_email WHERE underwriter='$underwriter' and owner='$owner'");
                    $selectunderwriter->execute();
                    if($selectunderwriter->rowCount()>0){
                        // echo "<script> alert('Found')</script>";
                        #$underwriterrow = $selectunderwriter->fetch(PDO::FETCH_OBJ);
                        #$underwriterdescription = $underwriterrow["underwriter"];
                        $update = $pdo->prepare("UPDATE tbl_email SET description='$description' WHERE owner='$owner' and underwriter='$underwriter'");
                        $update->bindParam(':description', $description);
                        if($update->execute()){
                            echo "<script> alert('Underwriter Email Updated')</script>";
                        }else{
                            echo "<script> alert('Faild to Underwriter email. Your description might have invalid charecters')</script>";

                        }
                    }else{
                        $selectunderwriter = $pdo->prepare("SELECT * FROM tbl_underwriter WHERE Name='$underwriter'");
                        $selectunderwriter->execute();
                        $underwriterrow = $selectunderwriter->fetch(PDO::FETCH_OBJ);
                        $underwriter = $underwriterrow->Name;
                        $paybill = $underwriterrow->paybill;
                        $underwriter_id = $underwriterrow->ID;
                        $insert = $pdo->prepare("INSERT INTO tbl_email(underwriter, owner, paybill, underwriter_id)values(:underwriter,:owner,:paybill,:underwriter_id)");
                        $insert->bindParam(':underwriter', $underwriter);
                        $insert->bindParam(':owner', $owner);
                        $insert->bindParam(':paybill', $paybill);
                        $insert->bindParam(':underwriter_id', $underwriter_id);
                        if($insert->execute()){
                            echo "<script> alert('New Underwriter Added. Edit email on the underwriter section')</script>";
                        }else{
                            echo "<script> alert('Failed to insert new underwriter. Check your description text and try again')</script>";
                        }
                    }
                    
                    $insert = $pdo->prepare("INSERT INTO tbl_product(product_code, category, vehicleclass, underwriter, coverage, description, clauses, conditionsandwaranties, optionalname, optionalpremium, optionalrate, policylimits, mintonnage, maxtonnage, weeklyrates, fortnightrates, passangers, monthlyrates, annualrates, excludedvehicles, minimumpremium, maxage, minage, maxsum, minsum, owner, uniqueidentifier)
                    values(:product_code,:category,:vehicleclass,:underwriter,:coverage,:description,:clauses,:conditionsandwaranties,:optionalname,:optionalpremium,:optionalrate,:policylimits,:mintonnage,:maxtonnage,:weeklyrates,:fortnightrates,:passangers,:monthlyrates,:annualrates,:excludedvehicles,:minimumpremium,:maxage,:minage,:maxsum,:minsum,:owner,:uniqueidentifier)");
                    
                    $insert->bindParam(':product_code', $product_code);
                    $insert->bindParam(':category', $category);
                    $insert->bindParam(':vehicleclass', $vehicleclass);
                    $insert->bindParam(':underwriter', $underwriter);
                    $insert->bindParam(':coverage', $coverage);
                    $insert->bindParam(':description', $description);
                    $insert->bindParam(':clauses', $clauses);
                    $insert->bindParam(':conditionsandwaranties', $conditionsandwaranties);
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
                    $insert->bindParam(':owner', $owner);
                    $insert->bindParam(':uniqueidentifier', $uniqueidentifier);
                    if($insert->execute()){
                        echo'<script type="text/javascript">
                                jQuery(function validation(){
                                swal("Success", "Product Saved Successfully", "success", {
                                button: "Continue",
                                    });
                                });
                                </script>';
                    }else{
                        echo '<script type="text/javascript">
                                jQuery(function validation(){
                                swal("Error", "There is an error", "error", {
                                button: "Continue",
                                    });
                                });
                                </script>';
                    }

                }else{
                    echo '<script type="text/javascript">
                                jQuery(function validation(){
                                swal("Error", "There is an error", "error", {
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
    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Enter New Product</h3>
                <!-- <?php print_r($_POST);
                   
                ?> -->
            </div>
            <form action="" method="POST" name="form_product"
                enctype="multipart/form-data" autocomplete="off">
                <div class="box-body">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Product Code</label><br>
                            <input type="text" class="form-control"
                            <?php
                                $select = $pdo->prepare("SELECT * FROM tbl_product");
                                $select->execute();
                                $total_records = $select->rowCount();
                                ?>
                            name="product_code" value="<?php echo $total_records?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Product</label>
                            <select class="form-control" name="category" required>
                                <?php
                                
                                $select = $pdo->prepare("SELECT * FROM tbl_category");
                                $select->execute();
                                while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                    extract($row);
                                    $row = array_map('trim', $row);

                                ?>
                                    <option><?php echo $row['cat_name']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Choose Risk to be covered</label>
                            <select class="form-control" name="vehicleclass" id="vehicleclass" onchange="vehicleSelect(this)">
                                <optgroup label="1. MOTORCYCLE">
                                    <?php
                                    $select = $pdo->prepare("SELECT * FROM tbl_vehicleclass where type = 'MOTORCYCLE'");
                                    $select->execute();
                                    while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                        extract($row);
                                        $row = array_map('trim', $row);
                                    ?>
                                        <option><?php echo $row["ID"].".  ".$row["class"] ?></option>
                                        
                                    <?php
                                        }
                                    ?>
                                </optgroup>
                                <optgroup label="2. TRICYCLE">
                                    <?php
                                    $select = $pdo->prepare("SELECT * FROM tbl_vehicleclass where type = 'TRICYCLE'");
                                    $select->execute();
                                    while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                        extract($row);
                                        $row = array_map('trim', $row);
                                    ?>  
                                        <option><?php echo $row["ID"].".  ".$row["class"] ?></option>
                                    <?php
                                        }
                                    ?>
                                </optgroup>
                                <optgroup label="3. MOTORVEHICLE">
                                    <?php
                                    $select = $pdo->prepare("SELECT * FROM tbl_vehicleclass where type = 'MOTORVEHICLE'");
                                    $select->execute();
                                    while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                        extract($row);
                                        $row = array_map('trim', $row);

                                    ?>
                                        <option><?php echo $row["ID"].".  ".$row["class"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Choose Underwriter</label>
                            <select class="form-control" name="underwriter">
                                <?php
                                $select = $pdo->prepare("SELECT * FROM tbl_underwriter");
                                $select->execute();
                                while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                    extract($row);
                                    $row = array_map('trim', $row);

                                ?>
                                    <option><?php echo $row['Name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Choose Coverage</label>
                            <select class="form-control" name="coverage" id="coverage" onchange="vehicleSelect(this)">
                                <?php
                                $select = $pdo->prepare("SELECT * FROM tbl_coverage");
                                $select->execute();
                                while($row = $select->fetch(PDO::FETCH_ASSOC)){
                                    extract($row);
                                    $row = array_map('trim', $row);

                                ?>
                                    <option><?php echo $row['cover']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Underwriter Description</label>
                            <textarea name="description" id="description"
                            cols="30" rows="12" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <h8>Clauses</h9>
                            <textarea name="clauses" id="clauses"
                            cols="30" rows="7" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                        <h8>Conditions and waranties</h8>
                            <textarea name="conditionsandwaranties" id="conditionsandwaranties"
                            cols="30" rows="7" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <h8>Policy Limits and Benefits</h9>
                            <textarea name="policylimits" id="policylimits"
                            cols="30" rows="12" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="">Rater</label><br>
                            <input type="number" class="form-control"
                            name="mintonnage" id="mintonnage" placeholder="Minimum Tonnage">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control"
                            name="maxtonnage" id="maxtonnage" placeholder="Maximum Tonnage">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control"
                            name="weeklyrates" id="weeklyrates" placeholder="Weekly Rates">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control"
                            name="fortnightrates" id="fortnightrates" placeholder="Fortnite Rates">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control"
                            name="passangers" id="passangers" placeholder="Number of passangers">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control"
                            name="monthlyrates" id="monthlyrates" placeholder="Monthly Rates">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control"
                            name="annualrates" id="annualrates" placeholder="Annual Rates">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control"
                            name="excludedvehicles" id="excludedvehicles" placeholder="Minimum Excluded Vehicles">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control"
                            name="minimumpremium" id="minimumpremium" placeholder="Minimum Premium">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control"
                            name="maxage" id="maxage" placeholder="Maximum Age">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control"
                            name="minage" id="minage" placeholder="Minimum Age">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control"
                            name="maxsum" id="maxsum" placeholder="Maximum sum Insured">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" class="form-control"
                            name="minsum" id="minsum" placeholder="Minimum sum Insured">
                        </div>
                        
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"
                    name="add_product">Add Product</button>
                    <a href="product.php" class="btn btn-warning">Back</a>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_preview').attr('src', e.target.result)
                .width(250)
                .height(200);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    function vehicleSelect(input) {
        var x = document.getElementById("coverage");
        var i = x.selectedIndex;
        var z = document.getElementById("vehicleclass");
        var y = z.selectedIndex;
        console.log('i  ' + i);
        console.log('y  ' + y);

        if ((y == 6 || y == 7)) {
            document.getElementById("mintonnage").readOnly = false;
            document.getElementById("maxtonnage").readOnly = false;
            console.log("6, 7");
        }else{
            document.getElementById("mintonnage").readOnly = true;
            document.getElementById("maxtonnage").readOnly = true;
            console.log("!6, 7");
        }
        if ((y == 16 || y == 14) &&(i == 0)){
            console.log("Matau");
            document.getElementById("weeklyrates").readOnly = false;
            document.getElementById("fortnightrates").readOnly = false;
            document.getElementById("passangers").readOnly = false;
            console.log("16,14,0");
        }else{
            document.getElementById("weeklyrates").readOnly = true;
            document.getElementById("fortnightrates").readOnly = true;
            document.getElementById("passangers").readOnly = true;
            console.log("!16,14,0");
        }
        if (i == 2){
            document.getElementById("monthlyrates").readOnly = false;
            document.getElementById("annualrates").readOnly = false;
            document.getElementById("excludedvehicles").readOnly = false;
            document.getElementById("minimumpremium").readOnly = false;
            document.getElementById("minage").readOnly = false;
            document.getElementById("maxage").readOnly = false;
            document.getElementById("optionalname").readOnly = false;
            document.getElementById("optionalpremium").readOnly = false;
            document.getElementById("optionalrate").readOnly = false;
            console.log("2");
        }else{
            // document.getElementById("monthlyrates").readOnly = true;
            // document.getElementById("annualrates").readOnly = true;
            document.getElementById("excludedvehicles").readOnly = true;
            document.getElementById("minimumpremium").readOnly = true;
            document.getElementById("minage").readOnly = true;
            document.getElementById("maxage").readOnly = true;
            document.getElementById("optionalname").readOnly = true;
            document.getElementById("optionalpremium").readOnly = true;
            document.getElementById("optionalrate").readOnly = true;
            document.getElementById("maxsum").readOnly = true;
            document.getElementById("minsum").readOnly = true;
            
            console.log("!2");
        }
    }
</script>

 <?php
    include_once'inc/footer_all.php';
 ?>