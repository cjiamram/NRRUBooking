<?php
header("content-type:application/json;charset=UTF-8");
include_once "../config/database.php";
include_once "../objects/tzoombooking.php";
include_once "../objects/tzoomlicense.php";
//getCountLicense
$database=new Database();
$db=$database->getConnection();
$obj=new tzoombooking($db);
$objLicense=new tzoomlicense($db);

$stmt=$obj->sumaryZoomBooking();
if($stmt->rowCount()>0){
	$objArr=array();

	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$cnt=$objLicense->getCountLicense($typeCode);
		$objItem=array("licenseType"=>$licenseType,
			"typeCode"=>$typeCode,
			"THr"=>$THr,
			"AVGHr"=>$THr/$cnt
		);
		array_push($objArr, $objItem);
	}
	echo json_encode($objArr);
}else
echo json_encode(array("message"=>false));

?>