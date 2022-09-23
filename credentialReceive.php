<?php
	session_start();
	header ("Content-Type: application/json; charset=utf-8");
	include_once "config/config.php";
	$cnf=new Config();
	$url=$cnf->restURL;
	require_once("lib/nusoap.php");
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";

	$client = new nusoap_client("http://entrance.nrru.ac.th/nrruwebservice/nrruWebService_SSO.php?wsdl",true);
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
	$params = array(
		'userlogin' => $userCode
	);
	$data = $client->call("getUserLogin",$params); 
	$obj = json_decode($data);
	
	$user=$obj[0];
	//print_r($user->staffstatus);
	if(intval($user->staffstatus)>0){
					$_SESSION["staffid"]=$user->staffid	;
					$_SESSION["userCode"]=$user->username;
					$_SESSION["UserName"]=$user->username;
					$_SESSION["FullName"]=$user->firstname.' '.$user->lastname  ;
					$_SESSION["Picture"]=$user->picture;
					$_SESSION["DepartmentId"]=$user->departmentcode1;
					//header("location:testAut.php");
					header("location:page.php");
					//print_r($_SESSION["staffid"]);
	} else{
		//header("location:logout.php");
	}

?>