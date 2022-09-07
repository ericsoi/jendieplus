<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    include "../config/db.php";
    include "../dashboard/db/connect_db.php";
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
    $amount = 50;
    // echo $amount;
    // print_r($_SESSION)

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
                    if($_SESSION["confirmed_items"]["payments"] == "credit"){
                        include "processing/handle_policy.php";
                        
                        include "../mail/mail.php";
                        include "alert.php";
                        header("refresh:2;url=../index.php");
                    }
                }else{
                    $update="UPDATE tbl_mpesa set PhoneNumber = '$phone' where CheckoutRequestID = '$CheckoutRequestID'";
                    if (mysqli_query($connection, $update)) {
                        $echo ="Record updated successfully";
                      } else {
                        $echo = "Error updating record: " . mysqli_error($connection);
                      }
                    $responce = $row->ResultDesc . ' '. $phone;
                    include "alert.php";
                    header("refresh:2;url=../../gateway.php");
                }
            }else{
                $responce="Kindly check your transaction and try again";
                include "alert.php";
                header("refresh:2;url=../../gateway.php");
            }

        }
    }else{
        echo "error";
        $requestId=$obj->requestId;
        $errorCode=$obj->errorCode;
        $errorMessage=$obj->errorMessage;
        $responce = $errorMessage . ' '. $phone;
        // print_r($obj);
        include "alert.php";
        header("refresh:2;url=../../gateway.php");
    }

        // if($row =  mysqli_fetch_assoc($res)){
        //     //include "aki/cert_class_a.php";
        //    // if(!$akicode){
        //         include "b2b.php";
        //         $email = $_SESSION["email"];
        //         sleep(5);
        //         $b2b_sql = "SELECT * from b2b_mpesa_transactions where date >= NOW() - interval 1 minute";
                
        //         $b2b_res = mysqli_query($connection, $b2b_sql);
        //         if ($b2b_row = mysqli_fetch_assoc($b2b_res)){
        //             $stk_sql = "SELECT * from b2b_mpesa_transactions where date>=NOW() - interval 1 minute order by id DESC limit 1";
        //             $res = mysqli_query($connection, $stk_sql);
        //             if($row =  mysqli_fetch_assoc($res)){
        //                 $_SESSION["stk_callback"] = $row;
        //                 include '../mail/mail.php';
        //                 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        //                     $user  = $_SESSION["username"];
        //                     $commission = 9/100*(float)$amount;
        //                     $_SESSION["commission"] = $commission;
        //                     $wallet = "UPDATE users SET wallet = wallet + '$commission' WHERE username = '$user'";
        //                     if (mysqli_query($connection, $wallet)) {
        //                         $_SESSION["toast"] = True;
        //                         header("location: ../../dashboard");
        //                     }else{
        //                         echo mysqli_error($connection);
        //                     }
        //                 }
        //                 $responce = $success;
        //                 include "alert.php";
        //                 header("refresh:2;url=../index.php");
        //             }   
        //         }
        //     //}
        // }else{
        //     $responce = "Kindly recheck the transaction and try again";
        //     include "alert.php";
        //     header("refresh:2;url=../../gateway.php");
        // }      
        // #header("refresh:2;url=../bimaplus1/gateway.php");
        // //print_r($_SESSION);
        // //echo $phone;
        // include "alert.php";
        // header("refresh:2;url=../index.php");
        // session_destroy();


?>