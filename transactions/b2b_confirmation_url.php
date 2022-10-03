<?php
session_start();
include "../config/db.php";
print_r($_SESSION);
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

    $jdata = json_decode($postData,true);
    //perform business operations on $jdata here
    if (count($jdata) == 1){
        $TransactionID = $jdata["Result"]["TransactionID"];
        $underwriter = $jdata["Result"]["ResultParameters"]["ResultParameter"][2]["Value"];
        $code = explode("-", $underwriter)[0];
        $from = $jdata["Result"]["ResultParameters"]["ResultParameter"][4]["Value"];
        $time = $jdata["Result"]["ResultParameters"]["ResultParameter"][5]["Value"];
        $amount = 1;//$_SESSION["gross_premium"];
        $sql = "INSERT INTO tbl_b2b_mpesa_transactions (TransactionID, underwriter, from_party, transaction_time, amount, system_underwriter) VALUES ('$TransactionID', '$underwriter', '$from', '$time', '$amount', '$code')";
    
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
    #print_r($_SESSION);
    echo $resp;
?>
