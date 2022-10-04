<?php
    include $_SERVER['DOCUMENT_ROOT']."/config/db.php";
    include $_SERVER['DOCUMENT_ROOT']."/dashboard/db/connect_db.php";
    $sql = "SELECT * from tbl_mpesa limit 1";
        $sql_res = mysqli_query($connection, $sql);
        $rowcount=mysqli_num_rows($sql_res);
        if ($rowcount>=1){
            $row = mysqli_fetch_object($sql_res);
            
            $_SESSION["stk_callback"]=$row;
            print_r($_SESSION["stk_callback"]);
            print_r($_SESSION["stk_callback"]->MerchantRequestID);
        }else{
          echo "FFF";
        }
?>