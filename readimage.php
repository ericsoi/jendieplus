<?php
require_once "vendor/autoload.php";
 
use thiagoalessio\TesseractOCR\TesseractOCR;
 
try {
    $tesseract =new TesseractOCR('logbook-_-2Logbook.jpeg');
    
    $text = $tesseract->recognize();
    $text=$text->run();
    // echo $text;
    $prefix = "Registration:";
    $index = strpos($text, $prefix) + strlen($prefix);
    $string = substr($text, $index);
    $str = explode(":", $text);
    print_r($str);
    // $Registration= ;
    // $Passengors = ;
    // $Chassis_Frame = ;
    // $Tare_Weight = ;
    // $Make = ;
    // $Tax_Class = ;
    // $Model = ;
    // $Type = ;
    // $Load_Capacity = ;
    // $Body = ;
    // $Pravious_Reg = ;
    // $Fuel = ;
    // $Man_Year = ;
    // $PIN = ;
    // $Engine_No = ;
    // $Gross_weight = ;
    // $Duty = ;
} catch(Exception $e) {
    echo $e->getMessage();
}

  
// // Create a new imagick object
// $imagick = new imagick();
  
// // Read the image
// $imagick->readImage(
// 'logbook-_-2Logbook.jpeg');
  
// // Display the image
// header("Content-Type: image/png");
// echo $imagick->getImageBlob();
?>