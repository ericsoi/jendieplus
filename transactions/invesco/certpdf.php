<?php
    include './auth.php';
    $certno='C24300559';
    $url = "http://41.84.131.13:8007/api/portal/policies/printdigitalcert?certNo=C24300559";
     
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Content-Type: application/json",
    );
    // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer $token"));
    // $data = '{"username": "APIUSER", "password": "test"}';
    // for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $resp = curl_exec($curl);
    echo $resp;

    curl_close($curl);
?>

