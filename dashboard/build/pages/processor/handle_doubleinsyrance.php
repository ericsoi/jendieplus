<?php
@session_start();
if(isset($_POST["vehiclereg"])){
    $vehiclereg = trim($_POST["vehiclereg"]);
    echo $vehiclereg;
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/doubleinsurance.php';
    if($object->success == 1){
        $message = $object->callbackObj["DoubleInsurance"];
        $_SESSION["double_insured"]=true;
    }else{
        $message = $object->Error[0]["errorText"];
        $_SESSION["double_insured"]=false;
        $_SESSION["reg"] = $vehiclereg;
    }
    
    header("Location: ../doubleinsurance.php");
    $_SESSION["double_insurance"] = $message;
    
}else{
    header("Location: ../doubleinsurance.php");
}
?>