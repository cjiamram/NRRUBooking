<?php
	header("content-type:application/json;charset=UTF-8");
	include_once "../config/database.php";
	include_once "../objects/tquotaprevillage.php";

	$database=new Database();
	$db=$database->getConnection();

	$obj=new tquotaprevillage($db);
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
	$flag=$obj->deleteByUser($userCode);
	echo json_decode(array("flag"=>$flag));
?>