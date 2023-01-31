<?php
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/token.php';
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/cred.php';
    $curl = curl_init();
    curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.dmvic.com/api/VC3/IntermediaryIntegration/MemberCompanyStock',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSLCERTTYPE => "PEM",
            CURLOPT_SSLCERT => $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/file.pem',
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "MemberCompanyId":'. $Membercompanyid .'
            }',
            CURLOPT_HTTPHEADER => array(
                    'ClientId: '.$ClientID,
                    'Authorization: Bearer '.$token,
                    'Content-Type: application/json'
            ),
    ));

    $response = curl_exec($curl);
    $inventory = json_decode($response, true);
    $object = (object) $inventory;
    curl_close($curl);