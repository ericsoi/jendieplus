<?php
// path to your JSON file
header('Content-Type: application/json'); 
header('Access-Control-Allow-Origin: *');
$file = 'underwriters.json'; 
// put the content of the file in a variable
$data = file_get_contents($file); 
// JSON decode
$obj = json_encode($data); 
// display the name of the first person
echo($data);