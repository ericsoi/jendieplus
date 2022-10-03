<?php
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		// if(!isset($_SESSION["underwriter"])) { 
		// 	header("refresh:0;url=../index.php");
		// }
		//file_put_contents('filename.txt', print_r($_SESSION, true));
		$shortcode 	= '7290377';
		$time 		= date("YmdHis");
		$passkey 	= '9b6b37ab48221b4ac73fe723635ad430093fb4456ce2ddb62d729632caae1169';
		$SecurityCredential	= base64_encode($shortcode.$passkey.$time);
		// include "passencription/mpesa-encryption-encoding-php/index.php";
		include "auth.php";
		include "credentials.php";
		include "../config/db.php";
		//file_put_contents('file',$myarray);
		$underwriter_name = "Directline Assurance Company Limited";//$_SESSION["underwriter"];
		$vehicle_registration = "KAA 1234";//;$_SESSION["logbook"]["registration"];
		$amt = 1;//$_SESSION["gross_premium"];
		//$tocken = 'HSkAGABLK5AATx5uWRRfkjAGbrIW';	
		$url = 'https://api.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$tocken)); //setting custom header
		$sql = "SELECT paybill from underwriters where Name like'%$underwriter_name%'";
		$res = mysqli_query($connection, $sql);
		$row =  mysqli_fetch_assoc($res);
		$underwriter_paybill = $row['paybill'];
		$curl_post_data = array(
			'Initiator' => 'ERICKSOI',
			'SecurityCredential' => $credential,
			'CommandID' => 'DisburseFundsToBusiness',
			'SenderIdentifierType' => '4',
			'RecieverIdentifierType' => '4',
			'Amount' => $amt,
			'PartyA' => '7290377',
			'PartyB' => $underwriter_paybill,
			'AccountReference' => 'BILL PAYMENT',
			'Remarks' => $vehicle_registration,
			'QueueTimeOutURL' => $b2b_confirmation_url,
			'ResultURL' => $b2b_confirmation_url
		);


		
		$data_string = json_encode($curl_post_data);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

		$curl_response = curl_exec($curl);
        echo $curl_response;
	
?>
