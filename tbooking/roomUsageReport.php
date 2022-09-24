<?php
	header("Content-Type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tbooking.php";
	include_once "../objects/manage.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tbooking($db);

	$sDate=isset($_GET["sDate"])?$_GET["sDate"]:date("Y-m-d") ;
	$fDate=isset($_GET["fDate"])?$_GET["fDate"]:date("Y-m-d") ;
	$bookingRoom=isset($_GET["bookingRoom"])?$_GET["bookingRoom"]:"" ;
	$bookingName=isset($_GET["bookingName"])?$_GET["bookingName"]:"" ;



	$stmt=$obj->roomUsageReportCriteriaOrderDate($sDate,$fDate,$bookingRoom,$bookingName);
	if($stmt->rowCount()>0){
		$objArr=array();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$objItem=array(
					"id"=>$id,
					"BookingRoom"=>$BookingRoom,
					"BookingDate"=>Format::getTextDate($BookingDate),
					"startTime"=>$startTime,
					"finishTime"=>$finishTime,
					"HourDiff"=>$HourDiff,
					"bookingName"=>$bookingName,
					"activity"=>$activity
				);
			array_push($objArr,$objItem);
		}
		echo json_encode($objArr);
	}else{
		echo json_encode(array("message"=>false));
	}

?>