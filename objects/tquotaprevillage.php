<?php
include_once "keyWord.php";
class  tquotaprevillage{
	private $conn;
	private $table_name="t_quotaprevillage";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $userCode;
	public $quota;
	public $duration;
	public function create(){
		$query='INSERT INTO t_quotaprevillage  
        	SET 
			userCode=:userCode,
			quota=:quota,
			duration=:duration
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":quota",$this->quota);
		$stmt->bindParam(":duration",$this->duration);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_quotaprevillage 
        	SET 
			userCode=:userCode,
			quota=:quota,
			duration=:duration
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$this->userCode);
		$stmt->bindParam(":quota",$this->quota);
		$stmt->bindParam(":duration",$this->duration);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			userCode,
			quota,
			duration
		FROM t_quotaprevillage WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}

	public function getQuota($userCode){
		$query="SELECT  
			quota,duration 
		FROM t_quotaprevillage 
		WHERE userCode=:userCode";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		return $stmt;

	}

	public function getData(){
		
		$query='SELECT  id,
			userCode,
			quota,
			duration
		FROM t_quotaprevillage';
		$stmt = $this->conn->prepare($query);

		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_quotaprevillage WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_quotaprevillage WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>