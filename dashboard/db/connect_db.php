<?php

    try{
        $pdo = new PDO('mysql:host=localhost;dbname=ipos','jendieplus','Jendieplus!@34');
        //echo 'Connection Successfull';
    }catch(PDOException $error){
        echo $error->getmessage();
    }
    
?>