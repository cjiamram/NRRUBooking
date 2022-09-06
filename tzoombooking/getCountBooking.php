<?php
include_once "../config/database.php";
include_once "../objects/tzoombooking.php";

$database=new Database();
$db=$database->getConnection();
$obj=new tzoombooking($db);

$stmt=$obj->getCountBooking();
if($stmt->rowCount()>0){
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	extract($row);
	$objItem=array("CNT"=>$CNT,"THr"=>$THr);
	echo json_encode($objItem);
}else
{
	$objItem=array("message"=>false);
	echo json_encode($objItem);
}

?>