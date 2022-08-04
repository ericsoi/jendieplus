<?php
    include './auth.php';
    $url = "http://41.84.131.13:8007/api/portal/policies/saccos";

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
    $obj=$resp->object;
    // print_r($obj);
    $i=0;
    while ($i < count($obj))
    {
        $sacco=$obj[$i];
        print_r($obj[$i]);
        // print_r($obj[$i]);
        echo "<br />";
        $i++;
    }

?>
