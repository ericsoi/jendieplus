<?php
    session_start();
    
    include "token.php";
    include "cred.php";
    //The url you wish to send the POST request to
    $url = "https://api.dmvic.com/api/VC3/Integration/ValidateDoubleInsurance";
            
    //The data you want to send via POST
    // $fields = [
    //     "policystartdate"               => $_SESSION["policystartdate"],
    //     "policyenddate"                 => $_SESSION["policyenddate"],
    //     "vehicleregistrationnumber"     => $_SESSION["vehicleregistrationnumber"],
    //     "chassisnumber"                 => $_SESSION["chassisnumber"],
    // ];

    $policystartdate = "28/07/2022";
    $policyenddate = "27/08/2022";
    $vehicleregistrationnumber = "KCW543Q";
    $chassisnumber = "DE3FS-529014";
    $fields = [
        "policystartdate"               => $policystartdate,
        "policyenddate"                 => $policyenddate,
        "vehicleregistrationnumber"     => $vehicleregistrationnumber,
        "chassisnumber"                 => $chassisnumber
    ];

    $fields_string = json_encode($fields);
    //url-ify the data for the POST
    // $fields_string = http_build_query($fields);
    
    //open connection
    $ch = curl_init();
    $certificate = "/opt/lampp/htdocs/jendieplus.co.ke/transactions/cert/server.crt";
    $privatekey="/opt/lampp/htdocs/jendieplus.co.ke/transactions/cert/server.key";
    //set the url, number of POST vars, POST data
    $headers = array(
        "Authorization: Bearer".$token,
        "ClientID: ".$ClientID
    );

    curl_setopt($ch,CURLOPT_HEADER, $headers); //setting a custom header
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_SSLVERSION,1);
    // curl_setopt($ch, CURLOPT_PORT , 443);
    // curl_setopt($ch,CURLOPT_SSLCERTTYPE,"PEM");
    // curl_setopt($ch, CURLOPT_SSLCERT,"../cert/cert.pem");
    // curl_setopt($ch, CURLOPT_SSLKEY, "../cert/chain.pem");

    // curl_setopt($ch, CURLOPT_CAINFO, "../cert/server.crt");
    // curl_setopt($ch, CURLOPT_SSLKEY,  $privatekey);
    // curl_setopt($ch, CURLOPT_SSLCERT, $certificate);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
    
    $response = curl_exec($ch);
    print_r($response);
    $info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);
    print_r($info);
    echo $response;
    curl_close($ch);
    
    //$jresult = json_decode($result,true);
    //$token = $jresult['token'];
?>