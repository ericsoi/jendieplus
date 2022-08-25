<?php
    include "session.php";
    $id=$_GET["q"];
    $select = $pdo->prepare("SELECT * FROM tbl_underwriter where ID='$id'");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);
    $_SESSION["underwriter"] = $row;
    header("location: ../underwriter.php");
?>