<?php

class  toptional{
	private $conn;
	private $table_name="t_optional";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $bookingId;
	public $template;
	public $description;
	public $quantity;
	public function create(){
		$query='INSERT INTO t_optional  
        	SET 
			bookingId=:bookingId,
			template=:template,
			description=:description,
			quantity=:quantity
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":bookingId",$this->bookingId);
		$stmt->bindParam(":template",$this->template);
		$stmt->bindParam(":description",$this->description);
		$stmt->bindParam(":quantity",$this->quantity);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_optional 
        	SET 
			bookingId=:bookingId,
			template=:template,
			description=:description,
			quantity=:quantity
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":bookingId",$this->bookingId);
		$stmt->bindParam(":template",$this->template);
		$stmt->bindParam(":description",$this->description);
		$stmt->bindParam(":quantity",$this->quantity);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			bookingId,
			template,
			description,
			quantity
		FROM t_optional WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}

	public function isExist($bookingId,$templateCode){
		$query="SELECT id 
		FROM t_optional 
		WHERE bookingId=:bookingId 
		AND template=:templateCode";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":bookingId",$bookingId);
		$stmt->bindParam(":templateCode",$templateCode);
		$stmt->execute();
		$flag=$stmt->rowCount()>0?true:false;
		return $flag;
	}

	public function getData($bookingId){
	
		$query='SELECT  
			A.id,
			A.bookingId,
			B.templateOption AS template,
			A.description,
			A.quantity
		FROM t_optional A INNER JOIN
		t_template B 
		ON A.template=B.code
		WHERE 
		A.bookingId=:bookingId';
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':bookingId',$bookingId);
		$stmt->execute();
		return $stmt;
	}



	function delete(){
		$query='DELETE FROM t_optional WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$flag=$stmt->execute();
		return $flag;
	}

	function deleteByBookingId($id){
		$query="DELETE FROM t_optional WHERE bookingid=:bookingid";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":bookingid",$id);
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_optional WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>