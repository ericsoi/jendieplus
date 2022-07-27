<?php
$numbers = array(1, 9, 14, 53, 112, 755, 1001, 1200);
foreach($numbers as $number) {
    printf('%d => %d'
            , $number
            , $number - $number % pow(10, floor(log10($number)))
            );
    echo "<br>";
}

echo 1 -  % pow(10, floor(log10(1));

?>