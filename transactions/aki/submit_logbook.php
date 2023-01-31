<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/token.php';
include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/cred.php';
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.dmvic.com/api/VC3/Integration/ConfirmCertificateIssuance',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_SSLCERTTYPE => "PEM",
  CURLOPT_SSLCERT => $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/file.pem',
//   CURLOPT_KEYPASSWD => "cVTVkrHB2B3sr9xN",
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_SSL_VERIFYHOST => 2,

  CURLOPT_POSTFIELDS =>'{
    "IssuanceRequestID": "AF-AA0012",
    "IsApproved":true,
    "IsLogBookVerified":true,
    "IsVehicleInspected":true,
    "AdditionalComments":"",
    "UserName":""
    }',
  CURLOPT_HTTPHEADER => array(
    "ClientID: $ClientID",
    "Authorization: Bearer $token",
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
$info =curl_errno($curl)>0 ? array("curl_error_".curl_errno($curl)=>curl_error($curl)) : curl_getinfo($curl);
$double_insurance = json_decode($response, true);
$object = (object) $double_insurance;
print_r($object);

curl_close($curl);