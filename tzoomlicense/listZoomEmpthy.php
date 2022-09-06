<?php

header("content-type:application/json;charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/tzoombooking.php";

$database=new Database();
$db=$database->getConnection();
$obj=new tzoombooking($db);
$zoomCode=isset($_GET["zoomCode"])?$_GET["zoomCode"]:"";
$bookingDate=isset($_GET["bookingDate"])?$_GET["bookingDate"]:"";
$sTime=isset($_GET["sTime"])?$_GET["sTime"]:"";
$fTime=isset($_GET["fTime"])?$_GET["fTime"]:"";

$stmt=$obj->listZoomBooking($zoomCode,$bookingDate,$sTime,$fTime);

if($stmt->rowCount()>0){
	$objArr=array();
	while($row->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$objItem=array("zoomCode"=>$zoomCode);
		array_push($objArr, $objItem);

	}
	echo json_encode($objArr);
}else{
	echo json_encode(array("message"=>false));
}




?>