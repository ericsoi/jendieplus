<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT'].'/config/db.php';
if(isset($_POST["term"])){
    $Name = trim($_POST["term"]);
    $query = "SELECT Membercompanyid FROM tbl_underwriter WHERE Name LIKE '%{$Name}%'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        $Names = mysqli_fetch_array($result);
        $Membercompanyid = $Names["Membercompanyid"];
        // echo $Membercompanyid;
        include $_SERVER['DOCUMENT_ROOT'].'/transactions/aki/member_company_stock_inventory.php';
        if($object->success == 1){
            $_SESSION['inventory'] = $object->callbackObj["MemberCompanyStock"];
            $_SESSION['inventory_underwriter'] = $Name;
            // print_r($object);

            header("Location: ../inventory.php");
        }
    }
  
}else{
    header("Location: ../inventory.php");
}
?>