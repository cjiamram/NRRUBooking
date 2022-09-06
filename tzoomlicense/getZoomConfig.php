<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/tzoomlicense.php";
$database=new Database();
$db=$database->getConnection();
$obj=new tzoomlicense($db);
$licenseId=isset($_GET["licenseId"])?$_GET["licenseId"]:"";
$stmt=$obj->getZoomConfig($licenseId);

if($stmt->rowCount()>0){
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	extract($row);
	$objItem=array("clientId"=>$clientId,"secretId"=>$secretId,"redirectURI"=>$redirectURI);
	echo json_encode($objItem);
}

?>