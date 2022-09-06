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
$obj->bookingDate = $data->bookingDate;
$obj->startTime = $data->startTime;
$obj->finishTime = $data->finishTime;
$obj->bookingName = $data->bookingName;
$obj->staffId = $data->staffId;
$obj->status = $data->status;
$obj->activity = $data->activity;
$obj->telNo = $data->telNo;
$obj->lineNo = $data->lineNo;
$obj->aproveStatus = $data->aproveStatus;
$obj->outsiderId = $data->outsiderId;
$obj->objective=$data->objective;
$obj->departmentId=$data->departmentId;
$obj->finishDate=$data->finishDate;
$obj->timeDuration=$data->timeDuration;



if($obj->create()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>