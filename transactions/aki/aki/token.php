<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.dmvic.com/api/V1/Account/Login',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "Username":"iplusagencyapiuser@dmvic.com",
    "Password":"!P202!@GY"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic aXBsdXNhZ2VuY3lhcGl1c2VyQGRtdmljLmNvbTohUDIwMiFAR1k=',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$jresult = json_decode($response,true);
$token = $jresult['token'];