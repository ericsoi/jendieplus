<?php
    include './auth.php';
    $url = "http://41.84.131.13:8007/api/portal/policies/issuecertificate";
    

    // $data=[
    //     "batchNo"=>$batchNo,
    //     "agnCode"=>$agnCode,
    //     "regNumber"=>$regNumber
    // ];

    // $data = json_encode($data);

    $data ='{
        "batchNo": 123456,
        "agnCode": 4533,
        "regNumber": "KAA123A"
      }';
        
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Content-Type: application/json",
    );
    // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer $token"));
    // $data = '{"username": "APIUSER", "password": "test"}';
    curl_setopt($curl, CURLOPT_POSTFIELDS, "$data");
    // for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $resp = curl_exec($curl);
    echo $resp;
    // $resp= json_decode($resp);
    // $token=$resp->token;
    // $arr = (array) $resp;
    curl_close($curl);
?>

