<?php
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		// if(!isset($_SESSION["underwriter"])) { 
		// 	header("refresh:0;url=../index.php");
		// }
		//file_put_contents('filename.txt', print_r($_SESSION, true));
		include "auth.php";
		include "/home/ubuntu/credentials.php";
		include "../config/db.php";
		//file_put_contents('file',$myarray);
		$underwriter_name = $_SESSION["underwriter"];
		$vehicle_registration = $_SESSION["logbook"]["registration"];;
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
			//Fill in the request parameters with valid values
			'Initiator' => 'ERICKSOI',
			'SecurityCredential' => 'YzlCYBhihRzcbMtDLgbtQuFIDO/3pTsrx6AA54KQz5kUpr767Lnnhp6tkpmCR0R5WbkGM9UW7VjBaLb4SUhkZuuIIxuWK0XChM51ZnBSZ3lo5SRMUL7MbCDYY1E4yAUSiLyCrwqK1Uau6UCXxi18P1ji1MDcy0Eyn1UJ0s76tOuhT58cYklvGJGcWlf/R9aNHU4lwBD6dBOwD1n1jzCrMrfVQIaNH7vVLt39A+8Mvs6hafJj/R4dkmQSRiE7g0xCX9snwexjrsaAxyJFhmBikPGkeco7PEZGv15wmxmaV9MmhI5rb0yPECrmnS/SIShZnfESamjxGL0ruL/1t9C3jg==',
			'CommandID' => 'DisburseFundsToBusiness',
			'SenderIdentifierType' => '4',
			'RecieverIdentifierType' => '4',
			'Amount' => $amt,
			'PartyA' => '7290377',
			'PartyB' => $underwriter_paybill,
			'AccountReference' => 'BILL PAYMENT',
			'Remarks' => $vehicle_registration,
			'QueueTimeOutURL' => 'https://jendieplus.co.ke/transactions/b2b_confirmation_url.php',
			'ResultURL' => 'https://jendieplus.co.ke/transactions/b2b_confirmation_url.php'
		);

		$data_string = json_encode($curl_post_data);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

		$curl_response = curl_exec($curl);
	
?>
