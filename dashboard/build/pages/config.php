<?php

$host = "localhost"; /* Host name */
$user = "jendieplus"; /* User */
$password = "Jendieplus!@34"; /* Password */
$dbname = "ipos"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}