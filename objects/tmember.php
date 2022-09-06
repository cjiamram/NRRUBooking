<?php
include_once "keyWord.php";
class  tmember{
	private $conn;
	private $table_name="t_member";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $title;
	public $firstName;
	public $lastName;
	public $department;
	public $telNo;
	public $lineNo;
	public $email;


	public function isExist($firstName,$lastName){
		$query="SELECT COUNT(id) AS CNT FROM t_member 
		WHERE CONCAT(firstName,lastName)=:member";
		$stmt=$this->conn->prepare($query);
		$member=$firstName.$lastName;
		$stmt->bindParam(":member",$member);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		if($CNT>0)
			return true;
		else
			return false;

	}

	public function create(){
		$query='INSERT INTO t_member  
        	SET 
			title=:title,
			firstName=:firstName,
			lastName=:lastName,
			department=:department,
			telNo=:telNo,
			lineNo=:lineNo,
			email=:email
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":title",$this->title);
		$stmt->bindParam(":firstName",$this->firstName);
		$stmt->bindParam(":lastName",$this->lastName);
		$stmt->bindParam(":department",$this->department);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":lineNo",$this->lineNo);
		$stmt->bindParam(":email",$this->email);
		$flag=$stmt->execute();
		return $flag;
	}



	public function update(){
		$query='UPDATE t_member 
        	SET 
			title=:title,
			firstName=:firstName,
			lastName=:lastName,
			department=:department,
			telNo=:telNo,
			lineNo=:lineNo,
			email=:email
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":title",$this->title);
		$stmt->bindParam(":firstName",$this->firstName);
		$stmt->bindParam(":lastName",$this->lastName);
		$stmt->bindParam(":department",$this->department);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":lineNo",$this->lineNo);
		$stmt->bindParam(":email",$this->email);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			title,
			firstName,
			lastName,
			department,
			telNo,
			lineNo,
			email
		FROM t_member WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
	
		$query='SELECT  id,
			title,
			firstName,
			lastName,
			department,
			telNo,
			lineNo,
			email
		FROM t_member 
		WHERE 
		CONCAT(firstName,lastName) 
		LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_member WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_member WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>