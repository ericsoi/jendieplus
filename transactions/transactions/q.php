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
	'SecurityCredential' => "iyEQg+V6KoqJ6/I8znWkG8lB0k3QduMu1yzI2RLBiT74ZuxEQtG4othOxQ8mWgeQ2SgK+axEDiry4yx8UVXtguP7WGfbsWUBRcw8YO9LczNO+fsRHFImYkQie9FGrpZYZ67b872C6r1l8EGBsEPt0xkHAqozBwBY3WofrLycxMEcIJKToYvgPD9MlVIGiUV6SHViE5AwjcWEs3Orf5B1Hn7hgz6pZ8wk9pWuW3V6Lba85BeeG47H26BiGj3/wSILqgV2UrX8sRJ+ljvQaB/5lzJeS7ZhAI3QbhKTHkzE/0zRpTyCNMyXFmdB9JSGWvI2U3y3I587U0mEp8YwEU1h4w==",
	'CommandID' => 'AccountBalance',
	'PartyA' => '7290377',
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
