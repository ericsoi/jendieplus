<?php
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/invesco/auth.php';
	//include './auth.php';
	$url = "http://41.84.131.13:8007/api/portal/policies/covertypes";

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
    $message=$resp->messages;
    $obj=$resp->object;
    print_r($obj);
    $STD = $obj[0]; //[id] => 41 [prodshtdesc] => STD [proddesc] => STANDARD COVER
    $TPO = $obj[1]; //[id] => 86 [prodshtdesc] => TPO [proddesc] => THIRD PARTY ONLY
    $TPF = $obj[2]; //[id] => 87 [prodshtdesc] => TPF&T [proddesc] => THIRD PARTY FIRE AND THEFT 
    $COMP = $obj[3]; //[id] => 88 [prodshtdesc] => COMP [proddesc] => COMPREHENSIVE )


?>

