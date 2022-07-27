<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if(isset($_POST["btn_login"])){
		print_r($_POST);
		session_start();
		include "../db/connect_db.php";
		$names=explode(" ", trim($_POST["fullnames"]));
		if(sizeof($names)==1){
		$firstname=$names[0]; $lastname=$names[0];
		}elseif(sizeof($names)==2){
		$firstname=$names[0]; $lastname=$names[1];
		}else{
		$firstname=$names[0]; $lastname=$names[sizeof($names)-1];
		}
		$phonenumber=trim($_POST["phone"]);
		$password=trim($_POST["password"]);
		$password=md5($password);
		$is_active=0;
		$_SESSION["firstname"]=$firstname; $_SESSION["lastname"]=$lastname;$_SESSION["phonenumber"]=$phonenumber;
		$select = $pdo->prepare("SELECT * from tbl_user where phonenumber = '$phonenumber'");
		$select->execute();
		$total_records = $select->rowCount();
		if($total_records > 0){
			header ("Location: ../build/pages/sign-up.php?status=duplicate");
		}else{
			$insert = $pdo->prepare("INSERT INTO tbl_user(firstname,lastname,phonenumber,password,is_active)values(:firstname,:lastname,:phonenumber,:password,:is_active)");
			$insert->bindParam(':firstname',$firstname);
			$insert->bindParam(':lastname',$lastname);
			$insert->bindParam(':phonenumber',$phonenumber);
			$insert->bindParam(':password',$password);
			$insert->bindParam(':is_active',$is_active);
			if($insert->execute()){
				header ("Location: ../build/pages/update.php");
			}else{
				print_r($insert->errorInfo());
				header ("Location: ../build/pages/sign-up.php?status=error");
			}
			
		}	
	}
?>