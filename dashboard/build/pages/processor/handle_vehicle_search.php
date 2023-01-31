<?php
@session_start();
if(isset($_POST["reg_no"])){
    $RegNo = trim($_POST["reg_no"]);
    // echo $CertNo;
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/vehicle_search.php';
    if($object->success ==1){
        $_SESSION["vehicle_history"] = $object->callbackObj["Vehicle"];
        header("Location: ../vehiclesearch.php");
    }

}else{
    header("Location: ../vehiclesearch.php");
}
?>