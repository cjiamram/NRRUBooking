<?php
	header ("Content-Type: application/json; charset=utf-8");

	include_once "config/database.php";
	include_once "config/config.php";
	include_once "objects/tbooking.php";
	include_once "lib/nusoap.php";
	$dabase=new Database();
	$db=$database->getConnection();
	$obj=new tbooking($db);



	$yearNo=isset($_GET["yearNo"])?$_GET["yearNo"]:date('Y');
	$termNo=isset($_GET["termNo"])?$_GET["termNo"]:1;

	$sDate=isset($_GET["sDate"])?$_GET["sDate"]:date("Y-m-d");
	//$sDate=strtotime($sDate);
	//$sDate= date('Y-M-D', $sDate);
	$sDate=date_create($sDate);
	$cdate=$cdate->format('Y-m-d');

	$fDate=isset($_GET["fDate"])?$_GET["fDate"]:date("Y-m-d");
	$fDate=date_create($fDate);
	//$fDate=strtotime($fDate);
	//$fDate= date('Y-M-D', $fDate);


	$yearNo=isset($_GET["yearNo"])?$_GET["yearNo"]:"2564";
	$termNo=isset($_GET["termNo"])?$_GET["termNo"]:"2";
	$buildingCode=isset($_GET["buildingCode"])?$_GET["buildingCode"]:"029";




	$client = new nusoap_client("http://entrance.nrru.ac.th/nrruwebservice/nrruWebService_timetable.php?wsdl",true); 
	$params = array(
		'buildingcode' => $buildingCode,
		'acadyear' => $yearNo,
		'semester' => $termNo
	);
	$data = $client->call("getTime",$params); 

	$days=array("Sun"=>1,"Mon"=>2,"Tue"=>3,"Wed"=>4,"Thu"=>5,"Fri"=>6,"Sat"=>7
		);

	$periods=array(
			1=>"07:50",
			2=>"08:40",
			3=>"09:30",
			4=>"10:20",
			5=>"11:10",
			6=>"12:00",
			7=>"12:50",
			8=>"13:40",
			9=>"14:30",
			10=>"15:20",
			11=>"16:10",
			12=>"17:00",
			13=>"17:50",
			14=>"18:40",
			15=>"19:30",
			16=>"20:20",
			17=>"21:10"
		);


	
	$usageRoom = json_decode($data,true);
	$flag=true;

	$diff=date_diff($sDate,$fDate);
	$diff=intval($diff->format("%a"));
	$i=1;
	while($i<=$diff){
		//$cdate=$cdate->format('Y-m-d');
		//$cdate=date_create($cdate);
		$cdate=$cdate->format('Y-m-d');
		$timestamp = strtotime($cdate);
		$day = date('D', $timestamp);
		$indexDay=$days[$day];



		foreach ($data as $result) {
			if(($result["weekday"]===$indexDay)){
				//****Fix date operation
				$sTime=$periods(intval($result["timeperiodfrom"]));
				$fTime=$periods(intval($result["timeperiodto"]));
				if(isExist($result["roomcode"],$cdate,$sTime,$fTime)){

						$obj->bookingRoom=$result["roomcode"];
						$obj->bookingDate=$cdate;
						$obj->startTime=$sTime;
						$obj->finishTime=$fTime;
						$obj->activity=$result["coursecode"]." ".$result["coursename"];
						$flag&=$obj->registerBooking();
				}
				//****End Operation
			}
		}


		$cdate=$cdate->format('Y-m-d');
		$cdate=date_create($cdate);
		date_add($cdate,date_interval_create_from_date_string("1 days"));
		$i++;
	}
	echo json_encode(array("message"=>$flag));	

?>