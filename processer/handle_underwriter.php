<?php
    include "session.php";
	$_SESSION["cover"] = $_GET["cover"];
    if($_SESSION["cover"]=="Third Party Only"){
        header("location: ../get_quote.php");
    }
    if($_SESSION["cover"]=="Comprehensive"){
        header("location: ../get_quote_comprehensive.php");
    }
?>