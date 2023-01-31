<?php
@session_start();
if(isset($_POST["cert_no"])){
    $CertNo = trim($_POST["cert_no"]);
    // echo $CertNo;
    include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/cert_pdf.php';
    header("Location: ../certpdf.php?id=".$hyperlinked_text);
    $_SESSION["cert_url"] = $hyperlinked_text;
}else{
    header("Location: ../certpdf.php");
}
?>