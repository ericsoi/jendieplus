<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "dashboard/session.php";
$data = json_encode($_SESSION);
$owner = $_SESSION["client_details"]["referal_code"];
$insert = $pdo->prepare("INSERT INTO tbl_quote(owner, data) VALUES(:owner,:data)");
$insert->bindParam(':owner', $owner);
$insert->bindParam(':data', $data);
$insert->execute();
?>
