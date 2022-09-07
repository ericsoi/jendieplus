<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
    }
    $_SESSION["gateway"]=$_GET;
    header("location: ../transactions/processing/handle_policy.php");
?>