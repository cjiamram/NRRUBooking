<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../objects/tbooking.php";
	include_once "../config/config.php";
	include_once "../config/database.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tbooking($db);

	/*$obj->bookingRoom="27.01.01";
	$obj->bookingDate=date("Y-m-d");
	$obj->startTime="09:00";
	$obj->finishTime="12:00";
	$obj->activity="T";
	$flag=$obj->registerBooking();

	echo json_encode(array("flag"=>$flag));*/


	$flag=$obj->isExist("27.01.01","2022-04-28","09:00","12:00");
	echo json_encode(array("flag"=>$flag));

?>