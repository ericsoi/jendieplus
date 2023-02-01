

<?php
	

    include "session.php";
    $_SESSION["client_details"]=$_GET;
    if(isset($_GET["term"])){
        $_SESSION["client_details"]["vehicle_make"] =$_GET["term"];
        $_SESSION["client_details"]["coverperiod"]="1 year";
    }
    $names = $_GET["name_contact"];
    $email = $_GET["email"];
    $vehicle_reg = $_GET["vehicle_reg"];
    $referal_code = $_GET["referal_code"];
   
     include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/doubleinsurance.php';
    
     header("location: ../detail-page.php");
?>
