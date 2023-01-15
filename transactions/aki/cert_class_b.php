<?php
    
    include "token.php";
    include "cred.php";
    $url = "https://api.dmvic.com/api/VC3/IntermediaryIntegration/IssuanceTypeBCertificate";   
    $fields = [
	"VehicleType"=> 1,
	"Typeofcover"=> 100,
	"Policyholder"=> "Kennedy Otieno",
	"policynumber"=> "CRP/1/080/995000/2022",
	"Commencingdate"=> "13/01/2023",
	"Expiringdate"=> "12/02/2023",   
	"Registrationnumber"=> "KDK900X",
	"Chassisnumber"=> "JIT123DFREW12123",
	"Phonenumber"=> "789789789",
	"Bodytype"=> "Lorry",
	//"TonnageCarryingCapacity"=> 3,
	"Vehiclemake"=> "ISUZU",
	"Vehiclemodel"=> "ISUZU",
	"Enginenumber"=> "ENG123",
	"Email"=> "iplusinsure@gmail.com",
	"SumInsured"=> 1000000,
	"InsuredPIN"=> "A004668793V",
	"Yearofmanufacture"=> 2019,
	"HudumaNumber"=> "27023120",
	"Tonnage"=>3,
	"Licensedtocarry"=>5,
	"Membercompanyid"=>18
   ];

    
    
    $fields_string = http_build_query($fields);
    
    $ch = curl_init();
    $cert = '/home/devadmin/keys/Iplusagencyprod.pfx';
    $password = 'cVTVkrHB2B3sr9xN';
    
    $headers = array(
        "Authorization: Bearer ".$token,
        "ClientID: ".$ClientID,
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSLCERT, $cert);
    curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $password);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
   
    $info =curl_errno($ch)>0 ? array("curl_error_".curl_errno($ch)=>curl_error($ch)) : curl_getinfo($ch); 
    echo json_encode($info);
    $result = curl_exec($ch);
?>
