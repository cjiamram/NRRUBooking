<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../config/database.php";
include_once "../objects/toutsider.php";
$database = new Database();
$db = $database->getConnection();
$obj = new toutsider($db);
$data = json_decode(file_get_contents("php://input"));
$obj->id = isset($_GET['id']) ? $_GET['id'] : 0;
$stmt=$obj->readOne();
$num=$stmt->rowCount();
if($num>0){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$item = array(
			"id"=>$obj->id,
			"title" =>  $title,
			"firstName" =>  $firstName,
			"lastName" =>  $lastName,
			"department" =>  $department,
			"doc" =>  $doc,
			"decription" =>  $decription,
			"projectName" =>  $projectName,
			"telNo" =>  $telNo,
			"lineNo" =>  $lineNo,
			"email" =>  $email,
			"budget" =>  $budget
		);
}
echo(json_encode($item));
?>