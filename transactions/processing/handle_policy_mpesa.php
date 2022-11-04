<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if(!isset($_SESSION["underwriter"])) { 

    header("refresh:0;url=../../index.php");
}
include $_SERVER['DOCUMENT_ROOT']."/dashboard/db/connect_db.php";

$owner_referal= explode("/", $_SESSION["client_details"]["referal_code"])[0];
$select = $pdo->prepare("select * from tbl_user where code = '$owner_referal'");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
$_SESSION["agency_owner"]=$row;
$status=0;
$method_of_payment=$_SESSION["confirmed_items"]["payments"];
$agency=$_SESSION['agency_owner']["agency"];
$subagent=$_SESSION['agency_owner']["subagent"];
$code=$_SESSION['agency_owner']["code"];
$username=$_SESSION['agency_owner']["phonenumber"];
$role=$_SESSION['agency_owner']["role"];
$cover_period=$_SESSION["client_details"]["coverperiod"];
$first_name=$_SESSION["confirmed_items"]["firstname"];
$middle_name=$_SESSION["confirmed_items"]["firstname"];
$last_name=$_SESSION["confirmed_items"]["lastname"];
$id_number=$_SESSION["confirmed_items"]["idnumber"];
$pin_number=$_SESSION["confirmed_items"]["kra"];
$phone_number=$_SESSION["confirmed_items"]["phonenumber"];
$client_email=$_SESSION["confirmed_items"]["emailaddress"];
$gender=$_SESSION["client_details"]["gender"];
$poastall_address=$_SESSION["confirmed_items"]["postaladdress"];
$policy_number="0";
$cover_from=$_SESSION["logbook"]["date"];
$date=date_create($cover_from);
date_add($date,date_interval_create_from_date_string($cover_period));
$cover_to=date_format($date,"Y-m-d");
$cert_from=0;
$cert_to=0;
$vehicle_reg=$_SESSION["logbook"]["registration"];
$chassis_number=$_SESSION["logbook"]["chasis"];
$insurance_class=$_SESSION["class"];
$cover_type=$_SESSION["cover"];
if($cover_type == "Third Party Only"){
    $sum_insured=0;
}
$sum_insured=0;
$gross_premium=$_SESSION["grosspremium"];
$installments=$_SESSION["confirmed_items"]["installments"];
$certificate_number=0;
$underwriter=$_SESSION["underwriter"]["Name"];
$seating_capacity=$_SESSION["logbook"]["passengers"];
$tonnage=$_SESSION["logbook"]["load_capacity"];
$optional_benefits="no";
$unique_string='dsdrtyddd'.$agency.$subagent.$code.$username.$role.$cover_period.$first_name.$middle_name.$last_name.$id_number.$pin_number.$phone_number.$client_email.$gender.$poastall_address.$cover_from.$cover_to.$vehicle_reg.$chassis_number.$insurance_class.$cover_type.$cover_type.$sum_insured.$gross_premium.$installments.$underwriter.$seating_capacity.$tonnage;
//0112770613
$select=$pdo->prepare("SELECT * from tbl_policy where unique_string='$unique_string'");
$select->execute();
$total_records = $select->rowCount();
if($total_records <= 0){
    $insert = $pdo->prepare("INSERT INTO tbl_policy(status,role,first_name, middle_name, last_name, id_number, pin_number, phone_number, client_email, gender, poastall_address, policy_number, cover_from, cover_to, cert_from, cert_to, vehicle_reg, chassis_number, insurance_class, cover_type, sum_insured, gross_premium, proof_of_payment, method_of_payment, installments, amount, certificate_number, underwriter, seating_capacity, tonnage, optional_benefits, unique_string, agency, subagent, code, username)
    values(:status,:role,:first_name,:middle_name,:last_name,:id_number,:pin_number,:phone_number,:client_email,:gender,:poastall_address,:policy_number,:cover_from,:cover_to,:cert_from,:cert_to,:vehicle_reg,:chassis_number,:insurance_class,:cover_type,:sum_insured,:gross_premium,:proof_of_payment,:method_of_payment,:installments,:amount,:certificate_number,:underwriter,:seating_capacity,:tonnage,:optional_benefits,:unique_string,:agency,:subagent,:code,:username)");
    $insert->bindParam(':status',$status);
    $insert->bindParam(':role',$role);
    $insert->bindParam(':first_name',$first_name);
    $insert->bindParam(':middle_name',$middle_name);
    $insert->bindParam(':last_name',$last_name);
    $insert->bindParam(':id_number',$id_number);
    $insert->bindParam(':pin_number',$pin_number);
    $insert->bindParam(':phone_number',$phone_number);
    $insert->bindParam(':client_email',$client_email);
    $insert->bindParam(':gender',$gender);
    $insert->bindParam(':poastall_address',$poastall_address);
    $insert->bindParam(':cover_from',$cover_from);
    $insert->bindParam(':cover_to',$cover_to);
    $insert->bindParam(':cert_from',$cert_from);
    $insert->bindParam(':cert_to',$cert_to);
    $insert->bindParam(':vehicle_reg',$vehicle_reg);
    $insert->bindParam(':chassis_number',$chassis_number);
    $insert->bindParam(':insurance_class',$insurance_class);
    $insert->bindParam(':cover_type',$cover_type);
    $insert->bindParam(':sum_insured',$sum_insured);
    $insert->bindParam(':gross_premium',$gross_premium);
    $insert->bindParam(':proof_of_payment',$proof_of_payment);
    $insert->bindParam(':method_of_payment',$method_of_payment);
    $insert->bindParam(':installments',$installments);
    $insert->bindParam(':amount',$amount);
    $insert->bindParam(':certificate_number',$certificate_number);
    $insert->bindParam(':underwriter',$underwriter);
    $insert->bindParam(':seating_capacity',$seating_capacity);
    $insert->bindParam(':tonnage',$tonnage);
    $insert->bindParam(':optional_benefits',$optional_benefits);
    $insert->bindParam(':unique_string', $unique_string);
    $insert->bindParam(':agency', $agency);
    $insert->bindParam(':subagent', $subagent);
    $insert->bindParam(':code', $code);
    $insert->bindParam(':username', $username);
    
    include $_SERVER['DOCUMENT_ROOT']."/transactions/stk.php";
    if ($_SESSION["message"] == 0){
        // include $_SERVER['DOCUMENT_ROOT']."/mail/mail.php";
        // include $_SERVER['DOCUMENT_ROOT']."/transactions/invesco/policy.php";
        // if ($apiresponce){
            $insert->bindParam(':policy_number',$policy_number);
            if($insert->execute()){
                $responce=$_SESSION["stk_callback"]->ResultDesc;
                $_SESSION["message"]= $responce;
                // include $_SERVER['DOCUMENT_ROOT'].'/transactions/b2b.php';
                
                header("location: ../../gateway.php");
            }
        // }else{
        //     echo $apiresponce;
        //     $_SESSION["message"] = $error;
        //     header("location: ../../gateway.php");
        // }
        //
        
        // if($insert->execute()){
        //     $responce=$_SESSION["stk_callback"]->ResultDesc;
        //     $_SESSION["message"]= $responce;
        //     include $_SERVER['DOCUMENT_ROOT']."/transactions/invesco/policy.php";
        //     include $_SERVER['DOCUMENT_ROOT']."/mail/mail.php";
        //     header("location: ../../gateway.php");
        // }      
    }else{
        header("location: ../../gateway.php");
    }
    
}else{
    echo "duplicate";
    $responce="Policy Exist Kindly contact your Agent";
    $_SESSION["message"] =$responce;
    header("location: ../../gateway.php");
}
?>