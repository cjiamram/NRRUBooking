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
$cDate=date("Y-m-d");
$bookingDate=isset($_GET['bookingDate']) ? $_GET['bookingDate'] : $cDate;
$finishDate=isset($_GET['finishDate']) ? $_GET['finishDate'] : $cDate;
$sTime=isset($_GET['sTime']) ? $_GET['sTime'] : "00:00";
$fTime=isset($_GET['fTime']) ? $_GET['fTime'] : "00:00";
//	public function isExistByDuration($zoomCode,$bookingDate,$finishDate,$sTime,$fTime){

$flag=$obj->isExistByDuration($zoomCode,$bookingDate,$finishDate,$sTime,$fTime);
$item = array(
		"flag"=>$flag
);
echo(json_encode($item));

?>