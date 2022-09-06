<?php
class toutsider{
	private $conn;
	private $table_name;
	public function __construct($db){
            $this->conn = $db;
        	}
	public $title;
	public $firstName;
	public $lastName;
	public $department;
	public $doc;
	public $decription;
	public $projectName;
	public $telNo;
	public $lineNo;
	public $email;
	public $budget;
	public $budget1;

	public function getLastId(){
		$query="SELECT MAX(id) AS MxId FROM t_outsider";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		$MxId= is_null($MxId)?0:$MxId;
		return $MxId;

	}


	public function create(){
		$query="INSERT INTO t_outsider  
        	SET 
			title=:title,
			firstName=:firstName,
			lastName=:lastName,
			department=:department,
			doc=:doc,
			decription=:decription,
			projectName=:projectName,
			telNo=:telNo,
			lineNo=:lineNo,
			email=:email,
			budget=:budget,
			budget1=:budget1,
			createDate=now()
	";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":title",$this->title);
		$stmt->bindParam(":firstName",$this->firstName);
		$stmt->bindParam(":lastName",$this->lastName);
		$stmt->bindParam(":department",$this->department);
		$stmt->bindParam(":doc",$this->doc);
		$stmt->bindParam(":decription",$this->decription);
		$stmt->bindParam(":projectName",$this->projectName);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":lineNo",$this->lineNo);
		$stmt->bindParam(":email",$this->email);
		$stmt->bindParam(":budget",$this->budget);
		$stmt->bindParam(":budget1",$this->budget1);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_outsider 
        	SET 
			title=:title,
			firstName=:firstName,
			lastName=:lastName,
			department=:department,
			doc=:doc,
			decription=:decription,
			projectName=:projectName,
			telNo=:telNo,
			lineNo=:lineNo,
			email=:email,
			budget=:budget,
			budget1=:budget1
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":title",$this->title);
		$stmt->bindParam(":firstName",$this->firstName);
		$stmt->bindParam(":lastName",$this->lastName);
		$stmt->bindParam(":department",$this->department);
		$stmt->bindParam(":doc",$this->doc);
		$stmt->bindParam(":decription",$this->decription);
		$stmt->bindParam(":projectName",$this->projectName);
		$stmt->bindParam(":telNo",$this->telNo);
		$stmt->bindParam(":lineNo",$this->lineNo);
		$stmt->bindParam(":email",$this->email);
		$stmt->bindParam(":budget",$this->budget);
		$stmt->bindParam(":budget1",$this->budget1);
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
			doc,
			decription,
			projectName,
			telNo,
			lineNo,
			email,
			budget,
			budget1
		FROM t_outsider WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}

	public function getMember($keyWord){
		$query="SELECT ";
	}

	public function getData($keyWord){
		$query="SELECT  id,
			title,
			firstName,
			lastName,
			department,
			doc,
			decription,
			projectName,
			telNo,
			lineNo,
			email,
			budget,
			budget1
		FROM t_outsider WHERE 

		CONCAT(title,' ',firstName,' ',lastName,' ',email)


		LIKE :keyWord";
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_outsider WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_outsider WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>