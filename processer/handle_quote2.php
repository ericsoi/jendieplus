<?php
	include "session.php";
	$_SESSION["logbook"] = $_POST;
	$id_number = trim($_POST["id_number"]);
	$docs = array();
	$logbooks = dirname(getcwd(),1) . "/dashboard/client_files/logbooks/$id_number/";
	if (!file_exists($logbooks)) {
		mkdir($logbooks, 0755, true);
	}
	$owner = $_SESSION["client_details"]["referal_code"];
	$owner=explode('/',$owner)[0];
	$select = $pdo->prepare("SELECT * FROM tbl_user where agency = '$owner'");
	$select->execute();
	$row = $select->fetch(PDO::FETCH_ASSOC);
	$_SESSION["intermediary_name"] = $row["companyname"];
	$_SESSION["intermediary_ira"] = $row["iralicense"];
	if (!empty($_POST)){
		$_SESSION["logbook"] = $_POST;
		$_SESSION["files"] = $_FILES['clientFiles'];
		$names= explode(' ', $_SESSION["client_details"]["name_contact"]);
		$_SESSION["firstname"] = $names[0];
		$_SESSION["lastname"] = $names[1];
	}

	if ( null !==  $_FILES['clientFiles']){
		foreach($_FILES['clientFiles']['tmp_name'] as $key=>$tmp_name){
			$file_name = $_FILES['clientFiles']['name'][$key];
			$u_file_name=$file_name;
			$file_tmp =$_FILES['clientFiles']['tmp_name'][$key];
			$ext = pathinfo($file_name, PATHINFO_EXTENSION);
			if ($key == 0){
				$file_name = strtolower($_SESSION["firstname"])."-idnumber.".$ext;
				$_SESSION["client_files"]["u_id"] = $logbooks . $u_file_name;
				$_SESSION["client_files"]["id"] = $logbooks . $file_name;

			}elseif($key == 1){
				$file_name = strtolower($_SESSION["firstname"])."-kra.".$ext;
				$_SESSION["client_files"]["u_kra"] = $logbooks . $u_file_name;
				$_SESSION["client_files"]["kra"] = $logbooks . $file_name;

			}else{
				$file_name = strtolower($_SESSION["firstname"])."-logbook.".$ext;
				$_SESSION["client_files"]["u_logbook"] = $logbooks . $u_file_name;
				$_SESSION["client_files"]["logbook"] = $logbooks . $file_name;

			}
			$path = $logbooks . $file_name;
			$u_path = $logbooks . $u_file_name;
			move_uploaded_file($file_tmp, $u_path);
			if(move_uploaded_file($file_tmp, $path)){
				array_push($docs, $path);    
			}
		}
	}
    header("location: ../confirmationpage.php");
?>