<?php

try

{

    //Set the response content type to application/json

    header("Content-Type:application/json");

    $resp='{"ResultCode":0,"ResultDesc":"Recieved successfully"}';

    //read incoming request

    $postData=file_get_contents('php://input');

    //log file

    $filePath="messages.log";

    //error log

    $errorLog="errors.log";

    //Parse payload to json
    echo "JSON DECODE RESULTS";

   $jdata=json_decode($postData,true);
  // echo var_dump(json_decode($postData,true));
print_r($jdata);
   echo $Result= $jdata['Result'];
   echo $Result2= $jdata['Result']['ResultType'];
   echo $Result3= $jdata['Result']['ResultCode'];
   echo $ResultDesc= $jdata['Result']['ResultDesc'];
   echo $origid= $jdata['Result']['OriginatorConversationID'];
   echo $converseid= $jdata['Result']['ConversationID'];
   echo $receipt= $jdata['Result']['TransactionID'];
   echo $amount= $jdata['Result']['ResultParameters']['ResultParameter'][0]['Value'];
   echo $receipt2= $jdata['Result']['ResultParameters']['ResultParameter'][1]['Value'];
   echo $phone= $jdata['Result']['ResultParameters']['ResultParameter'][2]['Value'];
   echo $pay_funds= $jdata['Result']['ResultParameters']['ResultParameter'][3]['Value'];
   echo $name= $jdata['Result']['ResultParameters']['ResultParameter'][4]['Value'];
   echo $Transatym= $jdata['Result']['ResultParameters']['ResultParameter'][5]['Value'];
   echo $avail_funds= $jdata['Result']['ResultParameters']['ResultParameter'][6]['Value'];
   echo $B2CWorkingFunds = $jdata['Result']['ResultParameters']['ResultParameter'][7]['Value'];
    //echo $result_param=$jdata['Result']['ResultParameters']['ResultParameter'];


    //perform business operations on $jdata here
       //include 'resultbeba_db.php';

    //open text file for logging messages by appending

    $file = fopen($filePath,"a");

    //log incoming request

    fwrite($file, $postData);

    fwrite($file,"\r\n");

    //log response and close file

    fwrite($file,$resp);

    fclose($file);

} catch (Exception $ex){

    //append exception to errorLog

    $logErr= fopen($errorLog,"a");

    fwrite($logErr, $ex->getMessage());

    fwrite($logErr,"\r\n");

    fclose($logErr);

}

    //echo response

    echo $resp;

