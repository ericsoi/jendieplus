<?php
    include './auth.php';
    $url = "http://41.84.131.13:8007/api/portal/policies/policyenquiry?searchVal=0700&agentCode=0&offset=1&limit=20";
    

    $data=[
        "batchNo"=>$batchNo,
        "agnCode"=>$agnCode,
        "regNumber"=>$regNumber
    ];

    $data = json_encode($data);
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
    // echo $resp;
    $resp= json_decode($resp);
    // $token=$resp->token;
    $arr = (array) $resp;
    $message = (array) $arr["object"];
    $status=false;
    if (array_keys($message)[0] == "error"){
        $out = array_values($message)[0];
        $status=false;
        echo $out;
    }else{
        $out = array_values($message)[0];
        $status=true;
        $batchno=$message["batchno"];
        $premium=$message["premium"];
        $policyno=$message["policyno"];
        echo "batchno: ". $batchno . "<br>";
        echo "premium: ". $premium . "<br>";
        echo "policyno: ". $policyno . "<br>";
    }
    // {
    //     "messages": [],
    //     "object": {
    //         "certNo": "A2104338",
    //         "error": ""
    //     }
    // }
    curl_close($curl);
    // var_dump($resp);

?>

