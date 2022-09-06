<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tzoombooking.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tzoombooking($db);
$data = json_decode(file_get_contents("php://input"));
$obj->zoomCode = $data->zoomCode;
$obj->bookingDate = $data->bookingDate;
$obj->startTime = $data->startTime;
$obj->finishTime = $data->finishTime;
$obj->bookingName = $data->bookingName;
$obj->staffId = $data->staffId;
$obj->status = $data->status;
$obj->activity = $data->activity;
$obj->telNo = $data->telNo;
$obj->lineNo = $data->lineNo;
$obj->aproveStatus = 1;
$obj->outsiderId = $data->outsiderId;
$obj->finishDate = $data->finishDate;
$obj->timeDuration = $data->timeDuration;

$data=$obj->createByAdminWithLastId();
if($data["flag"]===true){
		echo json_encode(array('message'=>true,"id"=>$data["lastId"]));
}
else{
		echo json_encode(array('message'=>false));
}
?>