<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/token.php';
include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/cred.php';
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.dmvic.com/api/VC3/IntermediaryIntegration/IssuanceTypeBCertificate',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_SSLCERTTYPE => "PEM",
  CURLOPT_SSLCERT => $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/file.pem',
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_SSL_VERIFYHOST => 2,
  CURLOPT_POSTFIELDS =>'{
        "VehicleType": 1,
        "Typeofcover": 100,
        "Policyholder":"Kennedy Otieno",
        "policynumber":"CRP/1/081/1140000/2022",
        "Commencingdate":"18/01/2023",
        "Expiringdate":"17/01/2024",
        "Registrationnumber": "KPL343W",
        "Chassisnumber": "JIT123DFREW12123",
        "Phonenumber": "789789789",
        "Bodytype": "BT",
        "TonnageCarryingCapacity": 1,
        "Vehiclemake": "AUDI",
        "Vehiclemodel": "AUDI",
        "Enginenumber": "ENG123",
        "Email": "xxxxx@dmvic.info",
        "SumInsured": 100000,
        "InsuredPIN": "A123456789A",
        "Yearofmanufacture": 2019,
        "HudumaNumber": "123456789012",
        "Membercompanyid":11
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
print_r($object);