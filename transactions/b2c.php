<?php
  include 'b2c_auth.php';						
  include 'credentials.php';//'b2credentials.php';
  //$tocken = '"'.$tocken .'"';     
  //echo $tocken;
  $url = 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
  
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer $tocken")); //setting custom headeri
  
  
  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'InitiatorName' => 'ERICKSOI',
    'SecurityCredential' => $credential,//"MJMH+5TvFZ3FqJn6G/R5HRqiLSFUas7vpvLcQ3JNYDwGriPizb34NoVVbodKmxyjZpv6MJyHSFkPBn1qTdx0Hn5Bf6P7BhWNStO9FONbxgSk+UusQKrZgVVvu1cyLdw6rbRXbkGoDiBS0yCnWopH7Vg0IRk/SfEdWqQS/q9ayg/k319L8S1Y/Co/BxZ8HbhUcT+4wI7hLNzK24xD/FRX/5wfq85lMPvU6V0dQ90oAtchHr+UCBc1Snzvy2xlNwSJ92diIQTXxyFwsNjgMpqaX0/+gZ2lckPpd7Nf/T/MyT46R1ziaaO3XTOk5fIvy/2gIUW49iXHM//XEGLJ1TZ/Bg==",
    'CommandID' => 'BusinessPayment',//'BusinessPayment',
    'Amount' => '10',
    'PartyA' => '7407829',
    'PartyB' =>  '254743996757',
    'Remarks' => 'Test',
    'QueueTimeOutURL' => "https://jendieplus.co.ke/timeout.php",
    'ResultURL' => "https://jendieplus.co.ke/result.php",
    'Occasion' => ' '
  );
  
  $data_string = json_encode($curl_post_data);
  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  
  $curl_response = curl_exec($curl);
  echo $curl_response;
  ?>

