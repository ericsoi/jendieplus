<?php
	$url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	//$credentials = base64_encode('fwuKVdHGbRvJLiNmrM3Mhs8dtobr8jmW:E0Bql4QVvSauA25k');
	$credentials = base64_encode('MzSE1AyGqrX9yVIQdcc4MdrI8AolAL9t:ukpLY9Hp55JZjKy3');
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
	curl_setopt($curl, CURLOPT_HEADER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$curl_response = curl_exec($curl);
	//echo  $curl_response;
	$starting = strpos($curl_response, "access_token") + 16;
	$tocken=substr($curl_response ,$starting, 28);
	//echo $tocken;
?>
