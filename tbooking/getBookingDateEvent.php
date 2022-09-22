<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/tbooking.php';
include_once '../objects/manage.php';
 
$database = new Database();
$db = $database->getConnection();
 
$obj = new tbooking($db);
 
// get keywords
$bookingRoom=isset($_GET["bookingRoom"]) ? $_GET["bookingRoom"] : "27-01-01";
$currDate=isset($_GET["bDate"])?Format::getSystemDate($_GET["bDate"]):date('Y-m-d');

$stmt = $obj->getBookingEvent($currDate,$bookingRoom);
$num = $stmt->rowCount();

if($num>0){
    $objArr=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        
		$d = date_parse_from_format("Y-m-d", $bookingDate);
		$bookingDate= $d["year"]."-".$obj->getFormat($d["month"])."-".$obj->getFormat($d["day"]);
		$sDate=$bookingDate."T".$startTime.":00";
		$fDate=$bookingDate."T".$finishTime.":00";
        $objItem=array(
        	"id"=>$id,
        	"title"=>$activity,
        	"start"=>$sDate,
        	"end"=>$fDate,
        	"color"=>$obj->randColor()
        );
        array_push($objArr, $objItem);
    }
    echo json_encode($objArr);


  }
 
   


?>