<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tbooking.php";
include_once "../objects/troom.php";
$database = new Database();
$db = $database->getConnection();
$obj = new troom($db);
$obj1=new tbooking($db);
$building=isset($_GET["building"]) ? $_GET["building"] : "";
$floorNo=isset($_GET["floorNo"]) ? $_GET["floorNo"] : "";
$stmt = $obj->getRoomFloor($building,$floorNo);
$num = $stmt->rowCount();
if($num>0){
		$objArr=array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$data=$obj1->getStatus($RoomNo);
				if($data["flag"]!=0){
					$d = date_parse_from_format("Y-m-d", $data["bookingDate"]);

					$bookingDate= sprintf('%02s',$d["day"])."-".sprintf('%02s',$d["month"])."-".$d["year"];

				}
				else
				{
					$bookingDate="";
				}
				$objItem=array(
					"RoomNo"=>$RoomNo,
					"ComputerNo"=>$ComputerNo,
					"Accessory"=>$Accessory,
					"FloorNo"=>$FloorNo,
					"Status"=>$data["status"],
					"BookingDate"=>$bookingDate,
					"BookingTime"=>$data["bookingTime"],
					"Activity"=>$data["activity"],
					"BookingName"=>$data["bookingName"],
					"Flag"=>$data["flag"]
				);
				array_push($objArr, $objItem);
			}
			echo json_encode($objArr);
}
else{
			echo json_encode(array("message" => false));
}
?>