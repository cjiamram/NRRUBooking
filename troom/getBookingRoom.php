<?php
header("content-type:application/json;charset=UTF-8");
include_once ("../objects/troom.php");
include_once("../config/database.php");

$database=new Database();
$db=$database->getConnection();
$obj=new troom($db);

$stmt=$obj->getBookingRoom($db);

if($stmt->rowCount()>0){
	$objArr=array();
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$objItem=array("id"=>$id,
				"RoomNo"=>$RoomNo,
				"Description"=>$Accessory,
				"DeskNo"=>$DeskNo,
				"ComputerNo"=>$ComputerNo,
				"Status"=>$Status,
				"FloorNo"=>$FloorNo,
				"Building"=>$Building,
				"picture"=>$picture,
				"plan"=>$plan,
				"pano"=>$pano
				);
		array_push($objArr, $objItem);
	}
	echo json_encode($objArr);
}else{
	echo json_encode(array("message"=>false));
}

?>