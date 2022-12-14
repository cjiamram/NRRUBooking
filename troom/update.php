<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/troom.php";
$database = new Database();
$db = $database->getConnection();
$obj = new troom($db);
$data = json_decode(file_get_contents("php://input"));
$obj->RoomNo = $data->RoomNo;
$obj->ComputerNo = $data->ComputerNo;
$obj->DeskNo = $data->DeskNo;
$obj->Accessory = $data->Accessory;
$obj->Status = 0;
$obj->FloorNo = $data->FloorNo;
$obj->Building = $data->Building;
$obj->Status = 0;
$obj->id = $data->id;
if($obj->update()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>