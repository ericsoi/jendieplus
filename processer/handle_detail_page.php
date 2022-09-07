<?php
    include "session.php";
	$_SESSION["product"]["optionalbenefits"] = $_GET;
    $_SESSION["grosspremium"] = preg_replace("/[^0-9]/", "", $_GET["grosspremium"]);
    header("location: ../quote_step2.php");
?>