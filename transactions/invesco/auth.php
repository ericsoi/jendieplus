<?php

    $url = "http://41.84.131.13:8007/api/public/login";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = '{"username": "APIUSER", "password": "test"}';
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    curl_setopt($curl, CURLOPT_HEADER, false);
    $resp = curl_exec($curl);
    $resp= json_decode($resp);
    $token=$resp->token;
    echo $token;
?>

