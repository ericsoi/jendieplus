<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include "../../dashboard/db/connect_db.php";


$owner_referal= explode("/", $_SESSION["client_details"]["referal_code"])[0];
$select = $pdo->prepare("select * from tbl_user where code = '$owner_referal'");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);
$_SESSION["agency_owner"]=$row;

if($_SESSION["confirmed_items"]["payments"] == "credit"){
    $status=2;
    $method_of_payment=$_SESSION["confirmed_items"]["payments"];
    $amount=0;
}else{
    $status=0;
    $method_of_payment=$_SESSION["confirmed_items"]["payments"];
}
// print_r($_SESSION);
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
$policy_number=0;
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
$unique_string=$agency.$subagent.$code.$username.$role.$cover_period.$first_name.$middle_name.$last_name.$id_number.$pin_number.$phone_number.$client_email.$gender.$poastall_address.$cover_from.$cover_to.$vehicle_reg.$chassis_number.$insurance_class.$cover_type.$cover_type.$sum_insured.$gross_premium.$installments.$underwriter.$seating_capacity.$tonnage;

$select=$pdo->prepare("SELECT * from tbl_policy where unique_string='$unique_string'");
$select->execute();
$total_records = $select->rowCount();
if($total_records <= 0){
    if($_SESSION["confirmed_items"]["payments"] == "credit"){
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
        $insert->bindParam(':policy_number',$policy_number);
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
        if($insert->execute()){
            $responce="Kindly wait as your agent processes your request";
            $_SESSION["message"]= $responce;
            echo "success";
            echo $responce;
            header("location:../../gateway.php");
        }else{
            $responce = "Error Processingyour request, Kindly contact your Agent";
            $_SESSION["message"]= $responce;
            header("location: ../../gateway.php");
        }
    }
    if($_SESSION["confirmed_items"]["payments"] == "mpesa"){
        include "../../config/db.php";
        include "../../dashboard/db/connect_db.php";
        $user = "Kennedy";
        
        $AccountReference =  $_SESSION["logbook"]["registration"];
        if(strlen($_SESSION["gateway"]["phone"]) < 10){
            $phone = $_SESSION["confirmed_items"]["phone"];
        }else{
            $phone = $_SESSION["gateway"]["phone"];
        }
        $phone = trim($phone);
        if(substr($phone, 0,1) === "0"){
            #echo $phone;
            $phone = "254" . substr($phone, 1);
            
        }elseif (substr($phone, 0,1) === "+") {
            $phone = "" . substr($phone, 1);
        }
            
        $amount = $_SESSION["grosspremium"];
        // $amount = 100;    
        
        include '../credentials.php';
        include '../auth.php';
        $url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer $tocken")); //setting custom header
        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => $shortcode,
            'Password' => $pass,
            'Timestamp' => $tyme,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $phone,
            'PartyB' => $shortcode,
            'PhoneNumber' => $phone,
            'CallBackURL' => $callbackurl,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => 'stk'
        );
                
        $data_string = json_encode($curl_post_data);
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        
        $obj  = json_decode($curl_response);
    
        if (isset($obj->ResponseCode)){
            if($obj->ResponseCode == 0){
                $MerchantRequestID=$obj->MerchantRequestID;
                $CheckoutRequestID=$obj->CheckoutRequestID;
                $ResponseCode=$obj->ResponseCode;
                $ResponseDescription=$obj->ResponseDescription;
                $CustomerMessage=$obj->CustomerMessage;
                // echo $CheckoutRequestID;
                sleep(45);
                // include "../mail/mail.php";
                $sql = "SELECT * from tbl_mpesa where CheckoutRequestID = '$CheckoutRequestID'";
                $sql_res = mysqli_query($connection, $sql);
                $rowcount=mysqli_num_rows($sql_res);
                if ($rowcount>=1){
                    $row = mysqli_fetch_object($sql_res);
                    if($row->ResultCode == 0){
                                
                        // include "../mail/mail.php";
                        // print_r($row);
                        // echo "<br>";
                        // print_r($_SESSION);
                        $_SESSION["stk_callback"]=$row;
                        $responce = $row->ResultDesc . ' '. $phone;
                        include "../../mail/mail.php";
                        $_SESSION["message"]= $responce;
                        $proof_of_payment = $_SESSION["stk_callback"]["MpesaReceiptNumber"];
                        $amount=$_SESSION["stk_callback"]["Amount"];

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
                        $insert->bindParam(':policy_number',$policy_number);
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
                        if($insert->execute()){
                            header("location:../../gateway.php");
                        }
                    }else{
                        $update="UPDATE tbl_mpesa set PhoneNumber = '$phone' where CheckoutRequestID = '$CheckoutRequestID'";
                        if (mysqli_query($connection, $update)) {
                            $echo ="Record updated successfully";
                        }else{
                            $echo = "Error updating record: " . mysqli_error($connection);
                        }
                        $responce = $row->ResultDesc . ' '. $phone;
                        $_SESSION["message"]= $responce;
                        header("location:../../gateway.php");
                    }
                }else{
                    $responce="Kindly check your transaction and try again";
                    $_SESSION["message"]= $responce;
                    header("location:../../gateway.php");
                }
            
        }else{
            echo "error";
            $requestId=$obj->requestId;
            $errorCode=$obj->errorCode;
            $errorMessage=$obj->errorMessage;
            $responce = $errorMessage . ' '. $phone;
            // print_r($obj);
            $_SESSION["message"]= $responce;
            header("location:../../gateway.php");
        }
    }
    }
}     
else{
    $responce="Policy Exist Kindly contact your Agent";
    $_SESSION["message"]= $responce;
    header("location:../../gateway.php");
}
?>