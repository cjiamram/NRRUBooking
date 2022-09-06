<?php
include_once "keyWord.php";
include_once "manage.php";
class  tzoombooking{
	private $conn;
	private $table_name="t_zoombooking";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $zoomCode;
	public $bookingDate;
	public $startTime;
	public $finishTime;
	public $bookingName;
	public $staffId;
	public $status;
	public $activity;
	public $telNo;
	public $lineNo;
	public $aproveStatus;
	public $outsiderId;
	public $departmentId;
	public $objective;
	public $finishDate;
	public $timeDuration;

	

	public function getTimeById($id){
		//$cDate=date("Y-m-d H-i");

		$query="SELECT 
		CONCAT(DATE_FORMAT(bookingDate,'%Y-%m-%d'),' ',REPLACE(finishTime,':','-')) AS FDate,
		CONCAT(DATE_FORMAT(bookingDate,'%Y-%m-%d'),' ',REPLACE(startTime,':','-')) AS SDate 
 
		
		FROM t_zoombooking 
		WHERE
		id=:id";

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":id",$id);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		return array("sDate"=>$SDate,"fDate"=>$FDate);

	}

	public function getMeetingPrepare($id){
		$BDate=$this->getTimeById($id);
		$cDate=date("Y-m-d H-i");
		if($cDate<$BDate["sDate"])
			return true;
		else
			return false; 
	}


	public function getMeetingStatus($id){
		$BDate=$this->getTimeById($id);
		$cDate=date("Y-m-d H-i");
		if($BDate["fDate"]<$cDate){
			 return 'เสร็จสิ้นการประชุม';

		}else{
			if($cDate<$BDate["sDate"]){
				return "ยังไม่ถึงเวลาประชุม";
			}else
				return "อยู่ระหว่างประชุม";
		}
		
	}
	
	public function getDurationDateTime($startTime,$dutationTime){
		$query='SELECT DATE_ADD("'.$startTime.'", INTERVAL '.$dutationTime.' MINUTE) AS duration';
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$durations = explode(" ", $duration);
		$objArr=array("date"=>$durations[0],"time"=>$durations[1]);
		return $objArr;

	}


	public function getCountBooking(){
		$query="SELECT 
		COUNT(id) AS CNT,
		SUM(HOUR(TIMEDIFF(finishTime,startTime))) AS THr 
		FROM t_zoombooking 
		";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}



	public function sumaryDepartmentByDate($sDate,$fDate){
		$query="SELECT 
		SUM(TIME_TO_SEC(TIMEDIFF(finishTime,startTime))/60) AS THr,
		B.departmentName
		FROM t_zoombooking A INNER JOIN t_department B
		ON A.departmentId=B.departmentId
		WHERE 
		bookingDate BETWEEN  :sDate AND :fDate
		GROUP BY B.departmentName
		 ";
		$stmt=$this->conn->prepare($query);
		$sDate=Format::getSystemDate($sDate);
		$fDate=Format::getSystemDate($fDate);
		$stmt->bindParam(":sDate",$sDate);
		$stmt->bindParam(":fDate",$fDate);		$stmt->execute();
		return $stmt;
	}

	public function sumaryObjectiveByDate($sDate,$fDate){
		$query="SELECT SUM(TIME_TO_SEC(TIMEDIFF(finishTime,startTime))/60) AS THr,
		B.objective,B.code
		FROM t_zoombooking A LEFT OUTER JOIN t_bookingobjective B
		ON A.objective=B.code
		WHERE 
		bookingDate BETWEEN :sDate AND :fDate
		GROUP BY B.objective,B.code
		 ";
		$stmt=$this->conn->prepare($query);
		$sDate=Format::getSystemDate($sDate);
		$fDate=Format::getSystemDate($fDate);
		$stmt->bindParam(":sDate",$sDate);
		$stmt->bindParam(":fDate",$fDate);
		$stmt->execute();
		return $stmt;
	}

	public function getLicenseUsageByDate($sDate,$fDate){
		$cDate=$sDate;
		$sDate=Format::getSystemDate($sDate);
		$fDate=Format::getSystemDate($fDate);
		$sDate = date_create($sDate);
    	$fDate = date_create($fDate);
    	$interval = date_diff($sDate, $fDate);

		$objArr=array();
		for($i=1;$i<=$interval->days;$i++){
			date_add($sDate,date_interval_create_from_date_string("1 days"));
			$cDate=$sDate->format('Y-m-d');
			$free=$this->getFreeLicense($cDate);
			$usage=$this->getUsageLicense($cDate);
			$objItem=array("currDate"=>$cDate,"free"=>$free,"usage"=>$usage);
			array_push($objArr, $objItem);
		}
		return $objArr;
	}

	public function getFreeLicense($currDate){

		$query="SELECT DISTINCT COUNT(zoomCode) AS CNT
		FROM t_zoomlicense WHERE 
		zoomCode 
			NOT IN (
					SELECT  DISTINCT zoomCode 
					FROM t_zoombooking 
					WHERE bookingDate=:currDate
			)
		AND 
		status<>0
		"; 

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":currDate",$currDate);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		return $CNT;
	}

	public function getUsageLicense($currDate){
		$query="SELECT  DISTINCT COUNT(zoomCode) AS CNT 
		FROM t_zoombooking WHERE bookingDate=:currDate";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":currDate",$currDate);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		return $CNT;
	}
	

	public function sumaryZoomBooking(){
		$query="SELECT C.licenseType,B.status AS typeCode,
		SUM(HOUR(TIMEDIFF(finishTime,startTime))) AS THr
		FROM t_zoombooking A INNER JOIN t_zoomlicense B
		ON A.zoomCode=B.zoomCode INNER JOIN t_licensetype C 
		ON B.status=C.typeCode
		GROUP BY C.licenseType,B.status";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;

	}


	public function getRequest($id){
		$query="SELECT 
			lineNo,
			activity,
			password,
			zoomLink,
			CONCAT(DATE_FORMAT(bookingDate,'%d-%m-%Y'),' ',startTime) AS sDate,
			CONCAT(DATE_FORMAT(finishDate,'%d-%m-%Y'),' ',finishTime) AS fDate,
			meetingId AS id 
		FROM t_zoombooking 
		WHERE id=:id";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":id",$id);
		$stmt->execute();
		if($stmt->rowCount()>0){
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);
			$objItem=array(
				"activity"=>$activity,
				"lineNo"=>$lineNo,
				"id"=>$id,
				"sDate"=>$sDate,
				"fDate"=>$fDate,
				"password"=>$password,
				"zoomLink"=>$zoomLink
				);
			return $objItem;
		}else
		return array("message"=>false);
	}


	public function getZoomBookingNotify($id){
		$query="SELECT 
			id,
			bookingName,
			zoomCode,
			bookingDate,
			startTime,
			finishTime,
			activity 
		FROM t_zoombooking 
		WHERE id=:id 
		";

		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":id",$id);
		$stmt->execute();
		return $stmt;
	}

	

	
	public function listZoomEmpthy($bookingDate,$sTime,$fTime){

		$sql="SELECT zoomCode 
		FROM t_zoombooking
		WHERE
		DATE_FORMAT(bookingDate,'%Y-%m-%d')=:bookingDate 
		AND (
				(startTime<=:sTime AND finishTime>=:sTime)
					OR 
				(startTime<=:fTime AND finishTime>=:fTime)
					OR 
				(startTime>=:sTime AND finishTime<=:fTime)
		) AND aproveStatus<>3";

		$query="SELECT zoomCode 
		FROM t_zoomlicense
		WHERE 
		zoomCode NOT IN (".$sql.") 
		AND status=1 
		";



		$bookingDate= Format::getSystemDate($bookingDate);
		$sTime=str_replace(" ","",$sTime);
		$fTime=str_replace(" ","",$fTime);		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':bookingDate',$bookingDate);
		$stmt->bindParam(':sTime',$sTime);
		$stmt->bindParam(':fTime',$fTime);
		$stmt->execute();
		return $stmt;
	}

	public function isExist($zoomCode,$bookingDate,$sTime,$fTime){
		$query="SELECT id FROM t_zoombooking
		WHERE
		zoomCode=:zoomCode 
		AND DATE_FORMAT(bookingDate,'%Y-%m-%d')=:bookingDate 
		AND (
			(startTime<:sTime AND finishTime>:sTime)
				OR 
			(startTime<:fTime AND finishTime>:fTime)
				OR 
			(startTime>=:sTime AND finishTime<=:fTime)
		) AND aproveStatus<>3";

		$bookingDate=Format::getSystemDate($bookingDate);
		$sTime=str_replace(" ","",$sTime);
		$fTime=str_replace(" ","",$fTime);
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':zoomCode',$zoomCode);
		$stmt->bindParam(':bookingDate',$bookingDate);
		$stmt->bindParam(':sTime',$sTime);
		$stmt->bindParam(':fTime',$fTime);
		$stmt->execute();
		$flag=$stmt->rowCount()>0?True:False;
		return $flag;
	}

	public function isExistByDuration($zoomCode,$bookingDate,$finishDate,$sTime,$fTime){


		$query="SELECT id FROM t_zoombooking
		WHERE
		zoomCode=:zoomCode 
		AND aproveStatus<>3
		AND( 

				(
					CONCAT(DATE_FORMAT(bookingDate,'%Y-%m-%d'),' ',startTime)<:sDate
						AND
					CONCAT(DATE_FORMAT(finishDate,'%Y-%m-%d'),' ',finishTime)>:sDate
				)
				OR
				(
					CONCAT(DATE_FORMAT(bookingDate,'%Y-%m-%d'),' ',startTime)<:fDate
						AND
					CONCAT(DATE_FORMAT(finishDate,'%Y-%m-%d'),' ',finishTime)>:fDate
				)
				OR
				(
					CONCAT(DATE_FORMAT(bookingDate,'%Y-%m-%d'),' ',startTime)>=:sDate
						AND
					CONCAT(DATE_FORMAT(finishDate,'%Y-%m-%d'),' ',finishTime)<=:fDate
				)
		)

		";

	

		$sDate=Format::getSystemDate($bookingDate)." ".$sTime;
		$fDate=Format::getSystemDate($finishDate)." ".$fTime;
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':zoomCode',$zoomCode);
		$stmt->bindParam(':sDate',$sDate);
		$stmt->bindParam(':fDate',$fDate);
	
		$stmt->execute();
		$flag=$stmt->rowCount()>0?True:False;
		return $flag;
	}
	

	public function createByAdmin(){
		 $query="INSERT INTO t_zoombooking  
		        	SET 
					zoomCode=:zoomCode,
					bookingDate=:bookingDate,
					startTime=:startTime,
					finishTime=:finishTime,
					bookingName=:bookingName,
					staffId=:staffId,
					status=:status,
					activity=:activity,
					telNo=:telNo,
					lineNo=:lineNo,
					aproveStatus=:aproveStatus,
					outsiderId=:outsiderId,
					finishDate=:finishDate,
					timeDuration=:timeDuration
			";
				$stmt = $this->conn->prepare($query);
				$stmt->bindParam(":zoomCode",$this->zoomCode);
				$stmt->bindParam(":bookingDate",$this->bookingDate);
				$stmt->bindParam(":startTime",$this->startTime);
				$stmt->bindParam(":finishTime",$this->finishTime);
				$stmt->bindParam(":bookingName",$this->bookingName);
				$stmt->bindParam(":staffId",$this->staffId);
				$stmt->bindParam(":status",$this->status);
				$stmt->bindParam(":activity",$this->activity);
				$stmt->bindParam(":telNo",$this->telNo);
				$stmt->bindParam(":lineNo",$this->lineNo);
				$stmt->bindParam(":aproveStatus",$this->aproveStatus);
				$stmt->bindParam(":outsiderId",$this->outsiderId);
				$stmt->bindParam(":finishDate",$this->finishDate);
				$stmt->bindParam(":timeDuration",$this->timeDuration);
				$flag=$stmt->execute();
				return $flag;
	}

	public function createByAdminWithLastId(){
		 $query="INSERT INTO t_zoombooking  
		        	SET 
					zoomCode=:zoomCode,
					bookingDate=:bookingDate,
					startTime=:startTime,
					finishTime=:finishTime,
					bookingName=:bookingName,
					staffId=:staffId,
					status=:status,
					activity=:activity,
					telNo=:telNo,
					lineNo=:lineNo,
					aproveStatus=:aproveStatus,
					outsiderId=:outsiderId,
					finishDate=:finishDate,
					timeDuration=:timeDuration
			";
				$stmt = $this->conn->prepare($query);
				$stmt->bindParam(":zoomCode",$this->zoomCode);
				$stmt->bindParam(":bookingDate",$this->bookingDate);
				$stmt->bindParam(":startTime",$this->startTime);
				$stmt->bindParam(":finishTime",$this->finishTime);
				$stmt->bindParam(":bookingName",$this->bookingName);
				$stmt->bindParam(":staffId",$this->staffId);
				$stmt->bindParam(":status",$this->status);
				$stmt->bindParam(":activity",$this->activity);
				$stmt->bindParam(":telNo",$this->telNo);
				$stmt->bindParam(":lineNo",$this->lineNo);
				$stmt->bindParam(":aproveStatus",$this->aproveStatus);
				$stmt->bindParam(":outsiderId",$this->outsiderId);
				$stmt->bindParam(":finishDate",$this->finishDate);
				$stmt->bindParam(":timeDuration",$this->timeDuration);
				$flag=$stmt->execute();
				$lastId=$this->getCreateId($this->zoomCode,$this->staffId);
				$objCreate=array("flag"=>$flag,"lastId"=>$lastId);
				return $objCreate;
	}

	

	public function listZoomEmpthyByDuration($bookingDate,$finishDate,$sTime,$fTime){
		$sql="SELECT zoomCode 
		FROM t_zoombooking
		WHERE
		(
			CONCAT(DATE_FORMAT(bookingDate,'%Y-%m-%d'),' ',REPLACE(startTime,':','-'))<:sDate
				AND
			CONCAT(DATE_FORMAT(finishDate,'%Y-%m-%d'),' ',REPLACE(finishTime,':','-'))>:sDate
		)
		OR
		(
			CONCAT(DATE_FORMAT(bookingDate,'%Y-%m-%d'),' ',REPLACE(startTime,':','-'))<:fDate
				AND
			CONCAT(DATE_FORMAT(finishDate,'%Y-%m-%d'),' ',REPLACE(finishTime,':','-'))>:fDate
		)
		OR
		(
			CONCAT(DATE_FORMAT(bookingDate,'%Y-%m-%d'),' ',REPLACE(startTime,':','-'))>=:sDate
				AND
			CONCAT(DATE_FORMAT(finishDate,'%Y-%m-%d'),' ',REPLACE(finishTime,':','-'))<=:fDate
		)

		";
		$query="SELECT zoomCode 
		FROM t_zoomlicense
		WHERE 
		zoomCode NOT IN (".$sql.") 
		AND status=1 " ;
		$sTimes=explode(":", $sTime);
		$fTimes=explode(":", $fTime);
		$sTime=$sTimes[0]."-".$sTimes[1];
		$fTime=$fTimes[0]."-".$fTimes[1];
		$sDate=$bookingDate." ".$sTime;
		$fDate=$finishDate." ".$fTime;
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':sDate',$sDate);
		$stmt->bindParam(':fDate',$fDate);
		$stmt->execute();
		
		return $stmt;
	}


	public function getDateRange($sDate){
		  $cDate=date('Y-m-d');
		  $sDate=Format::getSystemDate($sDate);
		  $datetime1 = date_create($cDate);
		  $datetime2 = date_create($sDate);
		  $interval = date_diff($datetime1, $datetime2);
		  return $interval->format('%a');
	}
	
	public function getCreateId($zoomCode,$staffId){
		$query="SELECT MAX(id) AS id FROM t_zoombooking
		WHERE 
		zoomCode=:zoomCode AND
		staffId=:staffId";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":zoomCode",$zoomCode);
		$stmt->bindParam(":staffId",$staffId);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$MxId= is_null($id)?0:$id;
		return $MxId;
		
	}

	public function listZoomEmpthyByFaculty($bookingDate,$finishDate,$sTime,$fTime,$facultyCode){
		$sql="SELECT zoomCode 
		FROM t_zoombooking
		WHERE
		(
			CONCAT(DATE_FORMAT(bookingDate,'%Y-%m-%d'),' ',REPLACE(startTime,':','-'))<:sDate
				AND
			CONCAT(DATE_FORMAT(finishDate,'%Y-%m-%d'),' ',REPLACE(finishTime,':','-'))>:sDate
		)
		OR
		(
			CONCAT(DATE_FORMAT(bookingDate,'%Y-%m-%d'),' ',REPLACE(startTime,':','-'))<:fDate
				AND
			CONCAT(DATE_FORMAT(finishDate,'%Y-%m-%d'),' ',REPLACE(finishTime,':','-'))>:fDate
		)
		OR
		(
			CONCAT(DATE_FORMAT(bookingDate,'%Y-%m-%d'),' ',REPLACE(startTime,':','-'))>=:sDate
				AND
			CONCAT(DATE_FORMAT(finishDate,'%Y-%m-%d'),' ',REPLACE(finishTime,':','-'))<=:fDate
		)

		";
		$query="SELECT zoomCode 
		FROM t_zoomlicense
		WHERE 
		zoomCode NOT IN (".$sql.") 
		AND status=4 AND facultyCode=:facultyCode" ;
		$sTimes=explode(":", $sTime);
		$fTimes=explode(":", $fTime);
		$sTime=$sTimes[0]."-".$sTimes[1];
		$fTime=$fTimes[0]."-".$fTimes[1];
		$sDate=$bookingDate." ".$sTime;
		$fDate=$finishDate." ".$fTime;
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':sDate',$sDate);
		$stmt->bindParam(':fDate',$fDate);
		$stmt->bindParam(':facultyCode',$facultyCode);
		$stmt->execute();
		
		return $stmt;
	}

	public function createByStudentWithLastId($facultyCode){
		$stmt_1=$this->listZoomEmpthyByFaculty($this->bookingDate,$this->finishDate,$this->startTime,$this->finishTime,$facultyCode);
		
		if($stmt_1->rowCount()>0){
				$row=$stmt_1->fetch(PDO::FETCH_ASSOC);
				extract($row);


				$query='INSERT INTO t_zoombooking  
		        	SET 
					zoomCode=:zoomCode,
					bookingDate=:bookingDate,
					startTime=:startTime,
					finishTime=:finishTime,
					bookingName=:bookingName,
					staffId=:staffId,
					status=:status,
					activity=:activity,
					telNo=:telNo,
					lineNo=:lineNo,
					aproveStatus=:aproveStatus,
					outsiderId=:outsiderId,
					objective=:objective,
					departmentId=:departmentId,
					finishDate=:finishDate,
					timeDuration=:timeDuration
			';
				$stmt = $this->conn->prepare($query);
				$stmt->bindParam(":zoomCode",$zoomCode);
				$stmt->bindParam(":bookingDate",$this->bookingDate);
				$stmt->bindParam(":startTime",$this->startTime);
				$stmt->bindParam(":finishTime",$this->finishTime);
				$stmt->bindParam(":bookingName",$this->bookingName);
				$stmt->bindParam(":staffId",$this->staffId);
				$stmt->bindParam(":status",$this->status);
				$stmt->bindParam(":activity",$this->activity);
				$stmt->bindParam(":telNo",$this->telNo);
				$stmt->bindParam(":lineNo",$this->lineNo);
				$stmt->bindParam(":aproveStatus",$this->aproveStatus);
				$stmt->bindParam(":outsiderId",$this->outsiderId);
				$stmt->bindParam(":objective",$this->objective);
				$stmt->bindParam(":departmentId",$this->departmentId);
				$stmt->bindParam(":finishDate",$this->finishDate);
				$stmt->bindParam(":timeDuration",$this->timeDuration);

				$flag=$stmt->execute();
				$lastId=$this->getCreateId($zoomCode,$this->staffId);

				$objCreate=array("flag"=>$flag,"lastId"=>$lastId);
				return $objCreate;
		}else
	
		return false;
	}



	public function createWithLastId(){
		$stmt_1=$this->listZoomEmpthyByDuration($this->bookingDate,$this->finishDate,$this->startTime,$this->finishTime);
		
		if($stmt_1->rowCount()>0){
				//print_r("xxxxxxx");
				$row=$stmt_1->fetch(PDO::FETCH_ASSOC);
				extract($row);


				$query='INSERT INTO t_zoombooking  
		        	SET 
					zoomCode=:zoomCode,
					bookingDate=:bookingDate,
					startTime=:startTime,
					finishTime=:finishTime,
					bookingName=:bookingName,
					staffId=:staffId,
					status=:status,
					activity=:activity,
					telNo=:telNo,
					lineNo=:lineNo,
					aproveStatus=:aproveStatus,
					outsiderId=:outsiderId,
					objective=:objective,
					departmentId=:departmentId,
					finishDate=:finishDate,
					timeDuration=:timeDuration
			';
				$stmt = $this->conn->prepare($query);
				$stmt->bindParam(":zoomCode",$zoomCode);
				$stmt->bindParam(":bookingDate",$this->bookingDate);
				$stmt->bindParam(":startTime",$this->startTime);
				$stmt->bindParam(":finishTime",$this->finishTime);
				$stmt->bindParam(":bookingName",$this->bookingName);
				$stmt->bindParam(":staffId",$this->staffId);
				$stmt->bindParam(":status",$this->status);
				$stmt->bindParam(":activity",$this->activity);
				$stmt->bindParam(":telNo",$this->telNo);
				$stmt->bindParam(":lineNo",$this->lineNo);
				$stmt->bindParam(":aproveStatus",$this->aproveStatus);
				$stmt->bindParam(":outsiderId",$this->outsiderId);
				$stmt->bindParam(":objective",$this->objective);
				$stmt->bindParam(":departmentId",$this->departmentId);
				$stmt->bindParam(":finishDate",$this->finishDate);
				$stmt->bindParam(":timeDuration",$this->timeDuration);

				$flag=$stmt->execute();
				$lastId=$this->getCreateId($zoomCode,$this->staffId);

				$objCreate=array("flag"=>$flag,"lastId"=>$lastId);
				return $objCreate;
		}else
	
		return false;
	}

	public function create(){
		$stmt_1=$this->listZoomEmpthyByDuration($this->bookingDate,$this->finishDate,$this->startTime,$this->finishTime);
		if($stmt_1->rowCount()>0){
				$row=$stmt_1->fetch(PDO::FETCH_ASSOC);
				extract($row);


				$query='INSERT INTO t_zoombooking  
		        	SET 
					zoomCode=:zoomCode,
					bookingDate=:bookingDate,
					startTime=:startTime,
					finishTime=:finishTime,
					bookingName=:bookingName,
					staffId=:staffId,
					status=:status,
					activity=:activity,
					telNo=:telNo,
					lineNo=:lineNo,
					aproveStatus=:aproveStatus,
					outsiderId=:outsiderId,
					objective=:objective,
					departmentId=:departmentId,
					finishDate=:finishDate,
					timeDuration=:timeDuration
			';
				$stmt = $this->conn->prepare($query);
				$stmt->bindParam(":zoomCode",$zoomCode);
				$stmt->bindParam(":bookingDate",$this->bookingDate);
				$stmt->bindParam(":startTime",$this->startTime);
				$stmt->bindParam(":finishTime",$this->finishTime);
				$stmt->bindParam(":bookingName",$this->bookingName);
				$stmt->bindParam(":staffId",$this->staffId);
				$stmt->bindParam(":status",$this->status);
				$stmt->bindParam(":activity",$this->activity);
				$stmt->bindParam(":telNo",$this->telNo);
				$stmt->bindParam(":lineNo",$this->lineNo);
				$stmt->bindParam(":aproveStatus",$this->aproveStatus);
				$stmt->bindParam(":outsiderId",$this->outsiderId);
				$stmt->bindParam(":objective",$this->objective);
				$stmt->bindParam(":departmentId",$this->departmentId);
				$stmt->bindParam(":finishDate",$this->finishDate);
				$stmt->bindParam(":timeDuration",$this->timeDuration);

				$flag=$stmt->execute();
				//$lastId=$this->getCreateId($zoomCode,$this->staffId);

				//$objCreate=array("flag"=>$flag,"lastId"=>$lastId);
				return $flag;
		}else
		return false;
	}


	public function getZoomBookingEvent($currDate,$zoomCode){
		$query='SELECT  
			A.id,
			A.zoomCode,
			A.bookingDate,
			A.bookingName,
			A.startTime,
			A.finishTime,
			A.bookingName,
			A.activity,
			A.lineNo,
			A.telNo
		FROM t_zoombooking  A INNER JOIN t_zoomlicense B 
		ON A.zoomCode=B.zoomCode
		WHERE 
			YEAR(A.bookingDate) <= :yy
		AND 
			A.zoomCode LIKE :zoomCode
		AND 
			B.status=1
		AND 
			A.aproveStatus<>3
		';
		$stmt = $this->conn->prepare($query);
		$d = date_parse_from_format("Y-m-d", $currDate);
		
		$yy=$d["year"];
		$stmt->bindParam(':yy',$yy);
		$zoomCode="%{$zoomCode}%";
		$stmt->bindParam(':zoomCode',$zoomCode);
		$stmt->execute();
		return $stmt;
	}


	public function getZoomAdminBookingEvent($currDate,$zoomCode){
		$query='SELECT  
			A.id,
			A.zoomCode,
			A.bookingDate,
			A.bookingName,
			A.startTime,
			A.finishTime,
			A.bookingName,
			A.activity,
			A.lineNo,
			A.telNo
		FROM t_zoombooking  A INNER JOIN t_zoomlicense B 
		ON A.zoomCode=B.zoomCode
		WHERE 
			YEAR(A.bookingDate) <= :yy
		AND 
			A.zoomCode LIKE :zoomCode
		AND 
			B.status=3
		AND 
			A.aproveStatus<>3
		';
		$stmt = $this->conn->prepare($query);
		$d = date_parse_from_format("Y-m-d", $currDate);
		
		$yy=$d["year"];
		$stmt->bindParam(':yy',$yy);
		$zoomCode="%{$zoomCode}%";
		$stmt->bindParam(':zoomCode',$zoomCode);
		$stmt->execute();
		return $stmt;
	}
	

	public function update(){
		$query='UPDATE t_zoombooking 
        	SET 
			zoomCode=:zoomCode,
			bookingDate=:bookingDate,
			startTime=:startTime,
			finishTime=:finishTime,
			bookingName=:bookingName,
			staffId=:staffId,
			status=:status,
			activity=:activity,
			telNo=:telNo,
			lineNo=:lineNo,
			aproveStatus=:aproveStatus,
			outsiderId=:outsiderId,
			objective=:objective,
			departmentId=:departmentId,
			finishDate=:finishDate,
			timeDuration=:timeDuration
			

		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":zoomCode",$this->zoomCode);
		$stmt->bindParam(":bookingDate",$this->bookingDate);
		$stmt->bindParam(":startTime",$this->startTime);
		$stmt->bindParam(":finishTime",$this->finishTime);
		$stmt->bindParam(":bookingName",$this->bookingName);
		$stmt->bindParam(":staffId",$this->staffId);
		$stmt->bindParam(":status",$this->status);
		$stmt->bindParam(":activity",$this->activity);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":lineNo",$this->lineNo);
		$stmt->bindParam(":aproveStatus",$this->aproveStatus);
		$stmt->bindParam(":outsiderId",$this->outsiderId);
		$stmt->bindParam(":objective",$this->objective);
		$stmt->bindParam(":departmentId",$this->departmentId);
		$stmt->bindParam(":finishDate",$this->finishDate);
		$stmt->bindParam(":timeDuration",$this->timeDuration);

		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}

	public function getLastId(){
		$query="SELECT MAX(A.id) AS MxId 
		FROM t_zoombooking A INNER JOIN 
		t_zoomlicense B ON A.zoomCode=B.zoomCode
		
		";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$MxId= is_null($MxId)?0:$MxId;
		return $MxId;

	}

	public function getLastLicense($id){
		$query="SELECT zoomCode 
		FROM t_zoombooking WHERE id=:id
		
		";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":id",$id);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		
		return $zoomCode;

	}

	public function getLastAdminId($userCode){
		$query="SELECT MAX(A.id) AS MxId 
		FROM t_zoombooking A INNER JOIN 
		t_zoomlicense B ON A.zoomCode=B.zoomCode
		WHERE B.status=3 
		";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$MxId= is_null($MxId)?0:$MxId;
		return $MxId;

	}
	

	public function readOne(){
		$query='SELECT  id,
			zoomCode,
			bookingDate,
			startTime,
			finishTime,
			TIME_TO_SEC(TIMEDIFF(finishTime,startTime))/60  AS duration, 
			bookingName,
			staffId,
			status,
			activity,
			telNo,
			lineNo,
			aproveStatus,
			outsiderId,
			objective,
			departmentId,
			objective,
			departmentId
		FROM t_zoombooking WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}

	public function setAproveStatus($id,$status){
		$query="UPDATE t_zoombooking 
		SET aproveStatus=:status 
		WHERE id=:id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":id",$id);
		$stmt->bindParam(":status",$status);
		$flag=$stmt->execute();
		return $flag;
	}

	public function getSelfBooking($userCode,$keyWord){
		$query="SELECT  
			id,
			zoomCode,
			bookingDate,
			startTime,
			finishTime,
			bookingName,
			status,
			activity,
			telNo,
			lineNo,
			aproveStatus,
			outsiderId,
			objective,
			departmentId
		FROM t_zoombooking 
		WHERE aproveStatus IN (0,1) 
		AND StaffId=:userCode AND 
		CONCAT(activity,bookingName) 
		LIKE :keyWord

		ORDER BY 
		bookingDate ASC
		";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(":keyWord",$keyWord);

		$stmt->execute();
		return $stmt;
	}


	public function getCurrentBooking($userCode){
		$cDate=date("Y-m-d H:i");
		//print_r($cDate);
		$query="SELECT  
			id,
			zoomCode,
			bookingDate,
			startTime,
			finishTime,
			bookingName,
			timeDuration AS duration,
			activity,
			meetingId
		FROM t_zoombooking 
		WHERE aproveStatus IN (0,1) 
		AND 
		StaffId=:userCode 
		
		ORDER BY 
		bookingDate DESC
		";
		/*
			AND 
		CONCAT(DATE_FORMAT(finishDate,'%Y-%m-%d'),' ',finishTime)>=:cDate
		*/
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
	    //$stmt->bindParam(":cDate",$cDate);

		//print_r($userCode);

		$stmt->execute();
		return $stmt;
	}

	public function cancelBooking($id){
		$query="UPDATE t_zoombooking SET aproveStatus=3 WHERE id=:id";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":id",$id);
		$flag=$stmt->execute();
		return $flag;
	}


	public function getUnAproveStatus($keyWord){
		$query="SELECT  
			id,
			zoomCode,
			bookingDate,
			startTime,
			finishTime,
			bookingName,
			status,
			activity,
			telNo,
			lineNo,
			aproveStatus,
			outsiderId,
			objective,
			departmentId
		FROM t_zoombooking 
		WHERE aproveStatus=0 AND 
		CONCAT(activity,bookingName) 
		LIKE :keyWord
		ORDER BY 
		bookingDate ASC
		";
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(":keyWord",$keyWord);
		$stmt->execute();
		return $stmt;
	}





	public function getData($keyWord){
		$key=KeyWord::getKeyWord($this->conn,$this->table_name);
		$key=($key!="")?$key:"keyWord";
		$query='SELECT  id,
			zoomCode,
			bookingDate,
			startTime,
			finishTime,
			bookingName,
			staffId,
			status,
			activity,
			telNo,
			lineNo,
			aproveStatus,
			outsiderId
		FROM t_zoombooking WHERE '.$key.' LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}

	public function zoomUsageReport($sDate,$fDate){
		$query="SELECT
			A.id, 
			A.zoomCode,
			A.bookingDate,
			A.startTime,
			A.finishTime,
			A.activity,
			YEAR(A.bookingDate) AS YY,
			MONTH(A.bookingDate) AS MM,
			HOUR(TIMEDIFF(A.finishTime, A.startTime)) AS HourDiff,
			A.bookingName
		FROM t_zoombooking A LEFT OUTER JOIN
		t_zoomlicense B ON A.zoomCode=B.zoomCode

		WHERE 
		A.bookingDate 
		BETWEEN :sDate AND :fDate 
		AND
		A.aproveStatus<>3

		ORDER BY A.bookingDate

		";


		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":sDate",Format::getSystemDate($startDate));
		$stmt->bindParam(":fDate",Format::getSystemDate($finishDate));
		$stmt->execute();
		return $stmt;
	}




	function delete(){
		$query='DELETE FROM t_zoombooking WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_zoombooking WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>