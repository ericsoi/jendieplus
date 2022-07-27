<?php
	include "auth.php";
	include "credentials.php";
	$url = 'https://api.safaricom.co.ke/mpesa/accountbalance/v1/query';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer $tocken"));  //setting custom header
	$name="james";

	$curl_post_data = array(
	//Fill in the request parameters with valid values
	'Initiator' => 'ERICKSOI',
	'SecurityCredential' => $credential,
	'CommandID' => 'AccountBalance',
	'PartyA' => '7290377',
	'IdentifierType'=> '4',
	'QueueTimeOutURL' => 'https://jendieplus.co.ke/transactions/confirmation_url.php',
	'ResultURL' => 'https://jendieplus.co.ke/transactions/confirmation_url.php',
	'Remarks' => 'jendieplus'.$name.''
	);

	$data_string = json_encode($curl_post_data);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	$curl_response = curl_exec($curl);
	print_r($curl_response);
