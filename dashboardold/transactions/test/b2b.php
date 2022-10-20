<?php
	  include '/home/ubuntu/credentials.php';
	  include 'auth.php';
	  $url = 'https://api.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
	 echo $access_token; 
	 $curl = curl_init();
	  curl_setopt($curl, CURLOPT_URL, $url);
	  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
	  
	  
	  $curl_post_data = array(
	    //Fill in the request parameters with valid values
	    'Initiator' => 'ERICK',
	    'SecurityCredential' => 'hS4aGQ4CYFH8HfUfZkzeGWmzFLFXkrI4Moto7lR05K3lKjgIPGFjvs4AvCz/sP6E12DNqYTvYuqrd5EaBKNzVF2uo5Tio7uwFasHMS2fXzLuQVrKyz+hRbogMEcD4QFRij6g/dR2RkXmKRzU5tPZAzDWtzNZBwG8f4LzcJY8j19BQCTDrqckFDtuFBZuBjr8DDgAseTdXaDSX6si9iJ2pjYmcqpizlGxus40H3ezMOZZnFYKAUIPcm+2njOXO7kZYdoaYeY3eCEV3CIG23Nxf3AOfzudabI/cbq21WuNnHqP2eV0zluhl/fj5zPMpUUFl36+iyWeo0ZEDYFPmYY26Q==',
	    'CommandID' => 'BusinessToBusinessTransfer',
	    'SenderIdentifierType' => '4',
	    'RecieverIdentifierType' => '4',
	    'Amount' => '1',
	    'PartyA' => '7290377',
	    'PartyB' => '503200',
	    'AccountReference' => 'BILL PAYMENT',
	    'Remarks' => 'Pay Bill',
	    'QueueTimeOutURL' => 'https://bimaplus.co.ke/transactions/confirmation_url.php',
	    'ResultURL' => 'https://bimaplus.co.ke/transactions/confirmation_url.php'
	  );
	  
	  $data_string = json_encode($curl_post_data);
	  
	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($curl, CURLOPT_POST, true);
	  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	  
	  $curl_response = curl_exec($curl);
	  print_r($curl_response);
	  
	  echo $curl_response;
?>
