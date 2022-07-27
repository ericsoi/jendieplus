<?php
$n=12;
function getRandomString($n) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    $out = substr_replace( $randomString, "/", 3, 0 );
    $out = substr_replace( $out, "/", 6, 0 );
    $out = substr_replace( $out, "/", 10, 0 );
    return $out;
}
?>