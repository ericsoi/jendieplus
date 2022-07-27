<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        include "permmission.php";
        include "db/connect_db.php";
        include "functions.php";
    }
?>