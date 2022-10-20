<?php
    include './auth.php';
    $url = "http://41.84.131.13:8007/api/portal/policies/renew";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
    "Content-Type: application/json",
    );

    $batchNo = 20215593452;
    $renewalDate = "30-jul-2023";
    $premium = 5000;
    $autoAuth = "N";
    $policyNo = "080/0700/1/169467/2021/10";
    $agentId = "025/016194";
    $data =[
        "batchNo"=>$batchNo,
        "renewalDate"=>$renewalDate,
        "premium"=>$premium,
        "autoAuth"=>$autoAuth,
        "policyNo"=>$policyNo,
        "agentId"=>$agentId,
    ];

    $fields_string = json_encode($data);

    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer $token"));
    curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $resp = curl_exec($curl);
    $resp= json_decode($resp);
    // print_r($resp);
    $message=$resp->messages;
    $obj=$resp->object;
    $error = false;
    if(count((array)$obj) == 1){
        $error = $obj->error;
    }else{
        print_r($obj);
        $batcno=$obj->batchno;
        $premium=$obj->premium;
        $wet=$obj->wet;
    }
    echo $error;
    // print_r($obj);
    // $i=0;
    // while ($i < count($obj))
    // {
    //     $sacco=$obj[$i];
    //     print_r($obj[$i]);
    //     // print_r($obj[$i]);
    //     echo "<br />";
    //     $i++;
    // }

?>
