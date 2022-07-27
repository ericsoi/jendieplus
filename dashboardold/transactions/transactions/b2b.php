<?php
	include "auth.php";
	include "/home/ubuntu/credentials.php";
	//$tocken = 'HSkAGABLK5AATx5uWRRfkjAGbrIW';	
	$url = 'https://api.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$tocken)); //setting custom header


	$curl_post_data = array(
		//Fill in the request parameters with valid values
		'Initiator' => 'KENTO',
		'SecurityCredential' => 'et+Qgw4X5RCkK6wZ8Ys0pI455MzeRaxBUfkxPC7uulUZMkxT3gbUJH0t8Qr/8RNacbcYwVbC/mER724jYXowdgIKSo+7gSeN8LDduGDcPCdR2iJGBUgATVly8WehVNoiY+Bw16gO1cPhvRwYa9hNhDgXP2bSW1MypJ7U5IvZCiGppEtgBEOwBr7eoOkdWZoPpZEbALQxezj+H133Dn8nmS2+t/uF8db/vPVnTVdUcPIt5IXsHvLcVCfmeESYPr5QBANA3crIyfz63rYeihFeLY0vCyr6NI7vfJeds7yaqruq9XWusxHMT4Y/42VpQ4GCc7nwxMeHMYcrQi4RkJhDGA==',//$credential,
		'CommandID' => 'BusinessToBusinessTransfer',
		'SenderIdentifierType' => '4',
		'RecieverIdentifierType' => '4',
		'Amount' => '1',
		'PartyA' => $shortcode,
		'PartyB' => '511600',
		'AccountReference' => 'BILL PAYMENT',
		'Remarks' => 'Pay to paybill',
		'QueueTimeOutURL' => 'https://bimaplus.co.ke/transactions/confirmation_url.php',
		'ResultURL' => 'https://bimaplus.co.ke/transactions/confirmation_url.php'
	);

	$data_string = json_encode($curl_post_data);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	$curl_response = curl_exec($curl);
	print_r($curl_response);
?>
