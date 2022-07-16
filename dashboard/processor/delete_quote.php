<?php
include "../db/connect_db.php";
$delete = $pdo->prepare("DELETE FROM tbl_quote WHERE id = '".$_GET['q']." '");
if($delete->execute()){
    header ("Location: ../build/pages/quotations.php");
}
?>