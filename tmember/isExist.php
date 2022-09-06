<?php
  	header("Content-Type:application/json;charset=UTF-8");
  	include_once "../config/database.php";
  	include_once "../objects/tmember.php";

  	$database=new Database();
  	$db=$database->getConnection();
  	$obj=new tmember($db);
  	$firstName=isset($_GET["firstName"])?$_GET["firstName"]:"";
  	$lastName=isset($_GET["lastName"])?$_GET["lastName"]:"";

  	$flag=$obj->isExist($firstName,$lastName);
  	echo json_encode(array("flag"=>$flag));
?>