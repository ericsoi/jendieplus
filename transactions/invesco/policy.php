<?php
    include './auth.php';
    $url = "http://41.84.131.13:8007/api/portal/policies/create";
    $pin ='A009334654g';
    $idnumber="22348724";

    $idnumber="22348724";
    $pinnumber="A009334654g";
    $phoneno="0720357230";
    $firstname="PETER";
    $middlename="MUGENYA";
    $lastname="OLINGO";
    $gender="M";
    $postaladdress="00100";
    $physicaladdress="KASARANI";
    $postalcode="00100";
    $clienttype="I";
    $email="pmugenya@gmail.com";
    $productid="0804";
    $coverFrom="27-jul-2022";
    $coverTo="26-aug-2022";
    $paymentmode="Cash";
    $yourreference="008/009/90";
    $agentid="070/00019";
    $commissionrate=10;
    $noOfInstallments=1;
    $riskid="KAE009Y";
    $riskdesc="TOYOTA";
    $covtdesc="COMPREHENSIVE";
    $limit=1000000;
    $riskidentifier=0;
    $wefdate="27-jul-2022";
    $wetdate="26-aug-2022";
    $certwef="27-jul-2022";
    $certwet="26-aug-2022";
    $commrate=10;
    $premium=40000;
    $certno="";
    $windscreen=30000;
    $entertainment=50000;
    $excessprotector=0;
    $politicalviolence=0;
    $aamembership=0;
    $courtesycar=0;
    $valueOfCar=1000000;
    $risknote="";
    $vehiclemake="TOYOTA";
    $vehiclecc=1300;
    $vehicleyear=2010;
    $capacity=15;
    $bodytype="SALOON";
    $chasisno="AF00988900A";
    $engineno="EN0098887";
    $color="RED";
    $logbookno="LOG009887";
    $riskId=0;
    $covertype="COMPREHENSIVE";
    $suminsured="0";
    $tonnage="5";

    $data=[
        "client"=>[
            "idnumber"=>$idnumber,
            "pinnumber"=>$pinnumber,
            "phoneno"=>$phoneno,
            "firstname"=>$firstname,
            "middlename"=>$middlename,
            "lastname"=>$lastname,
            "gender"=>$gender,
            "postaladdress"=>$postaladdress,
            "physicaladdress"=>$physicaladdress,
            "postalcode"=>$postalcode,
            "clienttype"=>$clienttype,
            "email"=>$email
        ],
        "productid"=>$productid,
        "coverFrom"=>$coverFrom,
        "coverTo"=>$coverTo,
        "paymentmode"=>$paymentmode,
        "yourreference"=>$yourreference,
        "agentid"=>$agentid,
        "commissionrate"=>$commissionrate,
        "noOfInstallments"=>$noOfInstallments,
        "risks"=>[
            [
            "riskid"=>$riskid,
            "riskdesc"=>$riskdesc,
            "covtdesc"=>$covtdesc,
            "limit"=>$limit,
            "riskidentifier"=>$riskidentifier,
            "wefdate"=>$wefdate,
            "wetdate"=>$wetdate,
            "certwef"=>$certwef,
            "certwet"=>$certwet,
            "commrate"=>$commrate,
            "premium"=>$premium,
            "certno"=>$certno,
            "windscreen"=>$windscreen,
            "entertainment"=>$entertainment,
            "excessprotector"=>$excessprotector,
            "politicalviolence"=>$politicalviolence,
            "aamembership"=>$aamembership,
            "courtesycar"=>$courtesycar,
            "valueOfCar"=>$valueOfCar,
            "risknote"=>$risknote
            ]
        ],
        "vehicles"=>[
            [
            "vehiclemake"=>$vehiclemake,
            "vehiclecc"=>$vehiclecc,
            "vehicleyear"=>$vehicleyear,
            "capacity"=>$capacity,
            "bodytype"=>$bodytype,
            "chasisno"=>$chasisno,
            "engineno"=>$engineno,
            "color"=>$color,
            "logbookno"=>$logbookno,
            "riskId"=>$riskId,
            "covertype"=>$covertype,
            "suminsured"=>$suminsured,
            "tonnage"=>$tonnage
            ]
        ],
        "insureds"=>(array) null
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

