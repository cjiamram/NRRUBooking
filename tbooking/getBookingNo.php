<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tbooking.php";

	$database=new Database();
	$db=$database->getConnection();

	$obj=new tbooking($db);
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
	$bookingNo=$obj->getBookingNo($userCode);


	echo json_encode(array("bookingNo"=>$bookingNo));


?>