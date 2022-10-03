<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
    }
    $_SESSION["confirmed_items"]=$_GET;
    // header("location: ../gateway.php");
    if($_SESSION["confirmed_items"]["payments"] == "mpesa"){
      include "../transactions/processing/handle_policy_mpesa.php";
      header("location: ../gateway.php");
    }else{
      include "../transactions/processing/handle_policy_credit.php";
      header("location: ../confirmationpage.php?status=$responce");
    }
?>