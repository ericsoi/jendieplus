<?php
@session_start();
if(isset($_POST["vehiclereg"])){
    $RegNo = trim($_POST["vehiclereg"]);
    $ChasisNo = trim($_POST["chasis_no"]);
    $CertNo = trim($_POST["cert_no"]);
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/validate_cert.php';
    if($validate->success == 1){
        $message = $validate->callbackObj["ValidateInsurance"];
        $_SESSION["valid_cert"]=true;
        $_SESSION["ValidateInsurance"]=$message;
        print_r($message);
    }else{
        $message = $validate->Error[0]["errorText"];
        $_SESSION["valid_cert"]=false;
        $_SESSION["cert"] = $CertNo;
        $_SESSION["ValidateInsurance"]=$message;
        print_r($validate);
    }
    // echo $CertNo;
    //include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/cert_pdf.php';
    header("Location: ../validatecert.php");
    // $_SESSION["cert_url"] = $hyperlinked_text;
}else{
    header("Location: ../certpdf.php");
}
?>