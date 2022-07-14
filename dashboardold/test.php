<?php
include_once 'db/connect_db.php';
  // $username = "0743996757";
  // $email = "erick.soi@hotmail.com";
	// $password = "0743996757";
  // $password = md5($password);

  // $select = $pdo->prepare("SELECT * from tbl_user where phonenumber='$username' or emailaddress = '$email' and password='$password'");
  // $select->execute();
  // $row = $select->fetch(PDO::FETCH_ASSOC);
  // $total_records = $select->rowCount();
  // echo ($total_records);
  $ira_pattern = "([A-Z]{3}[/][0-9]{2}[/][0-9]{5}[/][0-9]{4}$)";
  $admin_referal_perttern = "(^[0-9]{5,6}$)";
  $agent_referal_perttern = "(^[0-9]{5,6}[-][0-9]+$)";
  $sub_agent_referal_code = "(^[0-9]{5,6}[-][0-9]+[-][0-9]+$)";
  $email_pattern = "(^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$)";
  $iralicense = "IRA/05/31212/2022";
  $admin="31212-6-4";
  // echo(preg_match($ira_pattern,$iralicense));
  // echo(preg_match($admin_referal_perttern,$admin));
  // echo(preg_match($ira_pattern,$iralicense));
  // echo(preg_match($ira_pattern,$iralicense));
  // echo(preg_match($ira_pattern,$iralicense));
  // if(sizeof(explode("-", $admin)) < 2){
  //   $iralicense_sub = $admin . "-0";
  //   $agent_number = "1";
  //   $gent_code =  $admin;
  // }else{
  //   $agent_number = explode("-", $admin)[1]+1;
  //   $gent_code =  explode("-", $admin)[0];
  //   $iralicense_sub = $gent_code . "-" . $agent_number;
  // }
  echo explode("-",$admin)[2]+1;

?>