<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../../db/connect_db.php";
include "functions/select.php";
$is_active = '';
$status = "active";
switch ($status) {
case "inactive":
    $is_active = "0";
    break;
case "active":
    $is_active = "1";
    break;
default:
    $is_active = "inactive";
}
$page="";
$role=$_GET["role"];
switch($role){
    case "admin":
        $page="nav/headeradmin.php";
        break;
    case "agency":
        $page="nav/headeragency.php";
        break;
    case "subagent";
        $page="nav/headersubagent.php";
        break;
    case "operator";
        $page="nav/headersoperator.php";
        break;
    default:
        $page="nav/headers_all.php";
}
// include $page;
      $update = $pdo->prepare("UPDATE tbl_user SET is_active='$is_active' WHERE code='".$_GET['code']."'");
      $update->bindParam(':is_active', $is_active);
      if($update->rowCount() > 0){
        echo'<script>alert("Failure")</script>';
        header ("Location: users.php");
      }elseif($update->execute()){
        echo'<script>alert("Success")</script>';
        header ("Location: users.php");
      }
?>