<?php
    /*
    //change Benefit to Optional Benefit
    $basic_premium = 1000000; //from quote -> third party only/and theft and comprehensive
    $policy_holder_compensation_fund = (0.2/100) * $basic_premium;
    $training_levy = (0.25/100) * $basic_premium;
    $free_limit = 30000;
    $windscreen_value = 50000; //User Input
    $radio_cassete = 50000; // User Input
    $sum_insured = 1000000;// not included in third party. User Input
    $AA_ROAD_RESQUE = 3000;//not charging training levy and policy holder compensation fund. Included in third party
    $INFAMA_ROAD_RESQUE = 9280;//not charging training levy and policy holder compensation fund. Included in third party
    $AMREF = 3200;//not charging training levy and policy holder compensation fund. Included in third party
    $BIMALIFE = 500;//not charging training levy and policy holder compensation fund. Included in third party
    $PASSENGER_LEGAL_LIABILITY = 500;//not charging training levy and policy holder compensation fund (input enter number of passangers int)
    $EXCESS_PROTECTOR = (0.25/100) * $sum_insured;//
    $EXCESS_PROTECTOR = (0.45/100) * $EXCESS_PROTECTOR + $EXCESS_PROTECTOR;
    $POLITICAL_VIOLENCE_AND_TERRORISM = (0.25/100) * $sum_insured;//(PVT)
    $POLITICAL_VIOLENCE_AND_TERRORISM = (0.45/100) * $POLITICAL_VIOLENCE_AND_TERRORISM + $POLITICAL_VIOLENCE_AND_TERRORISM;
    $WINDSCREEN = ($windscreen_value - $free_limit)*10/100;//(input: Enter Value int(windscreen value)) Value below 0 = 0(No charge)
    $WINDSCREEN = (0.45/100) * $WINDSCREEN + $WINDSCREEN;
    $RADIO_CASSETE = ($radio_cassete - $free_limit)*10/100;//(input: enter Value of radio)
    $RADIO_CASSETE = (0.45/100) * $RADIO_CASSETE + $RADIO_CASSETE;
    $PERSONAL_ACCIDENT = 500; //Included in third party

    $stamp_duty = 40; //for new businesses.
    $gross_premium = $basic_premium + $training_levy + $policy_holder_compensation_fund + $stamp_duty;//+ Optional Benefits(in caps) new businesses 
    #echo "training levy $training_levy \n";
    #echo "policy holder compensation fund $policy_holder_compensation_fund\n";
    #echo  "Windscreen $WINDSCREEN\n";
    #echo  "Radio Cassete $RADIO_CASSETE\n";
    */

include "../bimaplus/config/db.php";
//$jsonobj = '{"Body":{"stkCallback":{"MerchantRequestID":"30457-779409-1","CheckoutRequestID":"ws_CO_16012021152911823780","ResultCode":0,"ResultDesc":"The service request is processed successfully.","CallbackMetadata":{"Item":[{"Name":"Amount","jdatalue":5.00},{"Name":"MpesaReceiptNumber","jdatalue":"PAG0OJ3CDO"},{"Name":"TransactionDate","jdatalue":20210116153013},{"Name":"PhoneNumber","jdatalue":254722301062}]}}}}';
/*$jsonobj = '{
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
$jsonobj = '{"Body":{"stkCallback":{"MerchantRequestID":"13372-920220-1","CheckoutRequestID":"ws_CO_16012021155101510922","ResultCode":1032,"ResultDesc":"Request cancelled by user"}}}';
#$jsonobj = '{"Body":{"stkCallback":{"MerchantRequestID":"30448-809288-1","CheckoutRequestID":"ws_CO_16012021154558038107","ResultCode":1,"ResultDesc":"The balance is insufficient for the transaction"}}}';
#$jsonobj = '{"Body":{"stkCallback":{"MerchantRequestID":"30464-745261-1","CheckoutRequestID":"ws_CO_16012021151556755039","ResultCode":1031,"ResultDesc":"Request cancelled by user"}}}';
$jsonobj = '{"Result":{"ResultType":0,"ResultCode":0,"ResultDesc":"The service request is processed successfully.","OriginatorConversationID":"24487-4109872-1","ConversationID":"AG_20210118_00005592cd9ffe8a06d3","TransactionID":"PAI3R04TKD","ResultParameters":{"ResultParameter":[{"Key":"DebitPartyCharges","Value":"Disbursement of Funds Charge|KES|0.00&Disbursement of Funds Charge by Receiver|KES|0.00"},{"Key":"CreditAccountBalance","Value":"Working Account|KES|3.00|3.00|0.00|0.00&Charges Paid Account|KES|0.00|0.00|0.00|0.00"},{"Key":"CreditPartyPublicName","Value":"503200 - AIG KENYA INSURANCE COMPANY LTD VIA NCBA"},{"Key":"DebitAccountCurrentBalance","Value":"{Amount={CurrencyCode=KES, MinimumAmount=39900, BasicAmount=399.00}}"},{"Key":"DebitPartyPublicName","Value":"7290377 - Iplus Insurance Agency Limited"},{"Key":"TransCompletedTime","Value":20210118183322}]},"ReferenceData":{"ReferenceItem":[{"Key":"QueueTimeoutURL","Value":"http:\/\/internalapi.safaricom.co.ke\/mpesa\/b2bresults\/v1\/submit"},{"Key":"Occassion"}]}}}';
$jdata = json_decode($jsonobj, true);
echo "<br><br><br><br><br><br><br><br>";
//print_r($jdata);
$TransactionID = $jdata["Result"]["TransactionID"];
$underwriter = $jdata["Result"]["ResultParameters"]["ResultParameter"][2]["Value"];
$from = $jdata["Result"]["ResultParameters"]["ResultParameter"][4]["Value"];
$time = $jdata["Result"]["ResultParameters"]["ResultParameter"][5]["Value"];
echo count($jdata);
print_r($jdata)[0];

create table b2b_mpesa_transactions (
    id int NOT NULL AUTO_INCREMENT,
    TransactionID varchar (255), 
    underwriter varchar (255),
    from varchar (255),
    time varchar (255),
    amount varchar (255),
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
)

/*if (count($jdata) == 1){
    $code = $jdata["Body"]["stkCallback"]["ResultCode"];
    if(!$code == 0){
        $ResultDesc = $jdata["Body"]["stkCallback"]["ResultDesc"];
        if ($code == 1032){
            $ResultDesc = "Payment Request timeout";
        }
        $sql = "INSERT INTO MpesaTransactions (Code, ResultDesc) jdataLUES ('$code', '$ResultDesc')";

        if (mysqli_query($connection, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }
    }
    
}elseif (count($jdata) == 13){
    print_r($jdata);
    $code = '0';
    $TransID = $jdata["TransID"];
    $TransTime = $jdata["TransTime"];
    $TransAmount =$jdata["TransAmount"];
    $MSISDN =$jdata["MSISDN"];
    $FirstName = $jdata["FirstName"];
    $MiddleName = $jdata["MiddleName"];
    $LastName = $jdata["LastName"];
    $ResultDesc = "The service request is processed successfully";
    $sql = "INSERT INTO MpesaTransactions (code, TransID, TransTime, TransAmount, MSISDN, FirstName, MiddleName, LastName, ResultDesc) jdataLUES ('$code', '$TransID', '$TransTime', '$TransAmount', '$MSISDN', '$FirstName', '$MiddleName', '$LastName', '$ResultDesc')";

    if (mysqli_query($connection, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}
*/

//$phone = "254712962787";
//echo 0 . substr($phone, 3);