<?php
include "cred.php";
include "token.php";
$key = "/home/devadmin/keys/Iplus/drlive.crt";
$cert = "/home/devadmin/keys/Iplus/drlive-decrypted.key";
$pem = "/home/devadmin/keys/Iplus/keyfile-encrypted-pem.key";
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

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.dmvic.com/api/VC3/Integration/ValidateDoubleInsurance",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer $token",
    "ClientID: $ClientID"
  ),
  CURLOPT_SSLCERT => $cert,
  CURLOPT_SSLKEY => $key,
  CURLOPT_CAINFO => $pem,
  CURLOPT_POSTFIELDS => http_build_query($data)
));

$response = curl_exec($curl);
$info = curl_errno($curl)>0 ? array("curl_error_".curl_errno($curl)=>curl_error($curl)) : curl_getinfo($curl);
print_r($info);
curl_close($curl);
echo $response;
?>