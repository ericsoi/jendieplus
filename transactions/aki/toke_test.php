<?php

$curl = curl_init();

curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://uat-api.dmvic.com/api/V12/Account/Login',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
    "Username":"iplusagency@dmvic.info",
    "Password":"Iplus2@20!"
}',
		CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
		),
));

$response = curl_exec($curl);

curl_close($curl);
$jresult = json_decode($response,true);
print_r($jresult);
// $token = $jresult['token'];
// echo $token;