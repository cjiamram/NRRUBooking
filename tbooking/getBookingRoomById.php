<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../config/config.php";
	include_once "../objects/tbooking.php";
	include_once "../objects/manage.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tbooking($db);

	$id=isset($_GET["id"])?$_GET["id"]:0;

	$stmt=$obj->getBookingRoomById($id);

	if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			$bookingDate=Format::getTextDate($bookingDate)." ".$startTime."-".$finishTime;
			$objItem=array(
					"id"=>$id,
					"bookingRoom"=>$bookingRoom,
					"bookingDate"=>$bookingDate,
					"activity"=>$activity
				);

			echo json_encode($objItem);
	}else{
		echo json_encode(array("message"=>false));
	}
	


	

?>