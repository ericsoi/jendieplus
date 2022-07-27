<?php
session_start();
include "../config/db.php";
try{
    //Set the response content type to application/json
    header("Content-Type:application/json");
    $resp = '{"ResultCode":0,"ResultDesc":"Confirmation recieved successfu"}';
    //read incoming request
    $postData = file_get_contents('php://input');
    //log file
    $filePath = "success.log";
    //error log
    $errorLog = "errors.log";
    //Parse payload to json
//     $postData =       '{
//      "TransactionType": "Pay Bill",
//      "TransID": "PAG0OJ3CDO",
//      "TransTime": "20210116153012",
//      "TransAmount": "5.00",
//      "BusinessShortCode": "7290377",
//      "BillRefNumber": "pay",
//      "InvoiceNumber": "",
//      "OrgAccountBalance": "393.00",
//      "ThirdPartyTransID": "",
//      "MSISDN": "254722301062",
//    "FirstName": "KENNEDY",
//      "MiddleName": "OTIENO",
//      "LastName": "NYAGA"
//      }';


    $jdata = json_decode($postData,true);
    $MerchantRequestID=$jdata["Body"]["stkCallback"]["MerchantRequestID"];
    $CheckoutRequestID=$jdata["Body"]["stkCallback"]["CheckoutRequestID"];
    $ResultCode=$jdata["Body"]["stkCallback"]["ResultCode"];
    $ResultDesc=$jdata["Body"]["stkCallback"]["ResultDesc"];
    $Amount='';
    $MpesaReceiptNumber='';
    $TransactionDate='';
    $PhoneNumber='';

    if($jdata['Body']['stkCallback']['ResultCode'] == 0){
        $Amount=$jdata["Body"]["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"];
        $MpesaReceiptNumber=$jdata["Body"]["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"];
        if($jdata["Body"]["stkCallback"]["CallbackMetadata"]["Item"][2]["Name"] =="Balance"){
            $TransactionDate=$jdata["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"];
            $PhoneNumber=$jdata["Body"]["stkCallback"]["CallbackMetadata"]["Item"][4]["Value"];
        }else{
            $TransactionDate=$jdata["Body"]["stkCallback"]["CallbackMetadata"]["Item"][2]["Value"];
            $PhoneNumber=$jdata["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"];
        }
    }

    $sql = "INSERT INTO tbl_mpesa (MerchantRequestID, CheckoutRequestID, ResultCode, ResultDesc, Amount, MpesaReceiptNumber, TransactionDate, PhoneNumber) VALUES ('$MerchantRequestID','$CheckoutRequestID','$ResultCode','$ResultDesc','$Amount','$MpesaReceiptNumber','$TransactionDate','$PhoneNumber')";
    if (mysqli_query($connection, $sql)) {
        $file = fopen("sqlsuccess.txt",'a');
        fwrite($file,$postData);
        fwrite($file,"\r\n");
    } else {
        $file = fopen("sqlerror.txt",'a');
        fwrite($file,$postData);
        fwrite($file,"\r\n");
        fwrite($file, mysqli_error($connection));
        fwrite($file,"\r\n");    
    }


    //open text file for logging messages by appending
    $file = fopen($filePath,'a');
    //log incoming request
    fwrite($file, $postData);
    fwrite($file,"\r\n");    
    // fwrite($file,$resp);
    fclose($file);
} catch (Exception $ex){
    //append exception to errorLog
    $logErr = fopen($errorLog,'a');
    fwrite($logErr, $ex->getMessage());
    fwrite($logErr,"\r\n");
    fclose($logErr);
}
    //echo response
    echo $resp;
?>
