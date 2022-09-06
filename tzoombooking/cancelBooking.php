<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tzoombooking.php";
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";


	$cnf=new Config();
	$api=new ClassAPI();






	$database=new Database();
	$db=$database->getConnection();
	$obj=new tzoombooking($db);
	$id=isset($_GET["id"])?$_GET["id"]:0;
	$flag=$obj->cancelBooking($id);

	$url=$cnf->redirectURI."/deleteMeeting.php?id=".$id;
	//print_r($url);
	$api->getAPI($url);

	echo json_encode(array("message"=>$flag));
?>