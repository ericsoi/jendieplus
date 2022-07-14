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
    $filePath = "b2b_success.log";
    //error log
    $errorLog = "b2b_errors.log";
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
    //$postData = '{"Result":{"ResultType":0,"ResultCode":0,"ResultDesc":"The service request is processed successfully.","OriginatorConversationID":"24487-4109872-1","ConversationID":"AG_20210118_00005592cd9ffe8a06d3","TransactionID":"PAI3R04TKD","ResultParameters":{"ResultParameter":[{"Key":"DebitPartyCharges","Value":"Disbursement of Funds Charge|KES|0.00&Disbursement of Funds Charge by Receiver|KES|0.00"},{"Key":"CreditAccountBalance","Value":"Working Account|KES|3.00|3.00|0.00|0.00&Charges Paid Account|KES|0.00|0.00|0.00|0.00"},{"Key":"CreditPartyPublicName","Value":"503200 - AIG KENYA INSURANCE COMPANY LTD VIA NCBA"},{"Key":"DebitAccountCurrentBalance","Value":"{Amount={CurrencyCode=KES, MinimumAmount=39900, BasicAmount=399.00}}"},{"Key":"DebitPartyPublicName","Value":"7290377 - Iplus Insurance Agency Limited"},{"Key":"TransCompletedTime","Value":20210118183322}]},"ReferenceData":{"ReferenceItem":[{"Key":"QueueTimeoutURL","Value":"http:\/\/internalapi.safaricom.co.ke\/mpesa\/b2bresults\/v1\/submit"},{"Key":"Occassion"}]}}}';

    $jdata = json_decode($postData,true);

    //perform business operations on $jdata here
    if (count($jdata) == 1){
        $TransactionID = $jdata["Result"]["TransactionID"];
        $underwriter = $jdata["Result"]["ResultParameters"]["ResultParameter"][2]["Value"];
        $from = $jdata["Result"]["ResultParameters"]["ResultParameter"][4]["Value"];
        $time = $jdata["Result"]["ResultParameters"]["ResultParameter"][5]["Value"];
        $amount = 1;//$_SESSION["gross_premium"];
        $sql = "INSERT INTO b2b_mpesa_transactions (TransactionID, underwriter, from_party, time, amount) VALUES ('$TransactionID', '$underwriter', '$from', '$time', '$amount')";
    
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
    print_r($_SESSION);
    echo $resp;
?>
