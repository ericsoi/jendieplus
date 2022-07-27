<?php

    session_start();
    if(!isset($_SESSION["underwriter"])) { 
        header("refresh:0;url=../index.php");
    }
    include "../config/db.php";
    $amount = "1";//$_SESSION["gross_premium"];
    $amount1 = $_SESSION["gross_premium"];
    #echo $amount;
    if(strlen($_POST["phone"]) < 10){
        $phone = $_SESSION["phone_number"];
        
    }else{
        $phone = $_POST["phone"];
    }
    $phone = trim($phone);
    if(substr($phone, 0,1) == 0){   
        $phone = "254" . substr($phone, 1);
    }
    
    $AccountReference = $_SESSION["registration"];
    
    include 'credentials.php';
    include 'auth.php';
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
    
    if (isset($obj->CustomerMessage)) {
        $success = $obj->CustomerMessage;
    }else{
        $success =  $obj->errorMessage;
    }
    if ($success == "Success. Request accepted for processing"){
        sleep(5);
        $sql = "SELECT * from tbl_mpesa_transactions where date >= NOW() - interval 2 minute and MSISDN = '$phone'";
        $res = mysqli_query($connection, $sql);
        if($row =  mysqli_fetch_assoc($res)){
            //include "aki/cert_class_a.php";
           // if(!$akicode){
                include "b2b.php";
                $email = $_SESSION["email"];
                sleep(5);
                $b2b_sql = "SELECT * from b2b_mpesa_transactions where date >= NOW() - interval 1 minute";
                
                $b2b_res = mysqli_query($connection, $b2b_sql);
                if ($b2b_row = mysqli_fetch_assoc($b2b_res)){
                    $stk_sql = "SELECT * from b2b_mpesa_transactions where date>=NOW() - interval 1 minute order by id DESC limit 1";
                    $res = mysqli_query($connection, $stk_sql);
                    if($row =  mysqli_fetch_assoc($res)){
                        $_SESSION["stk_callback"] = $row;
                        include '../mail/mail.php';
                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                            $user  = $_SESSION["username"];
                            $commission = 9/100*(float)$amount1;
                            $_SESSION["commission"] = $commission;
                            $wallet = "UPDATE users SET wallet = wallet + '$commission' WHERE username = '$user'";
                            if (mysqli_query($connection, $wallet)) {
                                $_SESSION["toast"] = True;
                                header("location: ../../dashboard");
                            }else{
                                echo mysqli_error($connection);
                            }
                        }
                        $responce = $success;
                        include "alert.php";
                        header("refresh:2;url=../index.php");
                    }   
                }
            //}
        }else{
            $responce = "Kindly recheck the transaction and try again";
            include "alert.php";
            header("refresh:2;url=../gateway.php");
        }      
        #header("refresh:2;url=../bimaplus1/gateway.php");
        //print_r($_SESSION);
        //echo $phone;
        include "alert.php";
        header("refresh:2;url=../index.php");
        session_destroy();
    }else{
        $responce = $success . $phone;
        include "alert.php";
        #header("refresh:2;url=../gateway.php");
    }

?>