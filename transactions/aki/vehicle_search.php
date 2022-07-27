<?php
    include "token.php";
    include "cred.php";
    //The url you wish to send the POST request to
    $url = "https://uat-dmvic.azure-api.net/api/V12/Integration/VehicleSearch";
            
    //The data you want to send via POST
    $fields = [
        'VehicleRegistrationNumber' => "KAC040R",
    ];
    
    //url-ify the data for the POST
    $fields_string = json_encode($fields);
    
    //open connection
    $ch = curl_init();
    $headers = array(
        "Authorization:Bearer ".$token,
        "ClientID: ".$ClientID,
    );
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_HTTPHEADER, $headers); //setting a custom header
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    
    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    
    //execute post
    $result = curl_exec($ch);
    echo $result;
    //$jresult = json_decode($result,true);
    //$token = $jresult['token'];
    // validation.
    // cert inventory. 
    // preview 4.
?>