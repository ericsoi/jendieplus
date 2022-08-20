<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include "../../dashboard/db/connect_db.php";


if($_SESSION["confirmed_items"]["payments"] == "credit"){
    $status=2;
}else{
    $status=0;
}
$agency=$_SESSION['user']->agency;
$subagent=$_SESSION['user']->subagent;
$code=$_SESSION['user']->code;
$username=$_SESSION['user']->phonenumber;
$role=$_SESSION['user']->role;

$first_name=$_SESSION["confirmed_items"]["firstname"];
$middle_name=$_SESSION["confirmed_items"]["firstname"];
$last_name=$_SESSION["confirmed_items"]["lastname"];
$id_number=$_SESSION["confirmed_items"]["idnumber"];
$pin_number=$_SESSION["confirmed_items"]["kra"];
$phone_number=$_SESSION["confirmed_items"]["phonenumber"];
$client_email=$_SESSION["confirmed_items"]["emailaddress"];
$gender=$_SESSION["client_details"]["inlineRadioOptions"];
$poastall_address=$_SESSION["confirmed_items"]["postaladdress"];
$policy_number=0;
$cover_from=$_SESSION[""];
$cover_to=$_SESSION[""];
$cert_from=0;
$cert_to=0;
$vehicle_reg=$_SESSION[""];
$chassis_number=$_SESSION[""];
$insurance_class=$_SESSION[""];
$cover_type=$_SESSION[""];
$sum_insured=$_SESSION[""];
$gross_premium=$_SESSION[""];
$proof_of_payment=$_SESSION[""];
$method_of_payment=$_SESSION[""];
$installments=$_SESSION[""];
$amount=$_SESSION[""];
$certificate_number=$_SESSION[""];
$underwriter=$_SESSION[""];
$seating_capacity=$_SESSION[""];
$tonnage=$_SESSION[""];
$optional_benefits=$_SESSION[""];
$unique_string=$_SESSION[""];


    // $select=$pdo->prepare("SELECT * from $table where unique_string='$unique_string'");
    // $select->execute();
    // $total_records = $select->rowCount();
    // if($total_records <= 0){
    //     $insert = $pdo->prepare("INSERT INTO tbl_policy(status,role,first_name, middle_name, last_name, id_number, pin_number, phone_number, client_email, gender, poastall_address, policy_number, cover_from, cover_to, cert_from, cert_to, vehicle_reg, chassis_number, insurance_class, cover_type, sum_insured, gross_premium, proof_of_payment, method_of_payment, installments, amount, certificate_number, underwriter, seating_capacity, tonnage, optional_benefits, unique_string, agency, subagent, code, username)
    //     values(:status,:role,:first_name,:middle_name,:last_name,:id_number,:pin_number,:phone_number,:client_email,:gender,:poastall_address,:policy_number,:cover_from,:cover_to,:cert_from,:cert_to,:vehicle_reg,:chassis_number,:insurance_class,:cover_type,:sum_insured,:gross_premium,:proof_of_payment,:method_of_payment,:installments,:amount,:certificate_number,:underwriter,:seating_capacity,:tonnage,:optional_benefits,:unique_string,:agency,:subagent,:code,:username)");
    //     $insert->bindParam(':status',$status);
    //     $insert->bindParam(':role',$role);
    //     $insert->bindParam(':first_name',$first_name);
    //     $insert->bindParam(':middle_name',$middle_name);
    //     $insert->bindParam(':last_name',$last_name);
    //     $insert->bindParam(':id_number',$id_number);
    //     $insert->bindParam(':pin_number',$pin_number);
    //     $insert->bindParam(':phone_number',$phone_number);
    //     $insert->bindParam(':client_email',$client_email);
    //     $insert->bindParam(':gender',$gender);
    //     $insert->bindParam(':poastall_address',$poastall_address);
    //     $insert->bindParam(':policy_number',$policy_number);
    //     $insert->bindParam(':cover_from',$cover_from);
    //     $insert->bindParam(':cover_to',$cover_to);
    //     $insert->bindParam(':cert_from',$cert_from);
    //     $insert->bindParam(':cert_to',$cert_to);
    //     $insert->bindParam(':vehicle_reg',$vehicle_reg);
    //     $insert->bindParam(':chassis_number',$chassis_number);
    //     $insert->bindParam(':insurance_class',$insurance_class);
    //     $insert->bindParam(':cover_type',$cover_type);
    //     $insert->bindParam(':sum_insured',$sum_insured);
    //     $insert->bindParam(':gross_premium',$gross_premium);
    //     $insert->bindParam(':proof_of_payment',$proof_of_payment);
    //     $insert->bindParam(':method_of_payment',$method_of_payment);
    //     $insert->bindParam(':installments',$installments);
    //     $insert->bindParam(':amount',$amount);
    //     $insert->bindParam(':certificate_number',$certificate_number);
    //     $insert->bindParam(':underwriter',$underwriter);
    //     $insert->bindParam(':seating_capacity',$seating_capacity);
    //     $insert->bindParam(':tonnage',$tonnage);
    //     $insert->bindParam(':optional_benefits',$optional_benefits);
    //     $insert->bindParam(':unique_string', $unique_string);
    //     $insert->bindParam(':agency', $agency);
    //     $insert->bindParam(':subagent', $subagent);
    //     $insert->bindParam(':code', $code);
    //     $insert->bindParam(':username', $username);
        
    //     if($insert->execute()){
    //           header("location: policies.php");
    //     }else{
    //       header("location: policies.php");
    //       print_r($insert->errorInfo()[2]);
    //     }
    //   }
?>