<?php
extract($_POST);
include("dbconnect.php");
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$username = $_POST["username"];
$companyname = $_POST["companyname"];
$phonenumber = $_POST["phonenumber"];
$emailaddress = trim($_POST["email"]);
$contactperson = $_POST["contactperson"];
$physicaladdress = $_POST["physicaladdress"];
$krapin = $_POST["krapin"];
$idnumber = $_POST["idnumber"];
$iralicense = trim($_POST["iralicense"]);
$krapincopy = $_POST["krapincopy"];
$password  = md5($_POST["password"]);
$role = "Operator";
$is_active = "0";
$ira_pattern = "([A-Z]{3}[/][0-9]{2}[/][0-9]{5}[/][0-9]{4}$)";
$admin_referal_perttern = "(^[0-9]{5,6}$)";
$agent_referal_perttern = "(^[0-9]{5,6}[-][0-9]+$)";
$sub_agent_referal_code = "(^[0-9]{5,6}[-][0-9]+[-][0-9]+$)";
$email_pattern = "(^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$)";
if(preg_match($ira_pattern,$iralicense ) == 1) {
  $querry =  "SELECT * FROM tbl_user WHERE iralicense = '$iralicense'";
  $result=mysqli_query($conn,$querry);
  if(mysqli_num_rows($result)<1){
    $row = mysqli_fetch_assoc($result);
    $refferal_code = explode("/", $iralicense)[2];
    $query = "INSERT INTO tbl_user(firstname, lastname, username, companyname, phonenumber, emailaddress, contactperson, krapin, idnumber, iralicense, physicaladdress, password, role, is_active, sub_agent, agent, agent_admin) VALUES ('$firstname','$lastname','$username','$companyname','$phonenumber','$emailaddress','$contactperson','$krapin','$idnumber','$iralicense','$physicaladdress','$password', '$role', '$is_active', '$refferal_code', '$refferal_code', '$refferal_code')";
      if (mysqli_query($conn, $query)) {
          echo "SUCCESS";
          #header ("Location: register.php?status=success"); 
      } else {
          echo("Error description: " . mysqli_error($conn));
          #header ("Location: register.php?status=error"); 
      }
  }else{
    echo("Duplicate");
    #header( "Location: register.php?status=duplicate");
    #exit;
  }
  
}elseif(preg_match($admin_referal_perttern,$iralicense) == 1){
  $query = "SELECT * FROM tbl_user where agent_admin = '$iralicense' ORDER BY time_created DESC LIMIT 1";
  $result=mysqli_query($conn,$query);
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    if(sizeof(explode("-", $row["agent"])) == 1){
      echo (sizeof(explode("-", $row["agent"])));
      $gent_code = $row["agent"] . "-0";
      $gent_admin_code =  $row["agent"];
    }else{
        $agent_number = explode("-", $row["agent"])[1]+1;
        echo $agent_number;
        $gent_code = explode("-", $row["agent"])[0] . "-" . $agent_number;
        $gent_admin_code =  explode("-", $row["agent"])[0];
    }
    $query = "INSERT INTO tbl_user(firstname, lastname, username, companyname, phonenumber, emailaddress, contactperson, krapin, idnumber, iralicense, physicaladdress, password, role, is_active, sub_agent, agent, agent_admin) VALUES ('$firstname','$lastname','$username','$companyname','$phonenumber','$emailaddress','$contactperson','$krapin','$idnumber','$gent_code','$physicaladdress','$password', '$role', '$is_active', '$gent_code', '$gent_code', '$gent_admin_code')";
    if (mysqli_query($conn, $query)) {
      #header ("Location: register.php?status=success"); 
    } else {
      echo("Error description: " . mysqli_error($conn));
      #header ("Location: register.php?status=error"); 
    }
  }else{
    echo("Error description: " . mysqli_error($conn));
    #header( "Location: register.php?status=duplicate");
    #exit;
  }
  
}elseif(preg_match($agent_referal_perttern,$iralicense) == 1){
  $querry = "SELECT * FROM tbl_user where agent = '$iralicense' ORDER BY time_created DESC LIMIT 1";
  $result=mysqli_query($conn,$querry);
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    if (sizeof(explode("-", $row["sub_agent"]))==3){
        $agent_number = explode("-", $row["sub_agent"])[2] +1;
        $agent_code = $row["agent"];
        $sub_gent_code = explode("-", $row["sub_agent"]);
        $sub_gent_code = $sub_gent_code[0] . "-" . $sub_gent_code[1] . "-";
        $sub_gent_code = $sub_gent_code . $agent_number;
        $gent_admin_code = explode("-", $row["agent"])[0];
    }else{
        $agent_number = 0;
        $agent_code = $row["agent"];
        $sub_gent_code = $agent_code . "-". $agent_number;
        $gent_admin_code = explode("-", $row["agent"])[0];
        echo $sub_gent_code;
    }
    $query = "INSERT INTO tbl_user(firstname, lastname, username, companyname, phonenumber, emailaddress, contactperson, krapin, idnumber, iralicense, physicaladdress, password, role, is_active, sub_agent, agent, agent_admin) VALUES ('$firstname','$lastname','$username','$companyname','$phonenumber','$emailaddress','$contactperson','$krapin','$idnumber','$sub_gent_code','$physicaladdress','$password', '$role', '$is_active', '$sub_gent_code', '$agent_code', '$gent_admin_code')";
    if (mysqli_query($conn, $query)) {
      echo "SUCCESS";
    //   #header ("Location: register.php?status=success");
    } else {
      echo("Error description: " . mysqli_error($conn));
    //   #header ("Location: register.php?status=error");
    }
  }
}elseif(preg_match($sub_agent_referal_code,$iralicense) == 1){
  $querry = "SELECT * FROM tbl_user where sub_agent = '$iralicense' ORDER BY time_created DESC LIMIT 1";
  $result=mysqli_query($conn,$querry);
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    $agent_number = explode("-", $row["sub_agent"])[2] +1;
    $agent_code = $row["agent"];
    $sub_gent_code = explode("-", $row["sub_agent"]);
    $sub_gent_code = $sub_gent_code[0] . "-" . $sub_gent_code[1] . "-";
    $sub_gent_code = $sub_gent_code . $agent_number;
    $gent_admin_code = explode("-", $row["agent"])[0];
    #echo $sub_gent_code;
    echo $gent_admin_code;
    $query = "INSERT INTO tbl_user(firstname, lastname, username, companyname, phonenumber, emailaddress, contactperson, krapin, idnumber, iralicense, physicaladdress, password, role, is_active, sub_agent, agent, agent_admin) VALUES ('$firstname','$lastname','$username','$companyname','$phonenumber','$emailaddress','$contactperson','$krapin','$idnumber','$sub_gent_code','$physicaladdress','$password', '$role', '$is_active', '$sub_gent_code', '$agent_code', '$gent_admin_code')";
    if (mysqli_query($conn, $query)) {
      echo "SUCCESS";
    //   #header ("Location: register.php?status=success");
    } else {
      echo("Error description: " . mysqli_error($conn));
    //   #header ("Location: register.php?status=error");
    }
  }
}else{
  echo("Error description: " . mysqli_error($conn));
  #header( "Location: register.php?status=duplicate");
  #exit;
}
?>