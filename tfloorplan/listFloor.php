<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/tfloorplan.php';
 
$database = new Database();
$db = $database->getConnection();
 
$obj = new tfloorplan($db);
$buildingNo=isset($_GET["buildingNo"])?$_GET["buildingNo"]:"";
$stmt = $obj->listFloor($buildingNo);
$num = $stmt->rowCount();
 
if($num>0){
 
    $arr=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $item=array(
            "id" => $id,
            "floorNo" => $floorNo,
            "floorName"=>$floorNo
        );
        array_push($arr, $item);
    }
 
    echo json_encode($arr);
}
 
else{
    echo json_encode(
        array("message" => false)
    );
}
?>