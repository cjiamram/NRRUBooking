<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
	include_once "../config/database.php";
	include_once "../objects/tquotaprevillage.php";
	$database = new Database();
	$db = $database->getConnection();
	$obj = new tquotaprevillage($db);
	$userCode=isset($_GET["userCode"]) ? $_GET["userCode"] : "";

	$stmt=$obj->getQuota($userCode);

	if($stmt->rowCount()>0){

		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$objItem=array("quota"=>intval($quota),"duration"=>intval($duration));
		echo json_encode($objItem);
		
	}
	else
	
	echo json_encode(array("quota"=>3,"duration"=>7));

	
?>