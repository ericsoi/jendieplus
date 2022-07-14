<?php
// Array with names
include 'db/connect_db.php';
$select = $pdo->prepare("SELECT * FROM `tbl_vehicle_model`");
$select->execute();
while($row = $select->fetch(PDO::FETCH_ASSOC)){
  extract($row);
  $a[] =$row["make_name"];
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
        

        $hint .= '<input type="button" class="form-control" id="'.str_replace(" ", "", $name).'" aria-describedby="emailHelp" style="overflow: hidden;" value="'.$name.'" onclick="handleChange(this.id, this.value)">';
      } else {
        $hint .= '<input type="button" class="form-control" id="'.str_replace(" ", "", $name).'" aria-describedby="emailHelp" style="overflow: hidden;" value="'.$name.'" onclick="handleChange(this.id, this.value)">';
      }
    }
  }
}
// '<button id="'.str_replace(" ", "", "test").'"onclick="handleChange()">'.$name.'</button>';
// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
?>