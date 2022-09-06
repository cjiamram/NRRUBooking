<?php
header("content-type:application/json;charset=UTF-8");
include_once "../config/database.php";
include_once "../objects/tzoombooking.php";

$database=new Database();
$db=$database->getConnection();

$cDate=date("Y-m-d");
$sDate=isset($_GET["sDate"])?$_GET["sDate"]:$cDate;
$sTime=isset($_GET["sTime"])?$_GET["sTime"].":00":"00:00:00";
$duration=isset($_GET["duration"])?$_GET["duration"]:0;

$sDate=$sDate." ".$sTime;




$obj=new tzoombooking($db);
echo json_encode($obj->getDurationDateTime($sDate,$duration*60));


?>