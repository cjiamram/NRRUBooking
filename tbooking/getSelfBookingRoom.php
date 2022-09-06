<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../config/config.php";
	include_once "../objects/tbooking.php";
	include_once "../objects/manage.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tbooking($db);

	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";

	$stmt=$obj->getSelfBookingRoom($userCode);
	if($stmt->rowCount()>0){

		$objArr=array();

		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$bookingDate=Format::getTextDate($bookingDate)." ".$startTime."-".$finishTime;
			$objItem=array(
					"id"=>$id,
					"bookingRoom"=>$bookingRoom,
					"bookingDate"=>$bookingDate,
					"activity"=>$activity
				);

			array_push($objArr, $objItem);

		}

		echo json_encode($objArr);
	}else{
		echo json_encode(array("message"=>false));
	}

?>