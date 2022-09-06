<?php
header("Content-Type;application/json;charset=UTF-8");
include_once "../config/database.php";
include_once "../objects/tbooking.php";
$database=new Database();
$db=$database->getConnection();
$obj=new tbooking($db);
$MxId=$obj->getLastId();
echo json_encode(array("MxId"=>$MxId));

?>