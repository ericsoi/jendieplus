<?php
    include "session.php";
    
    $id=$_GET["q"];
    $select = $pdo->prepare("SELECT * FROM tbl_underwriter where ID='$id'");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);
    $_SESSION["underwriter"] = $row;
    $request_headers = getallheaders();
    $origin = $request_headers['Referer'];
    $_SESSION["origin"]=parse_url($origin)['host'];
    switch($origin){
        // case "https://jendieplus.co.ke/":
        case "http://iplus.co.ke/":
            $_SESSION["client_details"]["referal_code"] = "31212";
            break;
        default:
            $_SESSION["client_details"]["referal_code"] = "";
    }
    header("location: ../underwriter.php");
?>