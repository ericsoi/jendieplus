<?php
@session_start();
if(isset($_POST["cert_no"])){
    $CertNo = trim($_POST["cert_no"]);
    // echo $CertNo;
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/cancel_cert.php';
    if($object->success==1){
        $_SESSION["cert_cancel"] = $object->callbackObj;
        
    }else{
        $_SESSION["cert_cancel"] = $object->Error[0]['errorText'];
    }
    header("Location: ../cancelcert.php");

}else{
    header("Location: ../cancelcert.php");
}
?>