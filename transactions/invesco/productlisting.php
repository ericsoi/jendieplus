<?php
    // include './auth.php';
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/invesco/auth.php';
    $url = "http://41.84.131.13:8007/api/portal/policies/products";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
    "Content-Type: application/json",
    );

    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer $token"));

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $resp = curl_exec($curl);
    $resp= json_decode($resp);
    // print_r($resp);
    $message=$resp->messages;
    $product_listing=$resp->object;
    // print_r($product_listing);
    
?>
