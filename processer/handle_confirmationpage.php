<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
    }
    $_SESSION["confirmed_items"]=$_GET;
    header("location: ../gateway.php");
?>