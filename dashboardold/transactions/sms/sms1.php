<?php
// Your code here!
    $Fname = "Erick";
    $vehicle = "KBB 9627B";
    $email = "ericksoi3709@gmail.com";
    $underwriter = "APA Insurance";
    $curl = curl_init();
    $main_url = "http://api.mspace.co.ke/mspaceservice/wr/sms/";
    $my_message = "Dear $Fname, Your Motor insurance cover request for $vehicle has been processed and certificate sent to the email provided. Thank you for choosing BimaPlus.";
    $data2 = array(
    'username' => 'IPLUS',
    'password' => 'Bulksms2611',
    'senderid' => 'IPLUS',
    'recipient' => '254733566464',//should be a valid contact number
    'message' => myUrlEncode($my_message)
    );
    // $subuserUrl = "subusers/" . str_replace("&","/",http_build_query($data)); //use this to get subusers
    // $balanceUrl = "balance/" . str_replace("&","/",http_build_query($data)); //use this to get balance
    // $sendtextUrl = "sendtext/" . str_replace("%2B","%20",(str_replace("&","/",http_build_query($data2))));
    $sendtextUrl = "sendtext/" . str_replace("%2B","%20",(str_replace("&","/", http_build_query($data2))));
    echo($sendtextUrl);
    //use this to send text and get response
    curl_setopt_array($curl, array(
    CURLOPT_URL => $main_url . $sendtextUrl, //returns full http url for sub-account method. Replace
    // $subuserUrl with $balanceUrl or $sendtextUrl variable to complete main url with subuser or
    //balance url parts respectively.
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    "accept: application/json" //can change to application/xml for sub-account and sendtext
    //methods or plain_text for balance method as per this documentation
    ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
    echo $response."\n";
    }

    function myUrlEncode($string) {
        $entities = array('%21', '%2A', '%E2%80%99s', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D','%0A', '%27');
        $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]","", "'");
        return str_replace($entities, $replacements, urlencode($string));
    }
?>