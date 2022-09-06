<?php
header("content-type:application/json;charset=UTF-8");
include_once "../config/database.php";
include_once "../objects/tzoombooking.php";


$database=new Database();
$db=$database->getConnection();
$obj=new tzoombooking($db);
$cDate=date("Y-m-d");
$sDate=isset($_GET["sDate"])?$_GET["sDate"]:$cDate;
$fDate=isset($_GET["fDate"])?$_GET["fDate"]:$cDate;


$data=$obj->getLicenseUsageByDate($sDate,$fDate);
echo json_encode($data);



?>
