<?php
    //The url you wish to send the POST request to
    $url = "https://uat-dmvic.azure-api.net/api/V12/Account/Login";
    // $url = "https://api.dmvic.com/api/V1/Account/Login";        
    //The data you want to send via POST
    $fields = [
        'Username' => "iplusagency@dmvic.info",
        'Password' => "Iplus2@20!"
    ];
    // $fields=[
    //     'Username' => "iplusagencyapiuser@dmvic.com",
    //     'Password' => "!P202!@GY"
    // ];
    //url-ify the data for the POST
    $fields_string = http_build_query($fields);
    
    //open connection
    $ch = curl_init();
    
    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_PORT , 443);
    curl_setopt($ch,CURLOPT_URL, $url);
    // curl_setopt($ch,CURLOPT_POST, 0);
    // curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

    //execute post
    $result = curl_exec($ch);
    // echo $result;
    $jresult = json_decode($result,true);
    $token = $jresult['token'];
    // echo $token;
    // echo "ddd";
?>
