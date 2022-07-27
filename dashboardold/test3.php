<?php
$arr = array( "Geeks  ", "  for", "   Geeks   ");
foreach($arr as $key => $value){
    echo(strlen($arr[$key]) . "<br>");
}
$arr = array_map('trim', $arr);
foreach($arr as $key => $value){
    echo(strlen($arr[$key]) . "<br>");
}
?>