<?php
	include_once "lib/classAPI.php"; 
	include_once "config/config.php";
	$api=new ClassAPI();
	$cnf=new Config();

	

	//$url="https://nrrudataservice.nrru.ac.th/NRRUBooking/troom/getBookingRoom.php";
	//$url="https://nrrudataservice.nrru.ac.th/NRRUBooking/NRRUBooking/troom/getBookingRoom.php
	$url=$cnf->restURL."troom/getBookingRoom.php";
	//print_r($url);



	//print_r($url);

	$data=$api->getAPI($url);

	print_r($data);

?>