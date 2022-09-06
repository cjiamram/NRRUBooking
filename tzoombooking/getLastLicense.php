<?php
header("Content-Type;application/json;charset=UTF-8");
include_once "../config/database.php";
include_once "../objects/tzoombooking.php";
$database=new Database();
$db=$database->getConnection();
$obj=new tzoombooking($db);
$id=isset($_GET["id"])?$_GET["id"]:0;
$zoomCode=$obj->getLastLicense($id);
echo json_encode(array("zoomCode"=>$zoomCode));

?>