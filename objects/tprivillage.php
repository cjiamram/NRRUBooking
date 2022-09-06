<?php
class tprivillage{
	private $conn;
	private $table_name;
	public function __construct($db){
            $this->conn = $db;
        	}
	public $UserId;
	public $MenuId;
	public function create(){
		$query='INSERT INTO t_privillage  
        	SET 
			UserId=:UserId,
			MenuId=:MenuId
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":UserId",$this->UserId);
		$stmt->bindParam(":MenuId",$this->MenuId);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_privillage 
        	SET 
			UserId=:UserId,
			MenuId=:MenuId
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":UserId",$this->UserId);
		$stmt->bindParam(":MenuId",$this->MenuId);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			UserId,
			MenuId
		FROM t_privillage WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$query='SELECT  id,
			UserId,
			MenuId
		FROM t_privillage WHERE keyWord LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_privillage WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_privillage WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>