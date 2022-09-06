<?php
	header("content-type:application;charset=UTF-8");
	include_once "../objects/toptional.php";
	include_once "../config/database.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new toptional($db);
	$bookingId=isset($_GET["bookingId"])?$_GET["bookingId"]:0;
	$templateCode=isset($_GET["templateCode"])?$_GET["templateCode"]:"";

	//print_r($bookingId);
	$flag=$obj->isExist($bookingId,$templateCode);

	echo json_encode(array("flag"=>$flag));

?>