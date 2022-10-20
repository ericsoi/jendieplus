<?php
    include './auth.php';
    $url = "http://41.84.131.13:8007/api/portal/policies/extend";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
    "Content-Type: application/json",
    );

    $batchNo = 225599976;
    $renewalDate = "30-jul-2023";
    $premium = 5000;
    $autoAuth = "N";
    $policyNo = "020/0804/1/092138/2021/05";
    $agentId = "025/016194";//20215593452
    $data =[
        "batchNo"=>$batchNo,
        "wef"=>$renewalDate,
        "premium"=>$premium,
        "autoAuth"=>$autoAuth,
        "policyNo"=>$policyNo,
        "agentId"=>$agentId
    ];

    $fields_string = json_encode($data);
    $data='{
        "batchNo": 225599976,
        "wef": "22-jan-2022",
        "premium": 5000,
        "autoAuth": "N",
        "policyNo": "020/0804/1/092138/2021/05",
        "agentId": "040/004213"
      }';
    $fields_string = $data;
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"Authorization:Bearer $token"));
    curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $resp = curl_exec($curl);
    $resp= json_decode($resp);
    print_r($resp);
    // $message=$resp->messages;
    // $obj=$resp->object;
    // $error = false;
    // print_r($obj);
    // if(count((array)$obj) == 1){
    //     $error = $obj->error;
    // }else{
    //     print_r($obj);
    //     $batcno=$obj->batchno;
    //     $premium=$obj->premium;
    //     $wet=$obj->wet;
    // }
    // echo $error;
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
