<?php
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/token.php';
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/cred.php';
    $curl = curl_init();

    curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.dmvic.com/api/VC3/Integration/GetCertificate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSLCERTTYPE => "PEM",
            CURLOPT_SSLCERT => $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/file.pem',
            CURLOPT_POSTFIELDS => json_encode(array("CertificateNumber" => $CertNo)),
            CURLOPT_HTTPHEADER => array(
                'ClientId: '.$ClientID,
                'Authorization: Bearer '.$token,
                'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    $pdfurl = json_decode($response, true);
    $object = (object) $pdfurl;
    // print_r($object);
    if($object->success == 1){
        $message = $object->callbackObj["URL"];
    }else{
        $message = $object->Error[0]["errorText"];
    }
    $hyperlinked_text = $message;
    
    curl_close($curl);
    // $inventory = $object->callbackObj["MemberCompanyStock" D4681574 ];
    // print_r($inventory);
    // curl_close($curl);
    // echo $response;
