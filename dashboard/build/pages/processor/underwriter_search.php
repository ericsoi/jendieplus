<?php
    include $_SERVER['DOCUMENT_ROOT'].'/config/db.php';
    if (isset($_GET['term'])) {
        
    $query = "SELECT * FROM tbl_underwriter WHERE Name LIKE '%{$_GET['term']}%'";
        $result = mysqli_query($connection, $query);
    
        if (mysqli_num_rows($result) > 0) {
        while ($vehicle = mysqli_fetch_array($result)) {
            $res[] = $vehicle['Name'];
            }
        } else {
            $res = array();
        }
        //return json res
        echo json_encode($res);
}
?>