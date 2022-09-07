<?php
@session_start();
$product_id=$_SESSION["edit_product"];
include "../../../db/connect_db.php";
if(isset($_POST['benefit_submit'])){
    $benefit_name=$_POST['benefit_name'];
    if(isset($_POST["days"])){
        $benefit_days=$_POST["days"];
    }else{
        $benefit_days="";
    }
    if(isset($_POST["amount"])){
            $benefit_amount=$_POST["amount"];
    }else{
        $benefit_amount="";
    }
    if(isset($_POST["freelimit"])){
            $benefit_freelimit=$_POST["freelimit"];
    }else{
        $benefit_freelimit="";
    }
    if(isset($_POST["rate"])){
            $benefit_rate=$_POST["rate"];
    }else{
        $benefit_rate="";
    }
    if(isset($_POST["minimum_premium"])){
        $benefit_minimum_premium = $_POST["minimum_premium"];
    }else{
        $benefit_minimum_premium="";
    }
    $select = $pdo->prepare("SELECT * FROM tbl_benefits WHERE benefit_name='$benefit_name' AND product_id='$product_id'");
    $select->execute();
    if($select->rowCount() > 0 ){
        if( $benefit_name == "COURTESY_CAR" ){
            $row = $select->fetch(PDO::FETCH_ASSOC);
            $no_of_days = explode(",",$row["benefit_days"]);
            if(in_array($benefit_days, $no_of_days) || sizeof($no_of_days)>4){
                header("location: ../optionalbenefits.php?status=exists&benefit_name=".$benefit_name);
                exit;
            }
            $benefit_days=$benefit_days.",".$row["benefit_days"];            
            $benefit_amount = $benefit_amount.','.$row["benefit_amount"];
            $update=$pdo->prepare("UPDATE tbl_benefits SET benefit_days='$benefit_days', benefit_amount='$benefit_amount' where benefit_name = '$benefit_name'");
            $update->execute();
            if($update->rowCount()>0){
                header("location: ../optionalbenefits.php?status=added&benefit_name=".$benefit_name);
                exit;
            }
            
        }else{
            header("location: ../optionalbenefits.php?status=exists&benefit_name=".$benefit_name);
        }
    }else{
     
        $insert = $pdo->prepare("INSERT INTO tbl_benefits(benefit_name, benefit_rate, product_id, benefit_freelimit, benefit_amount, benefit_days, benefit_minimum_premium) VALUES(:benefit_name,:benefit_rate,:product_id,:benefit_freelimit,:benefit_amount,:benefit_days,:benefit_minimum_premium)");
        $insert->bindParam(':benefit_name', $benefit_name);
        $insert->bindParam(':benefit_rate', $benefit_rate);
        $insert->bindParam(':product_id', $product_id);
        $insert->bindParam(':benefit_freelimit', $benefit_freelimit);
        $insert->bindParam(':benefit_amount', $benefit_amount);
        $insert->bindParam(':benefit_days', $benefit_days);
        $insert->bindParam(':benefit_minimum_premium', $benefit_minimum_premium);
        if($insert->execute()){
            header("location: ../optionalbenefits.php?status=added&benefit_name=".$benefit_name);
        }

    }
}
if(isset($_POST['vehicle_search'])){
    $vehicle_model=$_POST['term'];
    $select = $pdo->prepare("SELECT * FROM tbl_excluded_vehicles WHERE vehicle_model='$vehicle_model' AND product_id='$product_id'");
    $select->execute();
    if($select->rowCount() > 0 ){
        // echo '<script type="text/javascript">alert("Exists")</script>';
        header("location: ../optionalbenefits.php?status=exists&vehicle_model=".$vehicle_model);
    }else{
     
        $insert = $pdo->prepare("INSERT INTO tbl_excluded_vehicles(vehicle_model, product_id) VALUES(:vehicle_model,:product_id)");
        $insert->bindParam(':vehicle_model', $vehicle_model);
        $insert->bindParam(':product_id', $product_id);
        if($insert->execute()){
        // echo '<script type="text/javascript">alert("Added")</script>';
            header("location: ../optionalbenefits.php?status=added&vehicle_model=".$vehicle_model);
        }

    }
}

if(isset($_GET["product_id"])){
    $benefit_name=$_GET["benefit_name"];
    $product_id=$_GET["product_id"];
    $delete = $pdo->prepare("DELETE from tbl_benefits WHERE benefit_name='$benefit_name' AND product_id='$product_id'");
    if($delete->execute()){
        header('location: ../optionalbenefits.php?status=deleted&benefit_name='.$benefit_name);
    }
}
if(isset($_GET["vehicle_id"])){
    $vehicle_id=$_GET["vehicle_id"];
    $delete = $pdo->prepare("DELETE from tbl_excluded_vehicles WHERE vehicle_id='$vehicle_id'");
    if($delete->execute()){
        header('location: ../optionalbenefits.php?status=deleted&vehicle_model='.$vehicle_id);
    }
}
?>