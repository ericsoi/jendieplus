<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if(isset($_POST['btn_otp'])){
    if(1==1){
    // if($_POST['otp'] == $_SESSION['otp']){
        header ("Location: ../build/pages/dashboard.php?q=".$_SESSION["username"]);
    }else{
        header ("Location: ../build/pages/otp.php?status=error");
    }
}
?>