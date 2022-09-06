<?php
header("Content-Type;application/json;charset=UTF-8");
include_once "../config/database.php";
include_once "../objects/tzoombooking.php";
$database=new Database();
$db=$database->getConnection();
$obj=new tzoombooking($db);

$MxId=$obj->getLastId();
echo json_encode(array("MxId"=>$MxId));

?>