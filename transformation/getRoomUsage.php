<?php
	header ("Content-Type: application/json; charset=utf-8");
	include_once "../lib/nusoap.php";
	$yearNo=isset($_GET["yearNo"])?$_GET["yearNo"]:"2564";
	$termNo=isset($_GET["termNo"])?$_GET["termNo"]:"2";
	$buildingCode=isset($_GET["buildingCode"])?$_GET["buildingCode"]:"029";

	$client = new nusoap_client("http://entrance.nrru.ac.th/nrruwebservice/nrruWebService_timetable.php?wsdl",true); 
	$params = array(
		'buildingcode' => $buildingCode,
		'acadyear' => $yearNo,
		'semester' => $termNo
	);

	$data = $client->call("getTime",$params); 
	//$usageRoom = json_decode($data,true);

	echo $data;

?>