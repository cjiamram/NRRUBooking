<?php
include_once "keyWord.php";
class  tngrok{
	private $conn;
	private $table_name="t_ngrok";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $forwordURI;
	public $createDate;
	public function create(){
		$query='INSERT INTO t_ngrok  
        	SET 
			forwordURI=:forwordURI,
			createDate=:createDate
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":forwordURI",$this->forwordURI);
		$stmt->bindParam(":createDate",$this->createDate);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_ngrok 
        	SET 
			forwordURI=:forwordURI,
			createDate=:createDate
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":forwordURI",$this->forwordURI);
		$stmt->bindParam(":createDate",$this->createDate);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			forwordURI,
			createDate
		FROM t_ngrok WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData($keyWord){
		$key=KeyWord::getKeyWord($this->conn,$this->table_name);
		$key=($key!="")?$key:"keyWord";
		$query='SELECT  id,
			forwordURI,
			createDate
		FROM t_ngrok WHERE '.$key.' LIKE :keyWord';
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(':keyWord',$keyWord);
		$stmt->execute();
		return $stmt;
	}

	public function getLastURI(){
		$query="SELECT  
			forwordURI
		FROM t_ngrok 
		WHERE id IN 
		(SELECT MAX(id) FROM t_ngrok) ";

		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSCOC);
		extract($row);

		return $forwordURI;



	}


	function delete(){
		$query='DELETE FROM t_ngrok WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_ngrok WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>