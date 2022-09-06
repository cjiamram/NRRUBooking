<?php
header("content-type:application/json;charset=UTF-8");
include_once "../objects/tzoombooking.php";
include_once "../config/database.php";


$database=new Database();
$db=$database->getConnection();
$obj=new tzoombooking($db);
$sDate=isset($_GET["sDate"])?$_GET["sDate"]:date("Y-m-d");
$fDate=isset($_GET["fDate"])?$_GET["fDate"]:date("Y-m-d");


$stmt=$obj->sumaryDepartmentByDate($sDate,$fDate);
if($stmt->rowCount()>0){
	$objArr=array();
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$objItem=array("departmentName"=>$departmentName,
			"THr"=>floatval(number_format($THr, 2, '.', ','))
			);
		array_push($objArr,$objItem);

	}
	echo json_encode($objArr);
}else{
	echo json_encode(array("message"=>false));
}


?>