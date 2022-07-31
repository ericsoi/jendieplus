<?php

$data = array('Username' => "iplusagencyapiuser@dmvic.com",'Password' => "!P202!@GY");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.dmvic.com/api/V1/Account/Login");
curl_setopt($ch, CURLOPT_PORT , 443);
curl_setopt($ch,CURLOPT_SSLCERTTYPE,"PEM");
// curl_setopt($ch, CURLOPT_SSLCERT,"../cert/cert.pem");
// curl_setopt($ch, CURLOPT_SSLKEY, "../cert/fullchain.pem");
curl_setopt($ch, CURLOPT_CAINFO, "../cert/server.crt");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
 
$response = curl_exec($ch);
$info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch);
print_r($info);
curl_close($ch);
echo $response;

?>