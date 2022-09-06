

<?php
	header("content-type:application/json;charset=utf-8");
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	$cnf=new Config();
	$id=isset($_GET["id"])?$_GET["id"]:112;
	$url=$cnf->restURL."tzoombooking/getZoomBookingNotify.php?id=".$id;
	$api=new ClassAPI();
	$data=$api->getAPI($url);

	$sText="";
	if($data!=""){

	
		

		$sText.="ผู้จอง :".$data["BookingName"]."\n";
		$sText.="Zoom Code :".$data["ZoomCode"]."\n";
		$sText.="วันที่ :".$data["BookingDate"]."\n";
		$sText.="กิจกรรม :".$data["Activity"]."\n";
		$sText.=$cnf->forwordURI;


	}
	echo json_encode(array("message"=>$sText));
?>