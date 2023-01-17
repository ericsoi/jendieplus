<?php
include "token.php";
include "cred.php";
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.dmvic.com/api/VC3/Integration/ValidateDoubleInsurance',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_SSLCERTTYPE => "PEM",
  CURLOPT_SSLCERT => getcwd() . "/file.pem",
//   CURLOPT_KEYPASSWD => "cVTVkrHB2B3sr9xN",
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_SSL_VERIFYHOST => 2,
//   CURLOPT_POSTFIELDS =>'{
//     "policystartdate":"13/01/2023",
//     "policyenddate":"12/02/2023",
//     "vehicleregistrationnumber":"KCW543Q",
//     "chassisnumber":"DE3FS-529014"
//   }',
    CURLOPT_POSTFIELDS =>'{
    "policystartdate":"17/01/2023",
    "policyenddate":"16/05/2023",
    "vehicleregistrationnumber":"dsd",
    "chassisnumber":"DE3FS-529014t"
  }',
  CURLOPT_HTTPHEADER => array(
    "ClientID: $ClientID",
    "Authorization: Bearer $token",
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
$info =curl_errno($curl)>0 ? array("curl_error_".curl_errno($curl)=>curl_error($curl)) : curl_getinfo($curl);
// print_r($info);
$double_insurance = json_decode($response, true);
$object = (object) $double_insurance;
print_r($object->Error);
print_r($object);
curl_close($curl);

// Certificate # : C26246423 
// Policy # : CRP/1/070/900000/2022 
// Vehicle Registration # : KCF477X 
// Chassis # : WVWZZZ1KZ8M116664 
// Certificate Validity Duration : 17/01/2023 to 16/02/2023