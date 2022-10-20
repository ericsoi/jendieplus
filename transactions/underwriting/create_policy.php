<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../dashboard/db/connect_db.php";
switch ($_SESSION["underwriter"]["ID"]){
    case 50:
        include "invesco/policy.php";
        break;
    default:
        1;
        break;
}

?>