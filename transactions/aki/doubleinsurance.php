<?php
    include "token.php";
    include "cred.php";

    //The url you wish to send the POST request to
    $url = "https://api.dmvic.com/api/VC3/Integration/ValidateDoubleInsurance";
    $policystartdate = "13/01/2023";
    $policyenddate = "12/02/2023";
    $vehicleregistrationnumber = "KMGE963Z";
    $chassisnumber = "MD2A21BX7NWA89792";
    $data = array(
        "policystartdate"               => $policystartdate,
        "policyenddate"                 => $policyenddate,
        "vehicleregistrationnumber"     => $vehicleregistrationnumber,
        "chassisnumber"                 => $chassisnumber
    );
    $headers = array(
        "Authorization: Bearer".$token,
        "ClientID: ".$ClientID
    );
    $cert = '/home/devadmin/keys/live.key';
    $password = 'devadmin';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_PORT , 443);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    //curl_setopt($ch, CURLOPT_SSLCERT, "/etc/letsencrypt/live/jendieplus.co.ke/cert.pem");
    curl_setopt($ch, CURLOPT_SSLCERT, $cert);
    curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $password);
    //curl_setopt($ch, CURLOPT_SSLKEYPASSWD , $password);
    //curl_setopt($ch, CURLOPT_SSLKEY, "/etc/letsencrypt/live/jendieplus.co.ke/privkey.pem");
    //curl_setopt($ch, CURLOPT_CAINFO, "/etc/letsencrypt/live/jendieplus.co.ke/chain.pem");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    $info = curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);
    print_r($info);
    curl_close($ch);
    echo $response;
?>



