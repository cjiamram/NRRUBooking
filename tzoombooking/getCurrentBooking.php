<?php

header("content-type:application/json;charset=UTF-8");
include_once "../config/database.php";
include_once "../objects/tzoombooking.php";
include_once "../objects/manage.php";
$database=new Database();
$db=$database->getConnection();
$obj=new tzoombooking($db);
$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
$stmt=$obj->getCurrentBooking($userCode);
if($stmt->rowCount()>0){
	$objArr=array();
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$bookingDate=Format::getTextDate($bookingDate);
		$objItem=array("licenseId"=>$zoomCode,
			"bookingDate"=> $bookingDate,
			"duration"=>$startTime."-".$finishTime,
			"activity"=>$activity,
			"id"=>$id,
			"meetingId"=>$meetingId
			);

		array_push($objArr, $objItem);
		//"meetingStatus"=>$obj-
	}
	echo json_encode($objArr);
}else{
	echo json_encode(array("message"=>false));
}

?>