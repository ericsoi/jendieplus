<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
    }
    $_SESSION["gateway"]=$_GET;
    print_r($_SESSION);
    //header("location: ../transactions/processing/handle_policy_mpesa.php");
?>