<?php
    function select_user($userid){
        include 'db/connect_db.php';
        $select=$pdo->prepare("SELECT * FROM tbl_user where code ='$userid'");
        $select->execute();
        $total_records = $select->rowCount();
        if($total_records > 0){
            $row=$select->fetch(PDO::FETCH_OBJ);         
            return $row;
        }else{
            return false;
        }
    }
    
?>