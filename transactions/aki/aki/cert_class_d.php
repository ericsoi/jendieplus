<?php
    session_start();
    
    include "token.php";
    include "cred.php";
    //The url you wish to send the POST request to
    $url = "https://uat-dmvic.azure-api.net/api/V1/IntermediaryIntegration/IssuanceTypeACertificate";
            
    //The data you want to send via POST
    $fields = [
        "IntermediaryIRANumber"       => $_SESSION["IntermediaryIRANumber"],
        "TypeOfCertificate"           => $_SESSION["TypeOfCertificate"],
        "Typeofcover"                 => $_SESSION["Typeofcover"],
        "Policyholder"                => $_SESSION["Policyholder"],
        "policynumber"                => $_SESSION["policynumber"],
        "Commencingdate"              => $_SESSION["Commencingdate"],
        "Expiringdate"                => $_SESSION["Expiringdate"],
        "Registrationnumber"          => $_SESSION["Registrationnumber"],
        "Chassisnumber"               => $_SESSION["Chassisnumber"],
        "Phonenumber"                 => $_SESSION["Phonenumber"],
        "Bodytype"                    => $_SESSION["Bodytype"],
        "Licensedtocarry"             => $_SESSION["Licensedtocarry"],
        "Tonnage"                     => $_SESSION["Tonnage"],
        "Vehiclemake"                 => $_SESSION["Vehiclemake"],
        "Vehiclemodel"                => $_SESSION["Vehiclemodel"],
        "Enginenumber"                => $_SESSION["Enginenumber"],
        "Email"                       => $_SESSION["Email"],
        "SumInsured"                  => $_SESSION["SumInsured"],
        "InsuredPIN"                  => $_SESSION["InsuredPIN"],
        "Yearofmanufacture"           => $_SESSION["Yearofmanufacture"],
        "HudumaNumber"                => $_SESSION["HudumaNumber"]
    ];




    //url-ify the data for the POST
    $fields_string = http_build_query($fields);
    
    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    $headers = array(
        "Authorization: Bearer".$token,
        "ClientID: ".$ClientID,
    );
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
?>