

<?php
	header("content-type:application/json;charset=utf-8");
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	$cnf=new Config();
	$id=isset($_GET["id"])?$_GET["id"]:112;
	$url=$cnf->restURL."tbooking/getBookingNotify.php?id=".$id;
	$api=new ClassAPI();
	$data=$api->getAPI($url);

	$sText="";
	if($data!=""){

		$option="";
		$i=1;
		foreach ($data["optionals"] as $row) {
			$option.=($i++). ":".$row["templateOption"]." ".$row["description"]." จำนวน:".$row["quantity"]."\n";
		}

		$sText.="ผู้จอง :".$data["BookingName"]."\n";
		$sText.="ห้อง :".$data["BookingRoom"]."\n";
		$sText.="วันที่ :".$data["BookingDate"]."\n";
		$sText.="กิจกรรม :".$data["Activity"]."\n";
		$sText.=$option;


	}
	echo json_encode(array("message"=>$sText));
?>