<?php
include_once "keyWord.php";
class  tbookingobjective{
	private $conn;
	private $table_name="t_bookingobjective";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $code;
	public $objective;
	public function create(){
		$query='INSERT INTO t_bookingobjective  
        	SET 
			code=:code,
			objective=:objective
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":objective",$this->objective);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_bookingobjective 
        	SET 
			code=:code,
			objective=:objective
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":code",$this->code);
		$stmt->bindParam(":objective",$this->objective);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			code,
			objective
		FROM t_bookingobjective WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function listObjective(){
		$query='SELECT  id,
			code,
			objective
		FROM t_bookingobjective  ';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_bookingobjective WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_bookingobjective WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>