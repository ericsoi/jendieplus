<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        include $_SERVER['DOCUMENT_ROOT']."/dashboard/db/connect_db.php";
    }
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/invesco/auth.php';
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/invesco/covertypes.php';
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/invesco/productlisting.php'; 
    // echo $TPO->proddesc;
    // echo $TPF->proddesc;
    // echo $COMP->proddesc;
    // echo $STD->proddesc;

    $url = "http://41.84.131.13:8007/api/portal/policies/create";
   $apiresponce=false;
try{

$logbook = $_SESSION['logbook'];
$client_details=$_SESSION['client_details'];
// print_r($_SESSION);
$confirmed_items = $_SESSION['confirmed_items'];
$clienttype="I";
$productid = "0700";
$commissionrate = 10;
$agentid='00018';
$limit=0;$riskidentifier=0;
$period= $client_details["coverperiod"];
$interval = "1 years";
$vehicleclass = explode('. ', $client_details['vehicleclass'])[0];
switch ($vehicleclass) {
  case "1":
    $productid = $product_listing[15]->prodshtdesc;
    break;
  case "2":
    $productid = $product_listing[15]->prodshtdesc;
  break;
  case "3":
    $productid = $product_listing[15]->prodshtdesc;
    break;
  case "4":
    $productid = $product_listing[15]->prodshtdesc;
  break;
  case "5":
    $productid = $product_listing[15]->prodshtdesc;
    break;
  case "6":
    $productid = $product_listing[15]->prodshtdesc;
    break;
  case "7":
    $productid = $product_listing[15]->prodshtdesc;
    break;
  case "8":
    $productid = $product_listing[15]->prodshtdesc;
    break;
  case "9":
    $productid = $product_listing[15]->prodshtdesc;
      break;
  case "10":
    $productid = $product_listing[15]->prodshtdesc;
    break;
  case "11":
    $productid = $product_listing[15]->prodshtdesc;
    break;
  case "12":
    $productid = $product_listing[15]->prodshtdesc;
    break;
  case "13":
    $productid = $product_listing[15]->prodshtdesc;
    break;
  case "14":
    $productid = $product_listing[15]->prodshtdesc;
    break;
  case "15":
    $productid = $product_listing[15]->prodshtdesc;
    break;    
  case "16":
    $productid = $product_listing[15]->prodshtdesc;
    break; 
  case "17":
    $productid = $product_listing[15]->prodshtdesc;
    break; 
  case "18":
    $productid = $product_listing[15]->prodshtdesc;
    break; 
  case "19":
    $productid = $product_listing[15]->prodshtdesc;
    break; 
  case "20":
    $productid = $product_listing[15]->prodshtdesc;
    break; 
  case "21":
    $productid = $product_listing[15]->prodshtdesc;
    break;   
}
switch ($period) {
  case "1 year":
    $interval = "1 years";
    break;
  case "1 month":
    $interval = "1 months";
    break;
  case "1 week":
    $interval = "1 weeks";
    break;
  case "2 weeks":
    $interval = "2 weeks";
    break;
  default:
    $interval = "1 years";
}
$paymentmode="M-P";
switch ($confirmed_items['payments']){
  case "mpesa":
    $paymentmode="M-P";
    break;
  default:
    $paymentmode="M-P";
}
$covertype=strtoupper($_SESSION['cover']);

$mydate= date_create($confirmed_items['coverstartdate']);
$fromdate=date_format($mydate,"d-M-Y");
date_add($mydate,date_interval_create_from_date_string($interval));
$todate=date_format($mydate,"d-M-Y");
// print_r($_SESSION['cover']);
// echo "\n\n\n";
// print_r($STD);
// print_r($_SESSION['cover']);
// $covertype= $STD->proddesc; // 'THIRD PARTY ONLY' / COMPREHENSIVE;
$covertype=strtoupper($_SESSION['cover']);
if ($covertype  == "COMPREHENSIVE"){
	$suminsured = $_SESSION['client_details']['sum_insured'];
	$limit = $suminsured;
} else{
	$suminsured=0;
	$limit=0;
}
$idnumber=$logbook['id_number']; $pinnumber=$logbook['kra_number']; $phoneno=$client_details['phone_number']; $firstname=$confirmed_items['firstname']; 
$middlename=$confirmed_items['firstname']; $lastname=$confirmed_items['lastname']; $gender=$client_details['gender']; $postaladdress=$confirmed_items['postaladdress']; 
$physicaladdress=$logbook['physical_address']; $postalcode=$confirmed_items['postal_code']; $clienttype=$clienttype; $email=$client_details['email'];
$coverFrom= $fromdate; $coverTo=$todate; $paymentmode=$paymentmode; $yourreference=$client_details['referal_code'];
$productid=$productid; $agentid=$client_details['referal_code']; $commissionrate=$commissionrate; 
$riskid=$logbook['registration']; $riskdesc=$logbook['make']; $covtdesc=$covertype; $riskidentifier=$riskidentifier; 
$commrate=$commissionrate; $premium=$_SESSION['grosspremium']; $certno=''; $windscreen=0; 
$entertainment=0; $excessprotector=0; $politicalviolence=0; $aamembership=0; 
$courtesycar=0; $valueOfCar=0; $risknote=''; $wefdate=$coverFrom;
$vehiclemake=$logbook['make']; $vehiclecc=$logbook['rating']; $vehicleyear=$logbook['man_year']; $capacity=$logbook['passengers']; $bodytype=$logbook['body']; 
$chasisno=$logbook['chasis']; $engineno=$logbook['engine_number']; $color=$logbook['color']; $logbookno=$logbook['logbook_number']; $riskId=$riskidentifier; 
$covertype=$covertype; $tonnage=$logbook['load_capacity']; 
$agentid = '00018';
$data=[
      'client' => [
        'idnumber'=> $idnumber,
        'pinnumber'=> $pinnumber,
        'phoneno'=> $phoneno,
        'firstname'=> $firstname,
        'middlename'=> $middlename,
        'lastname'=> $lastname,
        'gender'=> $gender,
        'postaladdress'=> $postaladdress,
        'physicaladdress'=> $physicaladdress,
        'postalcode'=> $postalcode,
        'clienttype'=> $clienttype,
        'email'=> $email
      ],
      'coverFrom'=>$coverFrom,
      'coverTo'=>$coverTo,
      'paymentmode'=>$paymentmode,
      'yourreference'=>$yourreference,
      'productid'=>$productid,
      'agentid'=>$agentid,
      'commissionrate'=>$commissionrate,
      'risks'=>[[
        'riskid'=>$riskid,
        'riskdesc'=>$riskdesc,
        'covtdesc'=>$covtdesc,
        'limit'=>$limit,
        'riskidentifier'=>$riskidentifier,
        'wefdate'=>$wefdate,
        'commrate'=>$commrate,
        'premium'=>$premium,
        'certno'=>$certno,
        'windscreen'=>$windscreen,
        'entertainment'=>$entertainment,
        'excessprotector'=>$excessprotector,
        'politicalviolence'=>$politicalviolence,
        'aamembership'=>$aamembership,
        'courtesycar'=>$courtesycar,
        'valueOfCar'=>$valueOfCar,
        'risknote'=>$risknote
      ]],
      'vehicles'=>[[
        'vehiclemake'=>$vehiclemake,
        'vehiclecc'=>$vehiclecc,
        'vehicleyear'=>$vehicleyear,
        'capacity'=>$capacity,
        'bodytype'=>$bodytype,
        'chasisno'=>$chasisno,
        'engineno'=>$engineno,
        'color'=>$color,
        'logbookno'=>$logbookno,
        'riskId'=>$riskId,
        'covertype'=>$covertype,
        'suminsured'=>$suminsured,
        'tonnage'=>$tonnage
      ]],
      'insureds'=>(array) null
    ];
    // print_r($_SESSION);
    $data = json_encode($data);

  /***
    $data=[
      'client' => [
        'idnumber'=> '33444233',
        'pinnumber'=> 'A009334654H',
        'phoneno'=> '0723342234',
        'firstname'=> 'JOHN',
        'middlename'=> 'WANYAMA',
        'lastname'=> 'OTIENO',
        'gender'=> 'M',
        'postaladdress'=> '2018-00100',
        'physicaladdress'=> 'KASARANI',
        'postalcode'=> '00100',
        'clienttype'=> 'I',
        'email'=> 'john@gmail.com'
      ],
      'coverFrom'=>'22-dec-2021',
      'coverTo'=>'21-dec-2022',
      'paymentmode'=>'M-P',
      'yourreference'=>'008/009/91',
      'productid'=>'0700',
      'agentid'=>'070/00018',
      'commissionrate'=>10,
      'risks'=>[[
        'riskid'=>'KEG 009R',
        'riskdesc'=>'TOYOTA',
        'covtdesc'=>'COMPREHENSIVE',
        'limit'=>2000000,
        'riskidentifier'=>0,
        'wefdate'=>'22-dec-2021',
        'commrate'=>10,
        'premium'=>40000,
        'certno'=>'',
        'windscreen'=>30000,
        'entertainment'=>50000,
        'excessprotector'=>0,
        'politicalviolence'=>0,
        'aamembership'=>0,
        'courtesycar'=>0,
        'valueOfCar'=>1000000,
        'risknote'=>''
      ]],
      'vehicles'=>[[
        'vehiclemake'=>'TOYOTA',
        'vehiclecc'=>'1300',
        'vehicleyear'=>'2010',
        'capacity'=>'5',
        'bodytype'=>'SALOON',
        'chasisno'=>'AF00988900J',
        'engineno'=>'EN0098887098',
        'color'=>'BLUE',
        'logbookno'=>'LOG009887',
        'riskId'=>0,
        'covertype'=>'COMPREHENSIVE',
        'suminsured'=>0,
        'tonnage'=>'5'
      ]],
      'insureds'=>(array) null
    ];
    $data = json_encode($data);
    echo $data;
    // print_r($_SESSION);

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
   
    echo $data;
   */
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
    // $resp= json_decode($resp);
    

    //Set the response content type to application/json
    //read incoming request
    // $postData = file_get_contents('php://input');
    //log file
    $filePath = $_SERVER['DOCUMENT_ROOT']."/transactions/invesco/success.log";
    //error log
    $errorLog = $_SERVER['DOCUMENT_ROOT']."/transactions/invesco/errors.log";
    //Parse payload to json
    $jdata = json_decode($resp,true);
    $check_error = $jdata["object"];
    reset($check_error);//setting internal pointer to first element one
    if(key($check_error) == 'error'){
      $error = $check_error['error'];
      $apiresponce =false;
      // echo $_SESSION["Message"];
    }else{
      $apiresponce = true;
      $policy_number = $jdata["object"]['policyno'];
    }
    
    //perform business operations on $jdata here
    //open text file for logging messages by appending
    
    $file = fopen($filePath,'a');
    //log incoming request
    fwrite($file, $resp);
    $f=fopen($errorLog,'a');
    fwrite($f, $data);
    fwrite($f,'/n');
    fclose($f);
    
    fwrite($file,"\r\n");
    //log response and close file
    // fwrite($file,$resp);
    fclose($file);
    curl_close($curl);
     
} catch (Exception $ex){
    print_r($ex);
    $error = "Error Processing your API. Contact your Agent";
    $apiresponce = false;
    //append exception to errorLog
    $logErr = fopen($errorLog,'a');
    fwrite($logErr, $ex->getMessage());
    fwrite($logErr,"\r\n");
    fclose($logErr);
}

?>