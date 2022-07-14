<?php
// Array with names
include 'dashboard/db/connect_db.php';
$select = $pdo->prepare("SELECT * FROM `tbl_underwriter` WHERE NOT (Name LIKE '%life%' or Name LIKE '%Pioneer Assurance Company Limited%' or Name LIKE '%Health%')");
$select->execute();
while($row = $select->fetch(PDO::FETCH_ASSOC)){
  extract($row);
  $a[] =$row["Name"];
}	

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  foreach($a as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name;
      } else {
        $hint .= ", $name";
      }
    }
  }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
?>