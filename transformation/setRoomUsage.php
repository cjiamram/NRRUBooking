<?php
	header ("Content-Type: application/json; charset=utf-8");

	include_once "../config/database.php";
	include_once "../config/config.php";
	include_once "../objects/tbooking.php";
	include_once "../lib/classAPI.php";

	$yearNo=isset($_GET["yearNo"])?$_GET["yearNo"]:"2564";
	$termNo=isset($_GET["termNo"])?$_GET["termNo"]:"2";
	$buildingCode=isset($_GET["buildingCode"])?$_GET["buildingCode"]:"029";

	$cnf=new Config();

	$url="http://nrruapp.nrru.ac.th/NRRUBooking/transformation/getRoomUsage.php?yearNo=".$yearNo."&termNo=".$termNo."&buildingCode=".$buildingCode;
	


	$api=new ClassAPI();
	$usageRoom=$api->getAPI($url);

	$database=new Database();
	$db=$database->getConnection();
	$obj=new tbooking($db);

	$sDate=isset($_GET["sDate"])?$_GET["sDate"]:date("Y-m-d");
	$sDate=date_create($sDate);
	$cdate=$sDate;
	$cdate=$cdate->format('Y-m-d');

	$fDate=isset($_GET["fDate"])?$_GET["fDate"]:date("Y-m-d");
	$fDate=date_create($fDate);


	$days=array("Sun"=>1,"Mon"=>2,"Tue"=>3,"Wed"=>4,"Thu"=>5,"Fri"=>6,"Sat"=>7
		);

	$periods=[
			"07:50",
			"08:40",
			"09:30",
			"10:20",
			"11:10",
			"12:00",
			"12:50",
			"13:40",
			"14:30",
			"15:20",
			"16:10",
			"17:00",
			"17:50",
			"18:40",
			"19:30",
			"20:20",
			"21:10"
		];


	
	
	$flag=true;

	$diff=date_diff($sDate,$fDate);
	$diff=intval($diff->format("%a"));
	$i=1;
	while($i<=$diff){
		
		print_r($i);
		$timestamp = strtotime($cdate);
		$day = date('D', $timestamp);
		$indexDay=$days[$day];

		foreach ($usageRoom as $result) {
			//print_r("week day ".$result["weekday"]."\n");
			if((intval($result["weekday"])===intval($indexDay))){
				print_r($cdate);
				$sTime=$periods[$result["timeperiodto"]];
				$fTime=$periods[$result["timeperiodfrom"]];
				$flag1=$obj->isExist($result["roomcode"],$cdate,$sTime,$fTime);
				if($flag1==false){
						$obj->bookingRoom=$result["roomcode"];
						$obj->bookingDate=$cdate;
						$obj->startTime=$sTime;
						$obj->finishTime=$fTime;
						$obj->activity=$result["coursecode"]." ".$result["coursename"];
						$flag&=$obj->registerBooking();
						//print_r("XXXX");
				}
				
			}
		}

		$cdate=date_create($cdate);
		date_add($cdate,date_interval_create_from_date_string("1 days"));
		$cdate=$cdate->format('Y-m-d');

		$i++;
	}
	echo json_encode(array("message"=>$flag));	

?>