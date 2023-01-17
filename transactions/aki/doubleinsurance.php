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
  CURLOPT_URL => 'https://api.dmvic.com/api/VC3/Integration/ValidateDoubleInsurance',
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
//   CURLOPT_POSTFIELDS =>'{
//     "policystartdate":"13/01/2023",
//     "policyenddate":"12/02/2023",
//     "vehicleregistrationnumber":"KCW543Q",
//     "chassisnumber":"DE3FS-529014"
//   }',
  CURLOPT_POSTFIELDS =>'{
    "policystartdate":"'.$today.'",
    "policyenddate":"'.$new_date.'",
    "vehicleregistrationnumber":"'.$vehicle_reg.'",
    "chassisnumber":"DE3FS-529014yuiuiyy"
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
// print_r($object->Error);
$_SESSION["DMVIC"] = $object;
// if(count($error) < 1){
//     $CoverEndDate = $object->callbackObj["DoubleInsurance"][0]["CoverEndDate"];
//     $InsuranceCertificateNo = $object->callbackObj["DoubleInsurance"][0]["InsuranceCertificateNo"];
//     $MemberCompanyName = $object->callbackObj["DoubleInsurance"][0]["MemberCompanyName"];
//     $RegistrationNumber = $object->callbackObj["DoubleInsurance"][0]["RegistrationNumber"];
//     $ChassisNumber = $object->callbackObj["DoubleInsurance"][0]["ChassisNumber"];
//     $EndDate = DateTime::createFromFormat("d/m/Y H:i", $CoverEndDate);
//     $_SESSION["DMVIC"] = $object->callbackObj;
    // if ($now > $EndDate) {
    //     $_SESSION["DMVIC"]["DoubleInsurance"]
    //     echo "The date is less than today's date.<br>" . $EndDate->format('d-m-Y') . "<br>" . $now->format('d-m-Y');
    // } else {
    //     echo "The date is greater than or equal to today's date.<br>" . $EndDate->format('d-m-Y') . "<br>" . $now->format('d-m-Y');
    //     $_SESSION["DMVIC"]["DoubleInsurance"] = $EndDate->format('d-m-Y');
    // }

    // print_r($success);
// }

// print_r($success);
curl_close($curl);

// Certificate # : C26246423 
// Policy # : CRP/1/070/900000/2022 
// Vehicle Registration # : KCF477X 
// Chassis # : WVWZZZ1KZ8M116664 
// Certificate Validity Duration : 17/01/2023 to 16/02/2023