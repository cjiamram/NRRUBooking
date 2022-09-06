<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tbooking.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tbooking($db);
$building=isset($_GET["building"]) ? $_GET["building"] : "";
$bookingDate=isset($_GET["bookingDate"]) ? $_GET["bookingDate"] : "";
$sTime=isset($_GET["sTime"]) ? $_GET["sTime"] : "";
$fTime=isset($_GET["fTime"]) ? $_GET["fTime"] : "";

$stmt = $obj->displayEmptyRoom($building,$bookingDate,$sTime,$fTime);
$num = $stmt->rowCount();
if($num>0){
	$objArr=array();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$objItem=array(
			"roomNo"=>$roomNo,
			"Accessory"=>$Accessory,
			"ComputerNo"=>$ComputerNo,
			"floorNo"=>$floorNo,
			"Building"=>$Building
			
		);
		//"Status"=>"ว่าง"
		array_push($objArr, $objItem);
	}
	echo json_encode($objArr);
}else{
	echo json_encode(array("message" => False));
}

?>