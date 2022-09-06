<?php
	header("content-type:text/html;charset=UTF-8");

	include_once "../config/config.php";
	include_once "../config/database.php";
	include_once "../objects/tbooking.php";

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tbooking($db);
	$bookingId=isset($_GET["bookingId"])?$_GET["bookingId"]:0;
	$stmt=$obj->getOptional($bookingId);
	if($stmt->rowCount()>0){

		$strT="<table with='100%'>\n";
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$strT.="<tr><td>".$templateOption."</td></tr>\n";
		}
		$strT.="</table>\n";
		return $strT;
	}


?>