<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/tzoomlicense.php";
include_once "../config/config.php";
$cnf=new Config();
$database = new Database();
$db = $database->getConnection();
$obj = new tzoomlicense($db);
$data = json_decode(file_get_contents("php://input"));
$callbackURI=$cnf->redirectURI."/callback.php?licenseId=".$data->zoomCode."&uriType=2";

$obj->zoomCode = $data->zoomCode;
$obj->zoomDetail = $data->zoomDetail;
$obj->clientId=$data->clientId;
$obj->secretId=$data->secretId;
$obj->redirectURI=$callbackURI;
if($obj->create()){
		echo json_encode(array('message'=>true));
}
else{
		echo json_encode(array('message'=>false));
}
?>