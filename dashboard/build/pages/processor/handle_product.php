<?php
@session_start();
$_SESSION["edit_product"]=$_GET["q"];
header('location:../optionalbenefits.php');
?>