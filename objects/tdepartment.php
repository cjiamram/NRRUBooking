<?php
include_once "keyWord.php";
class  tdepartment{
	private $conn;
	private $table_name="t_department";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $departmentId;
	public $departmentName;
	public function create(){
		$query='INSERT INTO t_department  
        	SET 
			departmentId=:departmentId,
			departmentName=:departmentName
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":departmentId",$this->departmentId);
		$stmt->bindParam(":departmentName",$this->departmentName);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_department 
        	SET 
			departmentId=:departmentId,
			departmentName=:departmentName
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":departmentId",$this->departmentId);
		$stmt->bindParam(":departmentName",$this->departmentName);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			departmentId,
			departmentName
		FROM t_department WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$query='SELECT  id,
			departmentId,
			departmentName
		FROM t_department ';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}


	public function listDepartment(){
		$query='SELECT  id,
			departmentId,
			departmentName
		FROM t_department ';

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function delete(){
		$query='DELETE FROM t_department WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_department WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>