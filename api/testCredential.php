<?php
header("Content-Type: application/json; charset=UTF-8");
	require_once("../lib/nusoap.php");
	header ("Content-Type: text/html; charset=utf-8");

	$client = new nusoap_client("http://entrance.nrru.ac.th/nrruwebservice/nrruWebService_userLogin.php?wsdl",true);
	$params = array(
		'userlogin' =>"6080101125",
		'password' => "150841"
	);
	$data = $client->call("getUserLogin",$params); 
	$student = json_decode($data,true);


	//echo 'student : ' . $student . '<br><br>';
	if($data!=""){
		echo  json_encode($data);
	}
	
	
?>