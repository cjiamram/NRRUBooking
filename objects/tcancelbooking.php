<?php
include_once "keyWord.php";
class  tcancelbooking{
	private $conn;
	private $table_name="t_cancelbooking";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $bookingId;
	public $cancelDate;
	public $reason;
	public function create(){
		$query='INSERT INTO t_cancelbooking  
        	SET 
			bookingId=:bookingId,
			cancelDate=:cancelDate,
			reason=:reason
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":bookingId",$this->bookingId);
		$stmt->bindParam(":cancelDate",$this->cancelDate);
		$stmt->bindParam(":reason",$this->reason);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_cancelbooking 
        	SET 
			bookingId=:bookingId,
			cancelDate=:cancelDate,
			reason=:reason
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":bookingId",$this->bookingId);
		$stmt->bindParam(":cancelDate",$this->cancelDate);
		$stmt->bindParam(":reason",$this->reason);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			bookingId,
			cancelDate,
			reason
		FROM t_cancelbooking WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$key=KeyWord::getKeyWord($this->conn,$this->table_name);
		$key=($key!="")?$key:"keyWord";
		$query='SELECT  id,
			bookingId,
			cancelDate,
			reason
		FROM t_cancelbooking WHERE '.$key.' LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_cancelbooking WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_cancelbooking WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>