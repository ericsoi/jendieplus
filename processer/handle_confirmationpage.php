<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
    }
    $_SESSION["confirmed_items"]=$_GET;
    // header("location: ../gateway.php");
    if($_SESSION["confirmed_items"]["payments"] == "mpesa"){
      header("location: ../gateway.php");
    }else{
      include $_SERVER['DOCUMENT_ROOT']."/transactions/processing/handle_policy_credit.php";
      header("location: ../confirmationpage.php?status=$responce");
    }
?>