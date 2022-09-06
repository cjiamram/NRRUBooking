<?php
include_once "keyWord.php";
class  tbookingfail{
	private $conn;
	private $table_name="t_bookingfail";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $bookingDate;
	public $startTime;
	public $finishTime;
	public $departmentId;
	public function create(){
		$query='INSERT INTO t_bookingfail  
        	SET 
			bookingDate=:bookingDate,
			startTime=:startTime,
			finishTime=:finishTime,
			departmentId=:departmentId
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":bookingDate",$this->bookingDate);
		$stmt->bindParam(":startTime",$this->startTime);
		$stmt->bindParam(":finishTime",$this->finishTime);
		$stmt->bindParam(":departmentId",$this->departmentId);
		$flag=$stmt->execute();
		return $flag;
	}
	
}

?>