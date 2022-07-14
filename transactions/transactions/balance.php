<?php
	include "auth.php";
	include "/home/ubuntu/credentials.php";
	$url = 'https://api.safaricom.co.ke/mpesa/accountbalance/v1/query';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer $tocken"));  //setting custom header
	$name="Erick";

	$curl_post_data = array(
	//Fill in the request parameters with valid values
	'Initiator' => 'ERICK',
	'SecurityCredential' => $credential,
	'CommandID' => 'AccountBalance',
	'PartyA' => $shortcode,
	'IdentifierType'=> '4',
	'QueueTimeOutURL'=> 'https://bimaplus.co.ke/transactions/calback_urls/balance_url.php',
	'ResultURL'=> 'https://bimaplus.co.ke/transactions/calback_urls/balance_url.php',
	'Remarks' => 'Bimaplus'.$name.'',
	);

	$data_string = json_encode($curl_post_data);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	$curl_response = curl_exec($curl);
	print_r($curl_response);
