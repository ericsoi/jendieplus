<?php
    include "session.php";
	$_SESSION["product"]["optionalbenefits"] = $_GET;
    header("location: ../quote_step2.php");
?>