<?php
        $headers = array(  
        'Content-Type: application/json',
        'Accept: application/json',
    );
  
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://167.172.14.50:4002/v1/send-sms');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_USERPWD, 'siWdwFxyrbbJ1ra:nyTWT3WQQL4FtdiIYXWubF8RDMBBI7');
    $curl_post_data = array([
        //Fill in the request parameters with valid values
    'sender' => 'Jendieplus',
    'message' => 'PHP sms done. Test11',
    'phone' => '0712962787',
    'correlator' => 1
        ]
    );
    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);
    echo $curl_response;

?>