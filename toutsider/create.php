<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/toutsider.php";
$database = new Database();
$db = $database->getConnection();
$obj = new toutsider($db);
$data = json_decode(file_get_contents("php://input"));
$obj->title = $data->title;
$obj->firstName = $data->firstName;
$obj->lastName = $data->lastName;
$obj->department = $data->department;
$obj->doc = $data->doc;
$obj->decription = $data->decription;
$obj->projectName = $data->projectName;
$obj->telNo = $data->telNo;
$obj->lineNo = $data->lineNo;
$obj->email = $data->email;
$obj->budget = $data->budget;
$obj->budget1= $data->budget1;
if($obj->create()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>