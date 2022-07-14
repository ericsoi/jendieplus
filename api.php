<?php 
error_reporting(0);
  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
  $host = "localhost";
  $user = "root";
  $pass = "";
 
  $databaseName = "ppc";
  $tableName = "cmdata";
 
 
$client = mysql_real_escape_string($_GET['client']);
 
// $client = "Its";
 
 
  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);
 
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  $result = mysql_query("SELECT * FROM $tableName where client='$client'");          //query
  $array = mysql_fetch_row($result);                          //fetch result    
 
  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  echo json_encode($array);
 
?>