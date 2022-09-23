<?php
	header ("Content-Type: application/json; charset=utf-8");
	session_start();	
	require_once("../lib/nusoap.php");
	include_once "../lib/classAPI.php";
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
	$api=new ClassAPI();
	$url="http://nrruapp.nrru.ac.th/NRRUCredential/NRRUCredentialSSO.php?userCode=".$userCode;
	$user=$api->getAPI($url);

	//print_r($user);

	

	if(intval($user["staffstatus"])>0){
					$_SESSION["staffid"]=$user["staffid"]	;
					$_SESSION["userCode"]=$user["username"];
					$_SESSION["UserName"]=$user["username"];
					$_SESSION["FullName"]=$user["firstname"].' '.$user["lastname"]  ;
					$_SESSION["Picture"]=$user["picture"];
					$_SESSION["DepartmentId"]=$user["departmentcode1"];
					
	} else{
		//echo json_encode(array("message"=>false));
	}

	


	
?>