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
	'SecurityCredential' => "ClHUNaydxPRAEub50Q0v761JgK9d4isSHmX7THlTzfxnrJt0nliw684gmITImdASBCZrPl1NYn2LRIkjgygzJnYCtsyqXqe8q6zXr+H66l9X66DGpaaEhlBWDIFGI+40Odo8A2Vpd4Jy2vL5Zs2r8bGWqz7kzZ0COK1m2unLqQ9p/JYDDOw6USzIJJLw5nNlNTLzEzzvQD77pyYc38d08z5442v5KrhwNPxXfTkakXFwj972XCaDQY+5N/aEG/+5yMlTtw2wXEesuXZYkChKnHvjOY6G9EpNk/67ojDtnYR2H2N424Mqy030AZs0o1WvrUzqXgXC8bFcIk+Z/QGv3w==",
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
