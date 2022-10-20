<?php
@session_start();
$_SESSION["edit_product"]=$_GET["q"];
if(isset($_GET["delete"])){
    include "../../../db/connect_db.php";
    $id=$_GET["q"];
    $delete = $pdo->prepare("DELETE from tbl_product WHERE product_id='$id'");
    if($delete->execute()){
        header('location: ../products.php?status=deleted&product_id='.$id);
    }
    exit;
}
header('location:../optionalbenefits.php');
?>