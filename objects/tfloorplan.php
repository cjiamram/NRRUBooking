<?php
class tfloorplan{
	private $conn;
	private $table_name;
	public function __construct($db){
            $this->conn = $db;
        	}
	public $buildingNo;
	public $floorNo;
	public $floorPlan;
	public function create(){
		$query='INSERT INTO t_floorplan  
        	SET 
			buildingNo=:buildingNo,
			floorNo=:floorNo,
			floorPlan=:floorPlan
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":buildingNo",$this->buildingNo);
		$stmt->bindParam(":floorNo",$this->floorNo);
		$stmt->bindParam(":floorPlan",$this->floorPlan);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_floorplan 
        	SET 
			buildingNo=:buildingNo,
			floorNo=:floorNo,
			floorPlan=:floorPlan
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":buildingNo",$this->buildingNo);
		$stmt->bindParam(":floorNo",$this->floorNo);
		$stmt->bindParam(":floorPlan",$this->floorPlan);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			buildingNo,
			floorNo,
			floorPlan
		FROM t_floorplan WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function displayData($keyWord){
		$query='SELECT  id,
			buildingNo,
			floorNo,
			floorPlan
		FROM t_floorplan WHERE keyWord LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}

	public function listFloor($buildingNo){
		$query='SELECT  
			id,
			floorNo
		FROM 
			t_floorplan 
		WHERE 
			buildingNo=:buildingNo';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':buildingNo',$buildingNo);
		$stmt->execute();
		return $stmt;
	}


	function delete(){
		$query='DELETE FROM t_floorplan WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_floorplan WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>