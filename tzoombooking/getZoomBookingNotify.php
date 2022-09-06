<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tzoombooking.php";
	include_once "../objects/manage.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tzoombooking($db);
	$id=isset($_GET["id"])?$_GET["id"]:0;

	$stmt=$obj->getZoomBookingNotify($id);
	if($stmt->rowCount()>0){
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$objItem=array("id"=>$id,
				"BookingName"=>$bookingName,
				"ZoomCode"=>$zoomCode,
				"BookingDate"=>Format::getTextDate($bookingDate)." เวลา ".$startTime."-".$finishTime,
				"Activity"=>$activity
			);
		echo json_encode($objItem);

	}



?>