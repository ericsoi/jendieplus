

<?php
	

    include "session.php";
    $_SESSION["client_details"]=$_GET;
    if(isset($_GET["term"])){
        $_SESSION["client_details"]["vehicle_make"] =$_GET["term"];
        $_SESSION["client_details"]["coverperiod"]="1 year";
    }
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/doubleinsurance.php';
    header("location: ../detail-page.php");
?>
