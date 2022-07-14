<?php
    #print_r($_SESSION);
    include "aki/token.php";
    include "aki/cred.php";
    //The url you wish to send the POST request to
    $url = "https://uat-dmvic.azure-api.net/api/V1/IntermediaryIntegration/IssuanceTypeACertificate";
            
    //The data you want to send via POST
    // $fields = [
    //     "Membercompanyid"       =>  $_SESSION["Membercompanyid"],
    //     "TypeOfCertificate"     =>  $_SESSION["TypeOfCertificate"],
    //     "Typeofcover"           =>  $_SESSION["Typeofcover"],
    //     "Policyholder"          =>  $_SESSION["Policyholder"],
    //     "policynumber"          =>  $_SESSION["policynumber"],
    //     "Commencingdate"        =>  $_SESSION["Commencingdate"],
    //     "Expiringdate"          =>  $_SESSION["Expiringdate"],
    //     "Registrationnumber"    =>  $_SESSION["Registrationnumber"],
    //     "Chassisnumber"         =>  $_SESSION["Chassisnumber"],
    //     "Phonenumber"           =>  $_SESSION["Phonenumber"],
    //     "Bodytype"              =>  $_SESSION["Bodytype"],
    //     "Licensedtocarry"       =>  $_SESSION["Licensedtocarry"],
    //     "Vehiclemake"           =>  $_SESSION["Vehiclemake"],
    //     "Vehiclemodel"          =>  $_SESSION["Vehiclemodel"],
    //     "Enginenumber"          =>  $_SESSION["Enginenumber"],
    //     "Email"                 =>  $_SESSION["Email"],
    //     "SumInsured"            =>  $_SESSION["SumInsured"],
    //     "InsuredPIN"            =>  $_SESSION["InsuredPIN"],
    //     "Yearofmanufacture"     =>  $_SESSION["Yearofmanufacture"],
    //     "HudumaNumber"          =>  $_SESSION["HudumaNumber"]
    // ];
    $today = date("d/m/Y");
    $end = date('d/m/Y', strtotime('+1 years'));

    $fields = [
            "Membercompanyid"=>"11",
            "TypeOfCertificate"=> "1",
            "Typeofcover"=> "100",
            "Policyholder"=> "SA",
            "policynumber"=> "SAPOL123",
            "Commencingdate"=> $today,
            "Expiringdate"=> $end,
            "Registrationnumber"=> "KPL343W",
            "Chassisnumber"=> "JIT123DFREW12123",
            "Phonenumber"=> "789789789",
            "Bodytype"=> "BT",
            "Licensedtocarry"=> "9",
            "Vehiclemake"=> "AUDI",
            "Vehiclemodel"=> "AUDI",
            "Enginenumber"=> "ENG123",
            "Email"=> "xxxxxxx@dmvic.info",
            "SumInsured"=> "100000",
            "InsuredPIN"=> "A123456789A",
            "Yearofmanufacture"=> "2019",
            "HudumaNumber"=> "123456789012",
    ];
    
    //url-ify the data for the POST
    $fields_string = json_encode($fields);

    //$fields_string = http_build_query($fields);
    
    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    $headers = array(
        "Authorization:Bearer ".$token,
        "ClientID: ".$ClientID,
    );
    curl_setopt($ch,CURLOPT_HTTPHEADER, $headers); //setting a custom header
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    
    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    //execute post
    $jsonobj = curl_exec($ch);
    #echo $jsonobj;
    $result = json_decode($jsonobj);
    $error = "";
    if ($result->success){
        $res = $result->success;
        $error = False;
    }else{
        $res = $result->Error[0]-> errorText;
        $error = $result->Error[0]-> errorCode;
    }
    
    $akimessage = $res;
    $akicode = $error;

    #print_r($result->Error[0]["errorCode"]);
    //echo $result->Inputs;
    //print_r($result->callbackObj);
    //echo $result->Error;
    //$jresult = json_decode($result,true);
    //$token = $jresult['token'];
    // login
    // issue cert intermediary
    // validate cert  intermediary
    // member company stock intermediary
    // preview cert intermediary


?>
