<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        include "dashboard/db/connect_db.php";
    }
    include 'auth.php';
    $url = "http://41.84.131.13:8007/api/portal/policies/create";
    $logbook=$_SESSION["logbook"];
    $confirmed = $_SESSION["confirmed_items"];
    $client_details = $_SESSION["client_details"];
    print_r($_SESSION);
    $idnumber=$logbook['id_number'];$pinnumber=$logbook['kra_number'];$phoneno=$confirmed["phonenumber"];$firstname=$confirmed["firstname"];$middlename=$confirmed["lastname"];$lastname=$confirmed["lastname"];$gender=$client_details["inlineRadioOptions"];$postaladdress=$confirmed["postaladdress"];
    $physicaladdress=$logbook['physical_address'];$postalcode=$confirmed["postal_code"];$clienttype="I";$email=$confirmed["emailaddress"];$coverFrom=$logbook[''];$coverTo=$logbook[''];$paymentmode="M-P" ;$yourreference= ;
    // $productid= ;$agentid= ;$commissionrate= ;$riskid= ;$riskdesc= ;$covtdesc= ;$limit= ;$riskidentifier= ;
    // $wefdate= ;$commrate= ;$premium= ;$certno,= ;$windscreen= ;$entertainment= ;$excessprotector= ;$politicalviolence= ;
    // $aamembership= ;$courtesycar= ;$valueOfCar= ;$risknote= ;$vehiclemake= ;$vehiclecc= ;$vehicleyear= ;$capacity= ;
    // $bodytype= ;$chasisno= ;$engineno= ;$color= ;$logbookno= ;$riskId= ;$covertype= ;$suminsured= ;$tonnage= ;

    // $data=[
    //         'client' => [
    //             'idnumber' =>$idnumber,
    //             'pinnumber' => $pinnumber,
    //             'phoneno' => $phoneno,
    //             'firstname' => $firstname,
    //             'middlename' => $middlename,
    //             'lastname' => $lastname,
    //             'gender' =>$gender,
    //             'postaladdress' => $postaladdress,
    //             'physicaladdress' => $physicaladdress,
    //             'postalcode' => $postalcode,
    //             'clienttype' => $clienttype,
    //             'email' => $email
    //         ],
    //         'coverFrom' =>$coverFrom,
    //         'coverTo' =>$coverTo,
    //         'paymentmode' =>$paymentmode,
    //         'yourreference' =>$yourreference,
    //         'productid' =>$productid,
    //         'agentid' =>$agentid,
    //         'commissionrate' =>$commissionrate,
    //         'risks'=>[
    //             'riskid' => $riskid,
    //             'riskdesc' => $riskdesc,
    //             'covtdesc' => $covtdesc,
    //             'limit' => $limit,
    //             'riskidentifier' => $riskidentifier,
    //             'wefdate' => $wefdate,
    //             'commrate' => $commrate,
    //             'premium' => $premium,
    //             'certno' => $certno,
    //             'windscreen' => $windscreen,
    //             'entertainment' => $entertainment,
    //             'excessprotector' => $excessprotector,
    //             'politicalviolence' => $politicalviolence,
    //             'aamembership' => $aamembership,
    //             'courtesycar' => $courtesycar,
    //             'valueOfCar' => $valueOfCar,
    //             'risknote' => $risknote
    //         ],
    //         'vehicles'=>[
    //             'vehiclemake' =>$vehiclemake,
    //             'vehiclecc' =>$vehiclecc,
    //             'vehicleyear' =>$vehicleyear,
    //             'capacity' =>$capacity,
    //             'bodytype' =>$bodytype,
    //             'chasisno' =>$chasisno,
    //             'engineno' =>$engineno,
    //             'color' =>$color,
    //             'logbookno' =>$logbookno,
    //             'riskId' =>$riskId,
    //             'covertype' =>$covertype,
    //             'suminsured' =>$suminsured,
    //             'tonnage' =>$tonnage
    //         ],
    //         'insureds'=>(array) null
    //     ];




    
    // $data = json_encode($data);
    $data='{
        "client": {
          "idnumber": "33444233",
          "pinnumber": "A009334654H",
          "phoneno": "0723342234",
          "firstname": "JOHN",
          "middlename": "WANYAMA",
          "lastname": "OTIENO",
          "gender": "M",
          "postaladdress": "2018-00100",
          "physicaladdress": "KASARANI",
          "postalcode": "00100",
          "clienttype": "I",
          "email": "john@gmail.com"
        },
        "coverFrom": "22-dec-2021",
        "coverTo": "21-dec-2022",
        "paymentmode": "M-P",
        "yourreference": "008/009/91",
        "productid":"0700",
        "agentid": "070/00018",
        "commissionrate": 10,
        "risks": [
          {
            "riskid": "KEG 009R",
            "riskdesc": "TOYOTA",
            "covtdesc": "COMPREHENSIVE",
            "limit": 2000000,
            "riskidentifier": 0,
            "wefdate": "22-dec-2021",
            "commrate": 10,
            "premium": 40000,
            "certno": "",
            "windscreen": 30000,
            "entertainment": 50000,
            "excessprotector": 0,
            "politicalviolence": 0,
            "aamembership": 0,
            "courtesycar": 0,
            "valueOfCar": 1000000,
            "risknote":""
          }
        ],
        "vehicles": [
          {
            "vehiclemake": "TOYOTA",
            "vehiclecc": "1300",
            "vehicleyear": "2010",
            "capacity": "5",
            "bodytype": "SALOON",
            "chasisno": "AF00988900J",
            "engineno": "EN0098887098",
            "color": "BLUE",
            "logbookno": "LOG009887",
            "riskId": 0,
            "covertype": "COMPREHENSIVE",
            "suminsured": 0,
            "tonnage": "5"
          }
        ],
        "insureds": [
       
        ]
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
    $resp= json_decode($resp);
    print_r($resp);
    // $token=$resp->token;
    // $arr = (array) $resp;
    // $message = (array) $arr["object"];
    // $status=false;
    // if (array_keys($message)[0] == "error"){
    //     $out = array_values($message)[0];
    //     $status=false;
    //     echo $out;
    // }else{
    //     $out = array_values($message)[0];
    //     $status=true;
    //     $batchno=$message["batchno"];
    //     $premium=$message["premium"];
    //     $policyno=$message["policyno"];
    //     echo "batchno: ". $batchno . "<br>";
    //     echo "premium: ". $premium . "<br>";
    //     echo "policyno: ". $policyno . "<br>";
    // }
    // $message=$resp->messages;
    // $object=$resp->object;
    // print_r(array_key_first($object));
    // print_r($object);

    // $error=$resp->object;
    // print_r($error);
    // echo $token;
    curl_close($curl);
    // var_dump($resp);

?>

