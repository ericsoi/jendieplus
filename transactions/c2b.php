<?php
    $url = 'https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer VL3n9hJ4DXUHwrDCyzWFF36uyRyd')); //setting custom header


    $curl_post_data = array(
    //Fill in the request parameters with valid values
    'ShortCode' => '7290377',
    'ResponseType' => 'Confirmed',
    'ConfirmationURL' => 'https:/jendieplus.co.ke/transactions/confirmation_url.php',
    'ValidationURL' => 'https://jendieplus.co.ke/transactions/validation_url.php'
    );

    $data_string = json_encode($curl_post_data);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $curl_response = curl_exec($curl);
    print_r($curl_response);

    echo $curl_response;
?>
