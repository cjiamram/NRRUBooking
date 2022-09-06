<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tbooking.php";
	include_once "../objects/manage.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tbooking($db);
	$id=isset($_GET["id"])?$_GET["id"]:0;

	$stmt=$obj->getBookingNotify($id);
	$objArr=array();
	$stmt1=$obj->getBookingDetail($id);

	if($stmt1->rowCount()>0){
		while($row1=$stmt1->fetch(PDO::FETCH_ASSOC)){
			extract($row1);
			$objItem=array(
				"templateOption"=>$templateOption,
				"description"=>$description,
				"quantity"=>$quantity
				);
			array_push($objArr,$objItem);
		}
	} 


	if($stmt->rowCount()>0){
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$objItem=array("id"=>$id,
				"BookingName"=>$BookingName,
				"BookingRoom"=>$BookingRoom,
				"BookingDate"=>Format::getTextDate($BookingDate)." เวลา ".$startTime."-".$finishTime,
				"Activity"=>$Activity,
				"optionals"=>$objArr
			);
		echo json_encode($objItem);

	}else{
		echo json_encode(array("message"=>false));
	}



?>