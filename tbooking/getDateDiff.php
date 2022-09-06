<?php
	header("Content-Type: application/json; charset=UTF-8");

	$bookingDate=isset($_GET["bookingDate"])?$_GET["bookingDate"]:"";
	//print_r($bookingDate);
	$pieces = explode("-", $bookingDate);
	//print_r($pieces);
	$bookingDate=$pieces[2]."-".$pieces[1]."-".$pieces[0];
	//print_r($bookingDate);
	$date2=date_create($bookingDate);
	//print_r($date2);
	

	$currentDate=date("Y-m-d");
	$pieces = explode("-", $currentDate);
	$currentDate=$pieces[2]."-".$pieces[1]."-".$pieces[0];
	$date1=date_create($currentDate);

	$diff=date_diff($date1,$date2);
	//print_r($diff);
	echo json_encode(array("dayRange"=>$diff->days));
?>