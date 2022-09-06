<?php
header("content-type:application/json;charset=UTF-8");
include_once "../objects/tzoombooking.php";
include_once "../config/database.php";
include_once "../config/config.php";

$database=new Database();
$db=$database->getConnection();
$obj=new tzoombooking($db);
$bDate=isset($_GET["bDate"])?$_GET["bDate"]:date("Y-m-d");
$dateRange=$obj-> getDateRange($bDate);
echo json_encode(array("range"=>$dateRange));

?>