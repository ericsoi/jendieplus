<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if(isset($_POST['btn_login'])){
	include "../db/connect_db.php";
	$password = trim($_POST['password']);
    $password = md5($password);
	$username = trim($_POST["username"]);
	$select=$pdo->prepare("SELECT * from tbl_user where phonenumber='$username' and password='$password'");
	$select->execute();
	$total_records = $select->rowCount();
	if($total_records > 0){
		$row=$select->fetch(PDO::FETCH_OBJ); 
		$_SESSION["username"]=$username;
		$_SESSION["loggedin"]=true;
		if($row->is_active == 0){
			
			if($row->role == "agency"){
				header ("Location: ../build/pages/pending/pendingoperator.php?q=".$username);
			}
			if($row->role == "subagent"){
				header ("Location: ../build/pages/pending/pendingsabagent.php?q=".$username);
			}
			if($row->role == "operator"){
				header ("Location: ../build/pages/pending/pendingoperator.php?q=".$username);
			}			
		}if($row->is_active == 1){
			header ("Location: ../build/pages/dashboard.php?q=".$username);
		}
		
	}else{
		$errormsg="error";
		header ("Location: ../build/pages/sign-in.php?status=error");
	}
}
?>