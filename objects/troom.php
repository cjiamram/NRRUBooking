<?php
class troom{
	private $conn;
	private $table_name;
	public function __construct($db){
            $this->conn = $db;
        	}
	public $RoomNo;
	public $ComputerNo;
	public $DeskNo;
	public $Accessory;
	public $Status;
	public $FloorNo;
	public $Building;
	public $Picture;
	public function create(){
		$query='INSERT INTO t_room  
        	SET 
			RoomNo=:RoomNo,
			ComputerNo=:ComputerNo,
			DeskNo=:DeskNo,
			Accessory=:Accessory,
			Status=:Status,
			FloorNo=:FloorNo,
			Building=:Building
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":RoomNo",$this->RoomNo);
		$stmt->bindParam(":ComputerNo",$this->ComputerNo);
		$stmt->bindParam(":DeskNo",$this->DeskNo);
		$stmt->bindParam(":Accessory",$this->Accessory);
		$stmt->bindParam(":Status",$this->Status);
		$stmt->bindParam(":FloorNo",$this->FloorNo);
		$stmt->bindParam(":Building",$this->Building);
		$flag=$stmt->execute();
		return $flag;
	}

	public function getRoomFloor($building,$floorNo){
		
		$query="SELECT 
			RoomNo,
			ComputerNo,
			Accessory,
			FloorNo,
			Status,
			'' AS BookingTime
		FROM t_room WHERE 
			Building=:building 
		AND 
			FloorNo=:floorNo
		";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':building',$building);
		$stmt->bindParam(':floorNo',$floorNo);
		$stmt->execute();
		return $stmt;
	}


	public function getBookingRoom(){
		$query="SELECT 
						id,
						RoomNo,
						ComputerNo,
						DeskNo,
						Accessory,
						Status,
						FloorNo,
						Building,
						picture,
						plan,
						pano
					FROM t_room WHERE status=1 
					ORDER BY RoomNo
		";
		
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;

	}

	public function getImages($roomNo){
		$query="SELECT 
						picture,
						plan,
						pano
					FROM t_room 
					WHERE roomNo=:roomNo
		";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":roomNo",$roomNo);
		$stmt->execute();
		return $stmt;
	}

	


	public function displayData($buildingId,$keyWord){
		$query="SELECT id,
				RoomNo,
				ComputerNo,
				DeskNo,
				Accessory,
				Status,
				FloorNo,
				Building
		FROM t_room 
		WHERE Building=:buildingId 
		AND RoomNo LIKE :keyWord AND status=1

		ORDER BY RoomNo
		";
		
		$keyWord="%{$keyWord}%";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":buildingId",$buildingId);
		$stmt->bindParam(":keyWord",$keyWord);
		$stmt->execute();
		return $stmt;

	}

	public function update(){
		$query='UPDATE t_room 
        	SET 
			RoomNo=:RoomNo,
			ComputerNo=:ComputerNo,
			DeskNo=:DeskNo,
			Accessory=:Accessory,
			Status=:Status,
			FloorNo=:FloorNo,
			Building=:Building
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":RoomNo",$this->RoomNo);
		$stmt->bindParam(":ComputerNo",$this->ComputerNo);
		$stmt->bindParam(":DeskNo",$this->DeskNo);
		$stmt->bindParam(":Accessory",$this->Accessory);
		$stmt->bindParam(":Status",$this->Status);
		$stmt->bindParam(":FloorNo",$this->FloorNo);
		$stmt->bindParam(":Building",$this->Building);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			RoomNo,
			ComputerNo,
			DeskNo,
			Accessory,
			Status,
			FloorNo,
			Building
		FROM t_room WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord,$buildingId){
		$query='SELECT  id,
			RoomNo,
			ComputerNo,
			DeskNo,
			Accessory,
			Status,
			FloorNo,
			Building
		FROM t_room WHERE RoomNo LIKE :keyWord 
		AND 
		Building LIKE :buildingId
		AND staus=1
		';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		//print_r($keyWord);
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->bindParam(':buildingId',$buildingId);
		$stmt->execute();
		return $stmt;
	}

	public function listRoom($building){
		$query='SELECT  id,
			RoomNo
		FROM t_room WHERE Building LIKE :building
		AND status=1
		ORDER BY RoomNo
		';
		$stmt = $this->conn->prepare($query);
		$building="%{$building}%";
		//print_r($building);
		$stmt->bindParam(':building',$building);
		$stmt->execute();
		return $stmt;
	}


	function delete(){
		$query='DELETE FROM t_room WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_room WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>