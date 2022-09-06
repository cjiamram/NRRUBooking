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
$keyWord=isset($_GET["keyWord"]) ? $_GET["keyWord"] : "";
$stmt = $obj->getData($keyWord);
$num = $stmt->rowCount();
if($num>0){
		$objArr=array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$objItem=array(
					"id"=>$id,
					"title"=>$title,
					"firstName"=>$firstName,
					"lastName"=>$lastName,
					"department"=>$department,
					"doc"=>$doc,
					"decription"=>$decription,
					"projectName"=>$projectName,
					"telNo"=>$telNo,
					"lineNo"=>$lineNo,
					"email"=>$email,
					"budget"=>$budget,
				);
				array_push($objArr, $objItem);
			}
			echo json_encode($objArr);
}
else{
			echo json_encode(array("message" => false));
}
?>