<?php
class tbuilding{
	private $conn;
	private $table_name;
	public function __construct($db){
            $this->conn = $db;
        	}
	public $BuildingNo;
	public $BuildingName;
	public $FloorNo;
	public $RoomNo;
	public $FloorPlan;
	public function create(){
		$query='INSERT INTO t_building  
        	SET 
			BuildingNo=:BuildingNo,
			BuildingName=:BuildingName,
			FloorNo=:FloorNo,
			RoomNo=:RoomNo,
			FloorPlan=:FloorPlan
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":BuildingNo",$this->BuildingNo);
		$stmt->bindParam(":BuildingName",$this->BuildingName);
		$stmt->bindParam(":FloorNo",$this->FloorNo);
		$stmt->bindParam(":RoomNo",$this->RoomNo);
		$stmt->bindParam(":FloorPlan",$this->FloorPlan);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_building 
        	SET 
			BuildingNo=:BuildingNo,
			BuildingName=:BuildingName,
			FloorNo=:FloorNo,
			RoomNo=:RoomNo,
			FloorPlan=:FloorPlan
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":BuildingNo",$this->BuildingNo);
		$stmt->bindParam(":BuildingName",$this->BuildingName);
		$stmt->bindParam(":FloorNo",$this->FloorNo);
		$stmt->bindParam(":RoomNo",$this->RoomNo);
		$stmt->bindParam(":FloorPlan",$this->FloorPlan);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			BuildingNo,
			BuildingName,
			FloorNo,
			RoomNo,
			FloorPlan
		FROM t_building WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function displayData($keyWord){
		$query='SELECT  id,
			BuildingNo,
			BuildingName,
			FloorNo,
			RoomNo,
			FloorPlan
		FROM t_building WHERE BuildingName LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";

		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}

	public function listBuilding(){
		$query='SELECT  id,
			BuildingNo,
			BuildingName			
		FROM t_building ';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function delete(){
		$query='DELETE FROM t_building WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_building WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>