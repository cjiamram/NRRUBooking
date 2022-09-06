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
$zoomCode = isset($_GET['zoomCode']) ? $_GET['zoomCode'] : "";
$bookingDate=isset($_GET['bookingDate']) ? $_GET['bookingDate'] : "";
$sTime=isset($_GET['sTime']) ? $_GET['sTime'] : "";
$fTime=isset($_GET['fTime']) ? $_GET['fTime'] : "";
$flag=$obj->isExist($zoomCode,$bookingDate,$sTime,$fTime);
$item = array(
		"flag"=>$flag
);
echo(json_encode($item));

?>