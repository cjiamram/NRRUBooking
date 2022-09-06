<?php
	require_once("../lib/nusoap.php");
	header ("Content-Type: text/html; charset=utf-8");

	$data = json_decode(file_get_contents("php://input"));

	$client = new nusoap_client("http://entrance.nrru.ac.th/nrruwebservice/nrruWebService_userLogin.php?wsdl",true);
	$params = array(
		'userlogin' => $data["userName"],
		'password' => $data["password"]
	);
	$data = $client->call("getUserLogin",$params); 
	$student = json_decode($data,true);

?>