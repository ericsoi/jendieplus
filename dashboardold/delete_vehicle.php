<?php
 include_once'db/connect_db.php';
 session_start();
 if($_SESSION['role']!=="Admin"){
   header('location:index.php');
 }

$delete = $pdo->prepare("DELETE FROM tbl_excluded_vehicles WHERE vehicle_id = '".$_GET['id']." '");
if($delete->execute()){
    header('location:excluded_vehicles.php');
}


