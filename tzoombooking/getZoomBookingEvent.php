<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/tzoombooking.php';
include_once '../objects/tzoomlicense.php';
include_once '../objects/manage.php';
 
$database = new Database();
$db = $database->getConnection();
$obj = new tzoombooking($db);
$objLicense=new tzoomlicense($db);
 
$zoomCode=isset($_GET["zoomCode"]) ? $_GET["zoomCode"] : "";
$currDate=date('Y-m-d H:i:s');


$stmt = $obj->getZoomBookingEvent($currDate,$zoomCode);
$num = $stmt->rowCount();

if($num>0){
    $objArr=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
		$bookingDate=Format::getSystemDate($bookingDate);
		$sDate=$bookingDate."T".$startTime.":00";
		$fDate=$bookingDate."T".$finishTime.":00";
        $color=$objLicense->getColor($zoomCode);
        $objItem=array(
        	"id"=>$id,
        	"title"=>$activity.' จองโดย:'.$bookingName.' Zoom No:'.$zoomCode,
        	"start"=>$sDate,
        	"end"=>$fDate,
        	"color"=>$color
        );
        array_push($objArr, $objItem);
    }
    echo json_encode($objArr);
  }
 
   


?>