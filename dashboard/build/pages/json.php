<?php

$dbhost ="localhost";
$dbuser = "jendieplus";
$dbpass = "Jendieplus!@34";
$dbname ="ipos";

//connect to database
$conn = @mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Couldn't connet to database.");

//get the data from table ‘books’
$query = "select ID,Name from tbl_underwriter";

//execute the query
$result = mysqli_query($conn, $query);

if(!$result){ echo "Couldn't execute the query"; die();}
else{

 //creates an empty array to hold data
 $data = array();
  while($row = mysqli_fetch_assoc($result)){
    $data[]=$row;
  }

//  echo json_encode($data, JSON_PRETTY_PRINT);

//it will create file results.json with writing mode.
//you can read more about file handling in PHP here. 
$fp = fopen('underwriters.json', 'w');

//json_enconde($array, $options(optional) is the method to convert array into JSON
fwrite($fp, json_encode($data, JSON_PRETTY_PRINT));

//close the file
fclose($fp);
}

?>