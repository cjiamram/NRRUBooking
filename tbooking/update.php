<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,
	Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tbooking.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tbooking($db);
$data = json_decode(file_get_contents("php://input"));
$obj->bookingRoom = $data->bookingRoom;
$obj->bookingDate = $data->bookingDate;
$obj->startTime = $data->startTime;
$obj->finishTime = $data->finishTime;
$obj->bookingName = $data->bookingName;
$obj->staffId = $data->staffId;
$obj->status = $data->status;
$obj->activity = $data->activity;
$obj->lineNo = $data->lineNo;
$obj->telNo = $data->telNo;

$obj->id = $data->id;
if($obj->update()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>