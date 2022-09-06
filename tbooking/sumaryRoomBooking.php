<?php
header("content-type:application/json;charset=UTF-8");
include_once "../config/database.php";
include_once "../objects/tbooking.php";
include_once "../objects/manage.php";

$database=new Database();
$db=$database->getConnection();
$obj=new tbooking($db);

$stmt=$obj->sumaryRoomBooking();
if($stmt->rowCount()>0){
	$objArr=array();

	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$objItem=array("bookingRoom"=>$bookingRoom,
			"THr"=>$THr,
			"color"=>Format::randColor()
		);
		array_push($objArr, $objItem);
	}
	echo json_encode($objArr);
}else
echo json_encode(array("message"=>false));

?>