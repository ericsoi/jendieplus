<?php
session_start();
include "../config/db.php";
try{
    //Set the response content type to application/json
    header("Content-Type:application/json");
    // $resp = '{"ResultCode":0,"ResultDesc":"Confirmation recieved successfu"}';
    // //read incoming request
    $postData = file_get_contents('php://input');

    // include "./jdata.php";
    $data = json_decode($postData);
    $Amount=''; $MpesaReceiptNumber='';$TransactionDate=''; $PhoneNumber='';
    $MerchantRequestID=$data->Body->stkCallback->MerchantRequestID;
    $CheckoutRequestID=$data->Body->stkCallback->CheckoutRequestID;
    $ResultCode=$data->Body->stkCallback->ResultCode;
    $ResultDesc=$data->Body->stkCallback->ResultDesc;
    if($data->Body->stkCallback->ResultCode == 0){
        $Amount=$data->Body->stkCallback->CallbackMetadata->Item["0"]->Value;
        $MpesaReceiptNumber=$data->Body->stkCallback->CallbackMetadata->Item["1"]->Value;
        if($TransactionDate=$data->Body->stkCallback->CallbackMetadata->Item["2"]->Name == "Balance"){
            $TransactionDate=$data->Body->stkCallback->CallbackMetadata->Item["3"]->Value;
            $PhoneNumber=$data->Body->stkCallback->CallbackMetadata->Item["4"]->Value;
        }else{
            $TransactionDate=$data->Body->stkCallback->CallbackMetadata->Item["2"]->Value;
            $PhoneNumber=$data->Body->stkCallback->CallbackMetadata->Item["3"]->Value;
        }
    }
    $sql = "INSERT INTO tbl_mpesa (MerchantRequestID, CheckoutRequestID, ResultCode, ResultDesc, Amount, MpesaReceiptNumber, TransactionDate, PhoneNumber) VALUES ('$MerchantRequestID','$CheckoutRequestID','$ResultCode','$ResultDesc','$Amount','$MpesaReceiptNumber','$TransactionDate','$PhoneNumber')";
    if (mysqli_query($connection, $sql)) {
        $myfile = fopen("success.log", "a") or die("Unable to open file!");
        fwrite($myfile, $postData);
        fwrite($myfile, "\r\n");
        fclose($myfile);
    } else {
        $myfile = fopen("sqlerror.txt",'a');
        fwrite($myfile,$postData);
        fwrite($myfile,"\r\n");
        fwrite($myfile, mysqli_error($connection));
        fwrite($myfile,"\r\n");  
        fclose($myfile);  
    }
    
} catch (Exception $ex){
    //append exception to errorLog
    $logErr = fopen('error.log','a');
    fwrite($logErr, $ex->getMessage());
    fwrite($logErr,"\r\n");
    fclose($logErr);
}
    //echo response
?>
