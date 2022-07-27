<?php
	include "auth.php";
	include "credentials.php";
	$url = 'https://api.safaricom.co.ke/mpesa/accountbalance/v1/query';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer $tocken"));  //setting custom header

	$curl_post_data = array(
	//Fill in the request parameters with valid values
	'Initiator' => 'ERICKSOI',
	'SecurityCredential' => "C1jE1hvoLJXgSTO6Zyge3J5Cnu1nfy+HvVjCPXB1Eyj0SRIr6QR5jG91pP05Qc2poByoovXmX7HfDKwk/4JYXeXzRCH1zSCWJraPqrOypNbVBQ+QQgLCaWqWq+7d0HX+WVch+/ldbkCspVK5/8Vr0kI+LR7dwupt+9NC8DX3+zzfycZH2eNpEE8pp4QBZtvA3Vrv9/fG95ATcU4Uk1xx23Y+9WazPOmocYDtq2SLJ4pHUS9uq9KUVqqjLVnvk3wY2FKuvl6AtPwQm5rYsWGAYPBSnM1JNzsZ0hrPY9LuGAbtOzH5XmoUosbJOQDXY+XfT5TPbXacM0Oq8zu0k6sM8Q==",
	'CommandID' => 'AccountBalance',
	'PartyA' => '7407829',
	'IdentifierType'=> '4',
	'QueueTimeOutURL' => 'https://jendieplus.co.ke/transactions/confirmation_url.php',
	'ResultURL' => 'https://jendieplus.co.ke/transactions/confirmation_url.php',
	'Remarks' => 'jendieplus'
	);

	$data_string = json_encode($curl_post_data);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	$curl_response = curl_exec($curl);
	print_r($curl_response);
