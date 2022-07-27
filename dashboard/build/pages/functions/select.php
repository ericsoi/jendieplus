<?php
    // include "../../../db/connect_db.php";
    function selectuser($query){
        global $pdo;
        $select=$pdo->prepare($query);
        $select->execute();
        $total_records = $select->rowCount();
        if($total_records > 0){
            $row=$select->fetch(PDO::FETCH_OBJ); 
            return $row;
        }else{
            return false;
        }
    }

    function selectunderwriter($query){
        global $pdo;
        $select=$pdo->prepare($query);
        $select->execute();
        if($select->rowCount() > 0){
            while($row=$select->fetch(PDO::FETCH_OBJ)){ 
                $return[] = $row;
            }
            return $return;
        }
    }

?>

