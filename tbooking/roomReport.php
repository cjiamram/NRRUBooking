<?php
 header("content-type:application/json;charset=UTF-8");
 include_once "../config/database.php";
 include_once "../objects/tbooking.php";
 $database=new Database();
 $db=$database->getConnection();
 $obj=new tbooking($db);
 $sDate=isset($_GET["sDate"])?$_GET["sDate"]:date('Y/m/d');
 $fDate=isset($_GET["fDate"])?$_GET["fDate"]:date('Y/m/d');
 $rType=isset($_GET["rType"])?$_GET["rType"]:1;

 switch($rType){

 	case 1://dayRoomReport for line chart
 		{
 			$stmt=	$obj->dayRoomReport($sDate,$fDate,$bookingRoom);
 			if($stmt->rowCount()>0){
 				$objArr=array();
 				while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
 					extract($row);
 					
 					$objItem=array(
 						"Label"=>$BookingDate,
 						"y"=>$SHour
 					);
 					array_push($objArr,$objItem);
 				} 
 				echo json_encode($objArr);
 			}
 			else
 				echo json_encode(array("message"=>false));
 		}
 		break;
 	case 2://monthRoomReport for pie chart
 		{
 			$stmt=	$obj->monthRoomReport($sDate,$fDate);
 			if($stmt->rowCount()>0){
 				$objArr=array();
 				
 				while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
 					extract($row);
 	
 					$objItem=array(
 						"BookingRoom"=>$BookingRoom,
 						"SHour"=>$SHour
 					);
 					array_push($objArr,$objItem);
 				} 
 				echo json_encode($objArr);
 			}
 			else
 				echo json_encode(array("message"=>false));
 		}
 		break;
 } 


?>