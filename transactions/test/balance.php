<?php
	include '/home/ubuntu/credentials.php';
	include 'auth.php';
	$url = 'https://api.safaricom.co.ke/mpesa/accountbalance/v1/query';

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header


	$curl_post_data = array(
	//Fill in the request parameters with valid values
	'Initiator' => 'ERICK',
	'SecurityCredential' => 'YNg+pzFkjaZnoOD1xRmrRsa3SPp0aaGVC3ruGLy1BBNCXoW+sX5f36tOGsHKg3Q29Ah1rNFK7Bs6/bqkKgQh33nqENa9r2MU5DQ5i2uAuGPhhoxUrjPNLMqKJmTn9gQ1mhR9MimJgf91MS4SlJLUCIoBJruAwd+XUcyFB5ROb2SrxKQaXoG6mkDm1l+sYL0CkBOEEB6zZuWyD5DTkAzqkAJ99gMb5GSY/QlUyOuQS6/xvoOGQjv8MlLqL9hQU43aVviS7Njc0mMlON92+vrH6j5jV92NCrhFdf6ei0wmkOY5ZCVmxsycQgyFn7JMyTACuv98qdyr10kXK/sh9fGXVQ==',
	'CommandID' => 'AccountBalance',
	'PartyA' => '7290377',
	'IdentifierType' => '4',
	'Remarks' => 'Account Balance',
	'QueueTimeOutURL' => 'https://bimaplus.co.ke/insurance/calback_urls/balance_url.php',
	'ResultURL' => 'https://bimaplus.co.ke/insurance/calback_urls/balance_url.php'
	);

	$data_string = json_encode($curl_post_data);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	$curl_response = curl_exec($curl);
	print_r($curl_response);

	echo $curl_response;
?>
