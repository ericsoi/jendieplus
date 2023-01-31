<?php
    include "session.php";
    if(isset($_SESSION["client_details"]["referal_code"] )){
        unset($_SESSION["client_details"] );
    }
    $id=$_GET["q"];
    $select = $pdo->prepare("SELECT * FROM tbl_underwriter where ID='$id'");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);
    $_SESSION["underwriter"] = $row;
    $request_headers = getallheaders();
    $origin = $request_headers['Referer'];
    $_SESSION["origin"]=parse_url($origin)['host'];
    // foreach($_SERVER as $key => $value){
    //     echo '$_SERVER["'.$key.'"] = '.$value."<br />";
    // }
    switch($origin){
        // case "https://jendieplus.co.ke/":
        case "https://iplus.co.ke/":
            $_SESSION["client_details"]["referal_code"] = "31212";
            break;
        case "http://gatwickinsuranceconsultants.co.ke/":
            $_SESSION["client_details"]["referal_code"] = "27308";
            break;
        case "https://gatwickinsuranceconsultants.co.ke/":
            $_SESSION["client_details"]["referal_code"] = "27308";
            break;
        case "http://www.leqxer.agency/":
            $_SESSION["client_details"]["referal_code"] = "41279";
            break;
        case "https://www.leqxer.com/":
            $_SESSION["client_details"]["referal_code"] = "41279";
            break;
        case "https://www.leqxer.co.ke/":
            $_SESSION["client_details"]["referal_code"] = "41279";
            break;
        case "http://localhost/":
            $_SESSION["client_details"]["referal_code"] = "31212";
            break;
        default:
            $_SESSION["client_details"]["referal_code"] = "";
    }
    print_r($_SESSION["client_details"]["referal_code"]);
    header("location: ../underwriter.php");
    //Leqxer ref code 41279
//Gatwick ref code 27308
    
?>
