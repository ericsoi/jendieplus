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
    /*$postData =       '{
     "TransactionType": "Pay Bill",
     "TransID": "PAG0OJ3CDO",
     "TransTime": "20210116153012",
     "TransAmount": "5.00",
     "BusinessShortCode": "7290377",
     "BillRefNumber": "pay",
     "InvoiceNumber": "",
     "OrgAccountBalance": "393.00",
     "ThirdPartyTransID": "",
     "MSISDN": "254722301062",
   "FirstName": "KENNEDY",
     "MiddleName": "OTIENO",
     "LastName": "NYAGA"
     }';*/
    $jdata = json_decode($postData,true);

    //perform business operations on $jdata here
    if (count($jdata) == 1){
        $code = $jdata["Body"]["stkCallback"]["ResultCode"];
        if(!$code == 0){
            $ResultDesc = $jdata["Body"]["stkCallback"]["ResultDesc"];
            if ($code == 1032){
                $ResultDesc = "Payment Request timeout";
            }
            $sql = "INSERT INTO MpesaTransactions (Code, ResultDesc) VALUES ('$code', '$ResultDesc')";
    
            if (mysqli_query($connection, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }
        }
        
    }elseif (count($jdata) == 13){
        $code = '0';
        $TransID = $jdata["TransID"];
        $TransTime = $jdata["TransTime"];
        $TransAmount =$jdata["TransAmount"];
        $MSISDN =$jdata["MSISDN"];
        $FirstName = $jdata["FirstName"];
        $MiddleName = $jdata["MiddleName"];
        $LastName = $jdata["LastName"];
        $BillRefNumber = $jdata["BillRefNumber"];
        $ResultDesc = "The service request is processed successfully";
        $sql = "INSERT INTO MpesaTransactions (code, TransID, TransTime, TransAmount, MSISDN, FirstName, MiddleName, LastName, ResultDesc, BillRefNumber) VALUES ('$code', '$TransID', '$TransTime', '$TransAmount', '$MSISDN', '$FirstName', '$MiddleName', '$LastName', '$ResultDesc', '$BillRefNumber')";
    
        if (mysqli_query($connection, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }
    }
    

    //open text file for logging messages by appending
    $file = fopen($filePath,'a');
    //log incoming request
    fwrite($file, $postData);
    fwrite($file,"\r\n");
    //log response and close file
    fwrite($file,$resp);
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
