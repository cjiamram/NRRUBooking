<?php
class tbooking{
	private $conn;
	private $table_name;
	public function __construct($db){
            $this->conn = $db;
        	}
	public $bookingRoom;
	public $bookingDate;
	public $startTime;
	public $finishTime;
	public $bookingName;
	public $staffId;
	public $status;
	public $activity;
	public $lineNo;
	public $telNo;
	public $outsiderId;

	public function sumaryRoomBooking(){
		$query="SELECT bookingRoom,
		SUM(HOUR(TIMEDIFF(finishTime,startTime))) AS THr 
		FROM t_booking
		GROUP BY bookingRoom";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	


	public function getCountBooking(){
		$query="SELECT 
		COUNT(id) AS CNT,
		SUM(HOUR(TIMEDIFF(finishTime,startTime))) AS THr 
		FROM t_booking 
		";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}


	public function getBookingNotify($id){
		$query="SELECT 
			id,
			BookingName,
			BookingRoom,
			BookingDate,
			startTime,
			finishTime,
			Activity 
		FROM t_booking 
		WHERE id=:id 
		";

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":id",$id);
		$stmt->execute();
		return $stmt;
	}

	public function getBookingDetail($id){
		$query="SELECT 
			A.id,
			B.templateOption,
			A.description,
			A.quantity  
		FROM t_optional A INNER JOIN 
			t_template B 
		ON A.template=B.code
		WHERE A.bookingId=:id
		";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":id",$id);
		$stmt->execute();
		return $stmt;
	}


	public function dayRoomReport($sDate,$fDate,$bookingRoom){
		$query="SELECT 
		BookingDate,
		SUM(HourDiff) AS SHour
		FROM
			(
					SELECT 
					A.BookingDate,
					HOUR(TIMEDIFF(A.finishTime, A.startTime)) AS HourDiff

					FROM t_booking A LEFT OUTER JOIN t_room B
					ON A.BookingRoom=B.RoomNo
					WHERE A.BookingDate BETWEEN :sDate AND :fDate
					AND 
					A.BookingRoom LIKE :bookingRoom
			)  AS V 
			GROUP BY BookingDate
			ORDER BY BookingDate

		";


		$d = date_parse_from_format("Y-m-d", $sDate);
		$startDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);

		$d = date_parse_from_format("Y-m-d", $fDate);
		$finishDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":sDate",$startDate);
		$stmt->bindParam(":fDate",$finishDate);
		$bookingRoom="%{$bookingRoom}%";
		$stmt->bindParam(":bookingRoom",$bookingRoom);
		$stmt->execute();
		return $stmt;	

	}
	
	public function monthRoomReport($sDate,$fDate){
		$query="SELECT 
		BookingRoom,
		SUM(HourDiff) AS SHour
		FROM
			(
					 
					 SELECT 
						A.BookingRoom,
						HOUR(TIMEDIFF(A.finishTime, A.startTime)) AS HourDiff
						
					FROM t_booking A LEFT OUTER JOIN t_room B
					ON A.BookingRoom=B.RoomNo
					WHERE A.BookingDate BETWEEN :sDate AND :fDate
					

			)  AS V GROUP BY BookingRoom";


		$d = date_parse_from_format("Y-m-d", $sDate);
		$startDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);

		$d = date_parse_from_format("Y-m-d", $fDate);
		$finishDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":sDate",$startDate);
		$stmt->bindParam(":fDate",$finishDate);
		$stmt->execute();
		return $stmt;
	}

	public function roomUsageReportOrderDate($sDate,$fDate){
		$query="SELECT
			A.id, 
			A.BookingRoom,
			A.BookingDate,
			A.startTime,
			A.finishTime,
			A.activity,
			B.FloorNo,
			YEAR(A.BookingDate) AS YY,
			MONTH(A.BookingDate) AS MM,
			HOUR(TIMEDIFF(A.finishTime, A.startTime)) AS HourDiff,
			A.bookingName
		FROM t_booking A LEFT OUTER JOIN
		t_room B ON A.BookingRoom=B.RoomNo
		WHERE A.BookingDate 
		BETWEEN 
		:sDate AND :fDate
		ORDER BY A.BookingDate DESC
		";

		$d = date_parse_from_format("Y-m-d", $sDate);
		$startDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);

		$d = date_parse_from_format("Y-m-d", $fDate);
		$finishDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":sDate",$startDate);
		$stmt->bindParam(":fDate",$finishDate);
		$stmt->execute();
		return $stmt;
	}


	public function roomUsageReportCriteriaOrderDate($sDate,$fDate,$bookingRoom,$bookingName){
		$query="SELECT
					A.id, 
					A.BookingRoom,
					A.BookingDate,
					A.startTime,
					A.finishTime,
					A.activity,
					B.FloorNo,
					YEAR(A.BookingDate) AS YY,
					MONTH(A.BookingDate) AS MM,
					HOUR(TIMEDIFF(A.finishTime, A.startTime)) AS HourDiff,
					A.bookingName
				FROM t_booking A LEFT OUTER JOIN
				t_room B ON A.BookingRoom=B.RoomNo
				WHERE (A.BookingDate 
				BETWEEN 
				:sDate AND :fDate) AND 
				(A.bookingName LIKE :bookingName AND 
				A.bookingName<>'Register System') AND 
				A.BookingRoom LIKE :bookingRoom  
				ORDER BY A.BookingDate

				";

		$d = date_parse_from_format("Y-m-d", $sDate);
		$startDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);

		$d = date_parse_from_format("Y-m-d", $fDate);
		$finishDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":sDate",$startDate);
		$stmt->bindParam(":fDate",$finishDate);
		$bookingRoom="%{$bookingRoom}%";
		$bookingName="%{$bookingName}%";

		$stmt->bindParam(":bookingRoom",$bookingRoom);
		$stmt->bindParam(":bookingName",$bookingName);

		$stmt->execute();
		return $stmt;
	}


	public function roomUsageReportCriteriaIsRegOrderDate($sDate,$fDate,$bookingRoom,$activity){
		$query="SELECT * FROM (SELECT
					A.id, 
					A.BookingRoom,
					A.BookingDate,
					A.startTime,
					A.finishTime,
					A.activity,
					B.FloorNo,
					YEAR(A.BookingDate) AS YY,
					MONTH(A.BookingDate) AS MM,
					HOUR(TIMEDIFF(A.finishTime, A.startTime)) AS HourDiff,
					A.bookingName
				FROM t_booking A LEFT OUTER JOIN
				t_room B ON A.BookingRoom=B.RoomNo
				WHERE (A.BookingDate 
				BETWEEN 
				:sDate AND :fDate) AND 
				A.bookingName LIKE :bookingName AND 
				A.bookingName='Register System'
				ORDER BY A.BookingDate

				)  AS V";

		$d = date_parse_from_format("Y-m-d", $sDate);
		$startDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);

		$d = date_parse_from_format("Y-m-d", $fDate);
		$finishDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":sDate",$startDate);
		$stmt->bindParam(":fDate",$finishDate);
		$bookingRoom="%{$bookingRoom}%";
		$bookingName="%{$bookingName}%";

		$stmt->bindParam(":bookingRoom",$bookingRoom);
		$stmt->bindParam(":bookingName",$bookingName);

		$stmt->execute();
		return $stmt;
	}



	public function roomUsageReport($sDate,$fDate){
		$query="SELECT
			A.id, 
			A.BookingRoom,
			A.BookingDate,
			A.startTime,
			A.finishTime,
			A.activity,
			B.FloorNo,
			YEAR(A.BookingDate) AS YY,
			MONTH(A.BookingDate) AS MM,
			HOUR(TIMEDIFF(A.finishTime, A.startTime)) AS HourDiff,
			A.bookingName
		FROM t_booking A LEFT OUTER JOIN
		t_room B ON A.BookingRoom=B.RoomNo
		WHERE 
		A.BookingDate 
		BETWEEN :sDate AND :fDate
		ORDER BY A.BookingDate

		";

		$d = date_parse_from_format("Y-m-d", $sDate);
		$startDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);

		$d = date_parse_from_format("Y-m-d", $fDate);
		$finishDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":sDate",$startDate);
		$stmt->bindParam(":fDate",$finishDate);
		$stmt->execute();
		return $stmt;
	}

	public function getLastId(){
		$query="SELECT MAX(id) AS MxId FROM t_booking";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$MxId= is_null($MxId)?0:$MxId;
		return $MxId;

	}

	public function randColor() {
    	return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
	}

	public function getFormat($i){
		return sprintf('%02s',$i);
	}

	public function registerBooking(){
		$query="INSERT INTO t_booking  
        	SET 
					bookingRoom=:bookingRoom,
					bookingDate=:bookingDate,
					startTime=:startTime,
					finishTime=:finishTime,
					bookingName='Register System',
					activity=:activity,
					staffId='Admin',
					aproveStatus=1,
					status=0,
					lineNo='',
					telNo='',
					outsiderId=0";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":bookingRoom",$this->bookingRoom);
		$stmt->bindParam(":bookingDate",$this->bookingDate);
		$stmt->bindParam(":startTime",$this->startTime);
		$stmt->bindParam(":finishTime",$this->finishTime);
		$stmt->bindParam(":activity",$this->activity);
		$flag=$stmt->execute();


		return $flag;
	}

	public function create(){
		$query='INSERT INTO t_booking  
        	SET 
			bookingRoom=:bookingRoom,
			bookingDate=:bookingDate,
			startTime=:startTime,
			finishTime=:finishTime,
			bookingName=:bookingName,
			staffId=:staffId,
			status=:status,
			activity=:activity,
			lineNo=:lineNo,
			telNo=:telNo,
			outsiderId=:outsiderId
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":bookingRoom",$this->bookingRoom);
		$stmt->bindParam(":bookingDate",$this->bookingDate);
		$stmt->bindParam(":startTime",$this->startTime);
		$stmt->bindParam(":finishTime",$this->finishTime);
		$stmt->bindParam(":bookingName",$this->bookingName);
		$stmt->bindParam(":staffId",$this->staffId);
		$stmt->bindParam(":status",$this->status);
		$stmt->bindParam(":activity",$this->activity);
		$stmt->bindParam(":lineNo",$this->lineNo);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":outsiderId",$this->outsiderId);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_booking 
        	SET 
			bookingRoom=:bookingRoom,
			bookingDate=:bookingDate,
			startTime=:startTime,
			finishTime=:finishTime,
			bookingName=:bookingName,
			staffId=:staffId,
			status=:status,
			activity=:activity,
			lineNo=:lineNo,
			telNo=:telNo
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":bookingRoom",$this->bookingRoom);
		$stmt->bindParam(":bookingDate",$this->bookingDate);
		$stmt->bindParam(":startTime",$this->startTime);
		$stmt->bindParam(":finishTime",$this->finishTime);
		$stmt->bindParam(":bookingName",$this->bookingName);
		$stmt->bindParam(":staffId",$this->staffId);
		$stmt->bindParam(":status",$this->status);
		$stmt->bindParam(":activity",$this->activity);
		$stmt->bindParam(":lineNo",$this->lineNo);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query="SELECT  
			id,
			bookingRoom,
			bookingDate,
			startTime,
			finishTime,
			bookingName,
			staffId,
			status,
			activity,
			lineNo,
			telNo
		FROM t_booking 
		WHERE id=:id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}

	public function isExist($roomNo,$bookingDate,$sTime,$fTime){
		$query="SELECT id FROM t_booking
		WHERE
		bookingRoom=:bookingRoom 
		AND DATE_FORMAT(bookingDate,'%Y-%m-%d')=:bookingDate 
		AND (
			(startTime<:sTime AND finishTime>:sTime)
				OR 
			(startTime<:fTime AND finishTime>:fTime)
				OR 
			(startTime>=:sTime AND finishTime<=:fTime)
		)";
		$d = date_parse_from_format("Y-m-d", $bookingDate);
		$bookingDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);
		$sTime=str_replace(" ","",$sTime);
		$fTime=str_replace(" ","",$fTime);
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':bookingRoom',$roomNo);
		$stmt->bindParam(':bookingDate',$bookingDate);
		$stmt->bindParam(':sTime',$sTime);
		$stmt->bindParam(':fTime',$fTime);
		$stmt->execute();

		//print_r($query);

		$flag=$stmt->rowCount()>0?true:false;
		//print_r($flag);
		return $flag;
	}

	public function getBookingNo($userCode){
		$query="SELECT COUNT(id) AS CNT FROM t_booking 
		WHERE staffId=:userCode AND bookingDate>=NOW()";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		//print_r($stmt);
		extract($row);
		return $CNT;
	}

	

	public function isUsageRoom($roomNo){
		$currDate=date('Y-m-d H:i:s');
		$d = date_parse_from_format("j.n.Y H:iP", $currDate);
		$currDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);
		$currTime=$this->getFormat($d["hour"]).":".$this->getFormat($d["minut"]);
		$query="SELECT id 
		FROM t_booking
		WHERE
			bookingRoom=:roomNo 
		AND 
			DATE_FORMAT(bookingDate,'%Y-%m-%d')=:currDate
		AND 
			startTime<=:currTime AND finishTime>=:currTime
		";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':roomNo',$roomNo);
		$stmt->bindParam(':currDate',$currDate);
		$stmt->bindParam(':currTime',$currTime);
		$stmt->execute();
		$flag=$stmt->rowCount()>0?True:False;
		return $flag;

	}

	public function displayEmptyRoom($building,$bookingDate,$sTime,$fTime){
		$query="SELECT 
			id,
			roomNo,
			ComputerNo,
			DeskNo,
			Accessory,
			floorNo,
			Building
		FROM t_room 
		WHERE roomNo NOT IN
		(
				SELECT bookingRoom FROM t_booking
				WHERE
					DATE_FORMAT(bookingDate,'%Y-%m-%d')=:bookingDate 
				AND 
				(
					((startTime<:sTime AND finishTime>:sTime)
						OR 
					(startTime<:fTime AND finishTime>:fTime))
						OR 
					(startTime>=:sTime AND finishTime<=:fTime)
					

				)
		) AND Building LIKE :building AND status=1";
		if($bookingDate!=""){	
			$d = date_parse_from_format("Y-m-d", $bookingDate);
			$bookingDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);
		}else{
			$bookingDate="%";
		}
		$building="%{$building}%";
		$sTime=str_replace(" ","",$sTime);
		$fTime=str_replace(" ","",$fTime);
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':building',$building);
		$stmt->bindParam(':bookingDate',$bookingDate);
		$stmt->bindParam(':sTime',$sTime);
		$stmt->bindParam(':fTime',$fTime);
		$stmt->execute();
		return $stmt;
	}

	public function getStatus($roomNo){

		date_default_timezone_set('Asia/Bangkok');
    	$date = date('m/d/Y h:i:s a', time());
    	$d = date_parse_from_format("m/d/Y h:i:s a", $date);
    	$bookingDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);
    	$currTime=$this->getFormat($d["hour"]).":".$this->getFormat($d["minute"]);
    	
    	$query="SELECT 
	    	BookingRoom,
	    	BookingDate,
	    	StartTime,
	    	FinishTime,
	    	bookingName,
	    	activity
    	FROM t_booking 
    	WHERE 
    		BookingRoom=:roomNo AND 
    		bookingDate=:bookingDate AND 
    		startTime<=:currTime AND 
    		finishTime>=:currTime
    	";
    	$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':roomNo',$roomNo);
		$stmt->bindParam(':bookingDate',$bookingDate);
		$stmt->bindParam(':currTime',$currTime);
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num>0){
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			$objItem=array(
				"bookingDate"=>$BookingDate,
				"bookingTime"=>$StartTime."-".$FinishTime,
				"status"=>"ใช้งาน",
				"activity"=>$activity,
				"bookingName"=>$bookingName,
				"flag"=>1
			);
			return $objItem;
		}else{
			$objItem=array(
				"bookingDate"=>"",
				"bookingTime"=>"",
				"status"=>"ว่าง",
				"activity"=>"",
				"bookingName"=>"",
				"flag"=>0
			);
			return $objItem;
		}
		
	}

	public function displayUsageRoom($building,$bookingDate,$sTime,$fTime){
		$d = date_parse_from_format("Y-m-d", $bookingDate);
		$bookingDate= $d["year"]."-".$this->getFormat($d["month"])."-".$this->getFormat($d["day"]);
		$sTimes=explode(":", $sTime);
		$fTimes=explode(":", $fTime);
		$sTime1=$sTime;
		$fTime1=$fTime;

		$sTime=$sTimes[0]."-".$sTimes[1];
		$fTime=$fTimes[0]."-".$fTimes[1];


		$building="%{$building}%";
		$query="SELECT 
			bk.bookingRoom,
			bk.bookingDate,
			bk.startTime,
			bk.finishTime,
			bk.bookingName,
			bk.Activity,
			rm.Building
		FROM t_booking bk INNER JOIN t_room rm 
			ON bk.bookingRoom=rm.RoomNo
		WHERE
				rm.Building LIKE :building 
			AND 
				DATE_FORMAT(bk.bookingDate,'%Y-%m-%d') = :bookingDate 
			AND 
			(
				(REPLACE(bk.startTime,':','-')<:sTime AND REPLACE(bk.finishTime,':','-')>:sTime)
					OR 
				(REPLACE(bk.startTime,':','-')<:fTime AND REPLACE(bk.finishTime,':','-')>:fTime)
					OR 
				(REPLACE(bk.startTime,':','-')>=:sTime AND REPLACE(bk.finishTime,':','-')<=:fTime)
			)
		";

		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':building',$building);
		$stmt->bindParam(':bookingDate',$bookingDate);
		$stmt->bindParam(':sTime',$sTime);
		$stmt->bindParam(':fTime',$fTime);
		$stmt->execute();
		return $stmt;
	}
	

	public function displayData($bookingRoom){
		$query='SELECT  id,
			bookingRoom,
			bookingDate,
			startTime,
			finishTime,
			bookingName,
			staffId,
			status,
			activity,
			lineNo,
			telNo
		FROM t_booking WHERE bookingRoom LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}

	public function getOptional($bookingId){
		$query="SELECT B.`templateOption` 
		FROM t_optional A INNER JOIN t_template B
		ON A.`template`=B.`code` 
		WHERE A.bookingId=:bookingId";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":bookingId",$bookingId);
		$stmt->execute();
		return $stmt;
	}



	public function getSelfBookingRoom($userCode){
		$query='SELECT  id,
			bookingRoom,
			bookingDate,
			startTime,
			finishTime,
			bookingName,
			staffId,
			status,
			activity,
			lineNo,
			telNo
		FROM t_booking 
		WHERE staffId LIKE :userCode
		AND  bookingDate >=:currentDate
		ORDER BY bookingDate DESC' ;
		$stmt = $this->conn->prepare($query);
		$currentDate=date("Y-m-d");
		$stmt->bindParam(":userCode",$userCode);
		$stmt->bindParam(":currentDate",$currentDate);
		$stmt->execute();
		return $stmt;
	}

	public function getBookingRoomById($id){
		$query="SELECT  id,
			bookingRoom,
			bookingDate,
			startTime,
			finishTime,
			bookingName,
			staffId,
			status,
			activity,
			lineNo,
			telNo
		FROM t_booking 
		WHERE id LIKE :id" ;
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":id",$id);
		$stmt->execute();
		return $stmt;
	}




	public function getBookingEvent($currDate,$bookingRoom){
		$query='SELECT  
			id,
			bookingDate,
			startTime,
			finishTime,
			bookingName,
			activity,
			lineNo,
			telNo
		FROM t_booking WHERE 
			YEAR(bookingDate) <= :yy
		AND 
			bookingRoom=:bookingRoom
		';
		$stmt = $this->conn->prepare($query);
		$d = date_parse_from_format("Y-m-d", $currDate);
		
		$yy=$d["year"];
		$stmt->bindParam(':yy',$yy);
		$stmt->bindParam(':bookingRoom',$bookingRoom);
		$stmt->execute();
		return $stmt;
	}

	public function getBookingDateEvent($bookingDate,$bookingRoom){
		$query='SELECT  
			id,
			bookingDate,
			startTime,
			finishTime,
			bookingName,
			activity,
			lineNo,
			telNo
		FROM t_booking WHERE 
			bookingDate <= :bookingDate
		AND 
			bookingRoom=:bookingRoom
		';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':bookingDate',$bookingDate);
		$stmt->bindParam(':bookingRoom',$bookingRoom);
		$stmt->execute();
		return $stmt;
	}




	function delete(){
		$query='DELETE FROM t_booking WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function genCode(){
		$curYear = date("Y")-2000+543;
		$curYear = substr($curYear,1,2);
		$curYear = sprintf("%02d", $curYear);
		$curMonth=date("n");
		$curMonth = sprintf("%02d",$curMonth);
		$prefix= $curYear .$curMonth;
		$query ="SELECT MAX(CODE) AS MXCode FROM t_booking WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>