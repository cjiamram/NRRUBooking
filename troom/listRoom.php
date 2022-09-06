<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/troom.php';
 
$database = new Database();
$db = $database->getConnection();
 
$obj = new troom($db);

$building=isset($_GET["building"])?$_GET["building"]:"";
$stmt = $obj->listRoom($building);
$num = $stmt->rowCount();
 
if($num>0){
 
    $arr=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $item=array(
            "id" => $id,
            "RoomNo" => $RoomNo,
            "RoomName"=>$RoomNo
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