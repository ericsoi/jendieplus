<?php
  include 'auth.php';						
  include 'credentials.php';
  //$tocken = '"'.$tocken .'"';     
  echo $tocken;
  $url = 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
  
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer $tocken")); //setting custom headeri
  
  
  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'InitiatorName' => $initiator,
    'SecurityCredential' => $credential,
    'CommandID' => 'BusinessPayment',
    'Amount' => '10',
    'PartyA' => $shortcode,
    'PartyB' => '0712962787',
    'Remarks' => 'Test',
    'QueueTimeOutURL' => '/opt/lampp/htdocs/insurance/transactions/confirmation_url.php',
    'ResultURL' => '/opt/lampp/htdocs/insurance/transactions/confirmation_url.php',
    'Occasion' => ' '
  );
  
  $data_string = json_encode($curl_post_data);
  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  
  $curl_response = curl_exec($curl);
  print_r($curl_response);
  
  echo $curl_response;
  ?>

