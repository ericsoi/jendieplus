<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/token.php';
include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/cred.php';
$today = date("d/m/Y");
$datetime = DateTime::createFromFormat("d/m/Y", $today);
$datetime->modify('+1 year');
$new_date = $datetime->format("d/m/Y");
$vehicle_reg = $_SESSION["client_details"]['vehicle_reg'];
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.dmvic.com/api/VC3/IntermediaryIntegration/IssuanceTypeDCertificate ',
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
    "Membercompanyid":11,
    "TypeOfCertificate": 4,
    "Typeofcover": 100,
    "Policyholder": "SA",
    "policynumber": "SAPOL123",
    "Commencingdate": "01/01/2019",
    "Expiringdate": "08/08/2019",
    "Registrationnumber": "KPL343Q",
    "Chassisnumber": "JIT123DFREW12123",
    "Phonenumber": "789789789",
    "Bodytype": "BT",
    "Licensedtocarry": 9,
    "Tonnage": 10,
    "Vehiclemake": "AUDI",
    "Vehiclemodel": "AUDI",
    "Enginenumber": "ENG123",
    "Email": "xxxxxxxxx@dmvic.info",
    "SumInsured": 100000,
    "InsuredPIN": "A123456789A",
    "Yearofmanufacture": 2019,
    "HudumaNumber": "123456789012"
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