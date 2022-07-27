<?php

    try{
        $pdo = new PDO('mysql:host=localhost;dbname=ipos','root','devadmin');
        //echo 'Connection Successfull';
    }catch(PDOException $error){
        echo $error->getmessage();
    }
?>