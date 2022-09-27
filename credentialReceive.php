<?php
	session_start();
	header ("Content-Type: application/json; charset=utf-8");
	include_once "config/config.php";
	$cnf=new Config();
	$url=$cnf->restURL;
	
	require_once("lib/nusoap.php");
	include_once("objects/tquotaprevillage.php");
	include_once("config/database.php");

	$database=new Database();
	$db=$database->getConnection();
	$objA=new tquotaprevillage($db);



	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
	$id=isset($_GET["id"])?$_GET["id"]:"";

	print_r($id);



	$client = new nusoap_client("http://entrance.nrru.ac.th/nrruwebservice/nrruWebService_SSO.php?wsdl",true);
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
	$params = array(
		'userlogin' => $userCode
	);
	$data = $client->call("getUserLogin",$params); 
	

	if(count($data)>0){
		$obj = json_decode($data);
		$user=$obj[0];
		if(intval($user->staffstatus)>0){
					$_SESSION["staffid"]=$user->staffid	;
					$_SESSION["userCode"]=$user->username;
					$_SESSION["UserName"]=$user->username;
					$_SESSION["FullName"]=$user->firstname.' '.$user->lastname  ;
					$_SESSION["Picture"]=$user->picture;
					$_SESSION["id"]=$id;
					$_SESSION["DepartmentId"]=$user->departmentcode1;
					if($objA->isAuthorizeUser($userCode)===true)
						header("location:page.php");
					else
						header("location:userPage.php");
		} 
	}else{
		header("location:messageNotify.php");
	}

	
?>