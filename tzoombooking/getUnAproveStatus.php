<?php
header("content-type:application/json;charset=UTF8");
include_once "../config/database.php";
include_once "../objects/tzoombooking.php";
include_once "../objects/manage.php";


$database=new Database();
$db=$database->getConnection();
$obj=new tzoombooking($db);
$keyWord=isset($_GET["keyWord"])?$_GET["keyWord"]:"";
$stmt=$obj->getUnAproveStatus($keyWord);
if($stmt->rowCount()>0){
	$objArr=array();
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$objItem=array(
			"id"=>$id,
			"licenseId"=>$zoomCode,
			"bookingDate"=> Format::getTextDate($bookingDate),
			"duration"=>$startTime."-".$finishTime,
			"bookingName"=>$bookingName,
			"contact"=>"Tel:".$telNo." Line No:".$lineNo,
			"activity"=>$activity
			);
		array_push($objArr, $objItem);

	}
	echo json_encode($objArr);
}else{
	echo json_encode(array("message"=>false));
}


?>