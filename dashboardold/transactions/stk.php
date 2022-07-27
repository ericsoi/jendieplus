<?php

    session_start();
    if(!isset($_SESSION["underwriter"])) { 
        header("refresh:0;url=../index.php");
    }
    include "../../config/db.php";
    $user = "Kennedy";
    $firstname  = $_SESSION["name_contact"];
    $lastname  = $_SESSION["name_contact"];
    $emailaddress  = $_SESSION["email"];
    $phonenumber  = $_SESSION["phone_number"];
    $gross_premium = $_SESSION["grosspremium"];
    // grosspremium
    #print_r($_SESSION["logbook"]);
    $name = $_SESSION["name_contact"];
    $vehicle_reg = $_SESSION["logbook"]["registration"];
    $vehicle_class = $_SESSION["logbook"]["type"];
    $kra_file  = $_SESSION["logbook"]["kra_number"];
    $krapin  = $_SESSION["logbook"]["kra_number"];
    $logbook_file  = $_SESSION["logbook"]["kra_number"];
    $AccountReference =  $_SESSION["logbook"]["registration"];
    


    #session_destroy();
    #$coverage = $_SESSION["coverage"];
    #$period = $_SESSION["policy_date"];
    $period =  $_SESSION["logbook"]["date"];
    $underwriter = $_SESSION["underwriter"];
    $quotation_date = $_SESSION["logbook"]["reg_date"];
    $premium = $_SESSION["grosspremium"];   
    $success = "Success. Request accepted for processing";
    $email = $_SESSION["email"];
    $test = "This is test Data";
    $_SESSION["stk_callback"] = array("TransactionID"=> $test, "underwriter" => $test, "from_party" => $test);
    if(strlen($_POST["phone"]) < 10){
        $phone = $_SESSION["phone_number"];
        
    }else{
        $phone = $_POST["phone"];
    }
    
    $phone = trim($phone);
    if(substr($phone, 0,1) === "0"){   
        echo $phone;
        $phone = "254" . substr($phone, 1);
        
    }elseif (substr($phone, 0,1) === "+") {
        $phone = "" . substr($phone, 1);
    }

    $amount = 5;
    $amount1 = 5;
    include 'credentials.php';
    include 'auth.php';
    $_SESSION["stk_callback"] = "TEST";
    $owner = $_SESSION["owner"]
    $email = $_SESSION["email"];
    //include '../mail/mail.php';
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
        'Amount' => $premium,
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
        #print_r($obj);
        $success =  $obj->errorMessage;
    }
    $_SESSION["stk_callback"] = "TEST";
    $email = $_SESSION["email"];
    //include '../mail/mail.php';
    if ($success == "Success. Request accepted for processing"){
        sleep(15);
        $sql = "SELECT * from tbl_mpesa_transactions where date >= NOW() - interval 2 minute and MSISDN = '$phone'";
        $res = mysqli_query($connection, $sql);
        // if($row =  mysqli_fetch_assoc($res)){
        if(" " == "i"){
            //include "aki/cert_class_a.php";
            // if(!$akicode){
                include "b2b.php";
                $email = $_SESSION["email"];
                sleep(20);
                $b2b_sql = "SELECT * from tbl_b2b_mpesa_transactions where date >= NOW() - interval 1 minute";
                $stk_sql = "SELECT * from tbl_b2b_mpesa_transactions where date>=NOW() - interval 1 minute order by id DESC limit 1";
                $b2b_res = mysqli_query($connection, $b2b_sql);
                // if ($b2b_row = mysqli_fetch_assoc($b2b_res)){
                    if("i" == "i"){
                    $res = mysqli_query($connection, $stk_sql);
                    // if($row =  mysqli_fetch_assoc($res)){
                    if("i" == "i"){
                        $_SESSION["stk_callback"] = $row;
                        include '../mail/mail.php';
                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                            $user  = $_SESSION["username"];
                            $commission = 9/100*(float)$premium;
                            $_SESSION["commission"] = $commission;
                            $policy = "INSERT INTO tbl_client (Fname, Lname, Cert_for, KRA_PIN, EMAIL, PHONE, VEHICLE_DETAILS, Created_By) VALUES('$firstname', '$lastname', '$kra_file', '$krapin', '$emailaddress', '$phonenumber', '$logbook_file', '$user')";
                            $wallet = "UPDATE tbl_user SET wallet = wallet + '$commission' WHERE agent = '$owner'";
                            $quote = "INSERT INTO tbl_quote(name, phone, email, vehicle_reg, vehicle_class, coverage, period, underwriter, quatation_date, premium, agent) VALUES('$name','$phonenumber','$emailaddress','$vehicle_reg','$vehicle_class','$coverage','$period','$underwriter','$quotation_date','$premium','$user')";
                            if (mysqli_query($connection, $policy)) {
                                $message = "New record created successfully";
                            } else {
                                $message = "Error: " . $policy . "<br>" . mysqli_error($connection);
                            }
                            if (mysqli_query($connection, $quote)) {
                                $message = "New record created successfully";
                            } else {
                                $message =  "Error: " . $quote . "<br>" . mysqli_error($connection);
                            }
                            if (mysqli_query($connection, $wallet)) {
                                $_SESSION["toast"] = True;
                                //header("refresh:2;url=../gateway.php");
                                //header("location: ../../dashboard");
                            }else{
                                echo mysqli_error($connection);
                            }
                            
                            if (mysqli_query($connection, $wallet)) {
                                $_SESSION["toast"] = True;
                                //header("location: ../../dashboard");
                            }else{
                                echo mysqli_error($connection);
                            }
                        }
                        $policy = "INSERT INTO tbl_client (Fname, Lname, Cert_for, KRA_PIN, EMAIL, PHONE, VEHICLE_DETAILS, Created_By) VALUES('$firstname', '$lastname', '$kra_file', '$krapin', '$emailaddress', '$phonenumber', '$logbook_file', '$user')";
                        $quote = "INSERT INTO tbl_quote(name, phone, email, vehicle_reg, vehicle_class, coverage, period, underwriter, quatation_date, premium, agent) VALUES('$name','$phonenumber','$email','$vehicle_reg','$vehicle_class','$coverage','$period','$underwriter','$quotation_date','$premium', 'bimaplus')";
                        $wallet = "INSERT INTO tbl_user"
                        if (mysqli_query($connection, $policy)) {
                            $message  = "New record created successfully";
                        } else {
                            $message = "Error: " . $policy . "<br>" . mysqli_error($connection);
                        }
                        if (mysqli_query($connection, $quote)) {
                            $message  = "New record created successfully";
                        } else {
                            $message = "Error: " . $quote . "<br>" . mysqli_error($connection);
                        }
                        $responce = $success;
                        include "alert.php";
                        //header("refresh:2;url=../index.php");
                    }   
                }
            //}
        }else{
            //echo "ddd";
            $responce = "Kindly recheck the transaction and try again";
            include "alert.php";
            header("refresh:2;url=../gateway.php");
        }      
        #header("refresh:2;url=../bimaplus1/gateway.php");
        //print_r($_SESSION);
        //echo $phone;
        include "alert.php";
        //eader("refresh:2;url=../index.php");
        //session_destroy();
    }else{
        $responce = $success . $phone;
        include "alert.php";
        #header("refresh:2;url=../gateway.php");
    }

?>