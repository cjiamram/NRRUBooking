<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/troom.php';
include_once '../objects/tbooking.php';
include_once '../objects/manage.php';
 
$database = new Database();
$db = $database->getConnection();
 
$obj = new troom($db);
$objBooking=new tbooking($db);

$building=isset($_GET["building"])?$_GET["building"]:"";
$sDate=isset($_GET["sDate"])?$_GET["sDate"]:date('Y/m/d');
$fDate=isset($_GET["fDate"])?$_GET["fDate"]:date('Y/m/d');
$stmt = $obj->listRoom($building);
$num = $stmt->rowCount();
 
if($num>0){
    $objArr=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $stmtBk=$objBooking->dayRoomReport($sDate,$fDate,$RoomNo);
        $objArrBk=[];
        if($stmtBk->rowCount()>0){
        	while($rowBk=$stmtBk->fetch(PDO::FETCH_ASSOC)){
        		extract($rowBk);
        		$objItemBk=array(
        			"label"=>Format::getSystemDate($BookingDate),
        			"y"=>intval($SHour)
        		);
        		array_push($objArrBk,$objItemBk);	
        	}

			$objItem=array(
					"type"=>"spline",
					"visible"=>true,
					"showInLegend"=>true,
					"yValueFormatString"=> "## ชม.",
					"name"=> $RoomNo,
					"dataPoints"=>$objArrBk
			);
			array_push($objArr, $objItem);


        }

        //print_r($objArrBk);
    }
 
    echo json_encode($objArr);
}
 
else{
    echo json_encode(
        array("message" => false)
    );
}

?>