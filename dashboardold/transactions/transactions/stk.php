<?php
	include 'auth.php';
	include '/home/ubuntu/credentials.php';
	$url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    	$curl = curl_init();	
	curl_setopt($curl, CURLOPT_URL, $url);
    	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer $tocken")); //setting custom header
    
    	$curl_post_data = array(
        	//Fill in the request parameters with valid values
        	'BusinessShortCode' => $shortcode,
	        'Password' => $pass,
        	'Timestamp' => $tyme,
	        'TransactionType' => 'CustomerPayBillOnline',
        	'Amount' => '1',
	        'PartyA' => $number,
        	'PartyB' => $shortcode,
	        'PhoneNumber' => $number,
        	'CallBackURL' => $callbackurl,
	        'AccountReference' => 'pay',
        	'TransactionDesc' => 'stk'
	);
    	$data_string = json_encode($curl_post_data);
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    	$curl_response = curl_exec($curl);
	print_r($curl_response);
    
	echo $curl_response;
  ?>
