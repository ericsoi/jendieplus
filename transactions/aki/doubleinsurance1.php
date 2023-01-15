<?php
    // $data = array('key'=>'value');
    include "token.php";
    include "cred.php";
    $policystartdate = "28/07/2022";
    $policyenddate = "27/08/2022";
    $vehicleregistrationnumber = "KCW543Q";
    $chassisnumber = "DE3FS-529014";
    $fields = array(
        "policystartdate"               => $policystartdate,
        "policyenddate"                 => $policyenddate,
        "vehicleregistrationnumber"     => $vehicleregistrationnumber,
        "chassisnumber"                 => $chassisnumber
    );
    $headers = array(
        "Authorization: Bearer".$token,
        "ClientID: ".$ClientID
    );
    $fields_string = json_encode($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, "https://api.dmvic.com/api/VC3/Integration/ValidateDoubleInsurance");
    curl_setopt($ch, CURLOPT_PORT , 443);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    // curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSLCERT, "/etc/letsencrypt/live/jendieplus.co.ke/fullchain.pem");
    curl_setopt($ch, CURLOPT_SSLKEY, "/etc/letsencrypt/live/jendieplus.co.ke/privkey.pem");
    curl_setopt($ch, CURLOPT_CAINFO, "/etc/ssl/certs/ca-certificates.crt");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));

    $response = curl_exec($ch);
    $info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);
    print_r($info);
    curl_close($ch);
    echo $response;
