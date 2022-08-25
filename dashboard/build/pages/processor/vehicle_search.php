<?php
    include  '../../../../config/db.php';
    if (isset($_GET['term'])) {
        
    $query = "SELECT * FROM tbl_vehicle_model WHERE make_name LIKE '%{$_GET['term']}%'";
        $result = mysqli_query($connection, $query);
    
        if (mysqli_num_rows($result) > 0) {
        while ($vehicle = mysqli_fetch_array($result)) {
        $res[] = $vehicle['make_name'];
        }
        } else {
        $res = array();
        }
        //return json res
        echo json_encode($res);
}
?>