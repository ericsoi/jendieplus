<?php
if(isset($_POST["btn_login"])){
	session_start();
	$_SESSION["register"] = $_POST;
	include_once'db/connect_db.php';
	$firstname=trim($_POST["firstname"]);
	$lastname=trim($_POST["lastname"]);
	$emailaddress=trim($_POST["email"]);
	$phonenumber=trim($_POST["phone"]);
	$password=trim($_POST["password"]);
	$password=md5($password);
	$is_active=0;
	$select = $pdo->prepare("SELECT * from tbl_user where emailaddress='$emailaddress' or phonenumber = '$phonenumber'");
	$select->execute();
	$total_records = $select->rowCount();
	if($total_records > 0){
		header ("Location: register.php?status=duplicate");
	}else{
		$insert = $pdo->prepare("INSERT INTO tbl_user(firstname,lastname,emailaddress,phonenumber,password,is_active)values(:firstname,:lastname,:emailaddress,:phonenumber,:password,:is_active)");
		$insert->bindParam(':firstname',$firstname);
		$insert->bindParam(':lastname',$lastname);
		$insert->bindParam(':emailaddress',$emailaddress);
		$insert->bindParam(':phonenumber',$phonenumber);
		$insert->bindParam(':password',$password);
		$insert->bindParam(':is_active',$is_active);
		if($insert->execute()){
			echo "success";
			header ("Location: update.php?status=success");
		}else{
			print_r($insert->errorInfo());
			header ("Location: update.php?status=error");
		}
		
    }	
}