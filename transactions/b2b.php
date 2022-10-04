<?php
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		// if(!isset($_SESSION["underwriter"])) { 
		// 	header("refresh:0;url=../index.php");
		// }
		//file_put_contents('filename.txt', print_r($_SESSION, true));
		include $_SERVER['DOCUMENT_ROOT']."/transactions/auth.php";
		include $_SERVER['DOCUMENT_ROOT']."/transactions/credentials.php";
		include $_SERVER['DOCUMENT_ROOT']."/config/db.php";
		include $_SERVER['DOCUMENT_ROOT']."/dashboard/db/connect_db.php";
		//file_put_contents('file',$myarray);
		$underwriter_name = $_SESSION["underwriter"]["Name"];
		$vehicle_registration = $_SESSION["logbook"]["registration"];
		$amt = $_SESSION["grosspremium"];
		// $amt = 1;
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
			//Fill in the request parameters with valid values QJ418L80U9 QJ488L9GBI
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
	
?>
