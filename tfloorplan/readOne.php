<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,
	Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tfloorplan.php";
$database = new Database();
$db = $database->getConnection();
$obj = new tfloorplan($db);
$data = json_decode(file_get_contents("php://input"));
$obj->id = isset($_GET['id']) ? $_GET['id'] : 0
$obj->readOne();
$item = array(
		"id"=>$obj->id,
		"buildingNo" =>  $obj->buildingNo,
		"floorNo" =>  $obj->floorNo,
		"floorPlan" =>  $obj->floorPlan
);
echo(json_encode($item));
?>