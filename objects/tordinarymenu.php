<?php
include_once "keyWord.php";
class  tordinarymenu{
	private $conn;
	private $table_name="t_ordinarymenu";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $menuId;
	public $menuName;
	public $menuIcon;
	public $menuLink;
	public function create(){
		$query='INSERT INTO t_ordinarymenu  
        	SET 
			menuId=:menuId,
			menuName=:menuName,
			menuIcon=:menuIcon,
			menuLink=:menuLink
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":menuId",$this->menuId);
		$stmt->bindParam(":menuName",$this->menuName);
		$stmt->bindParam(":menuIcon",$this->menuIcon);
		$stmt->bindParam(":menuLink",$this->menuLink);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_ordinarymenu 
        	SET 
			menuId=:menuId,
			menuName=:menuName,
			menuIcon=:menuIcon,
			menuLink=:menuLink
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":menuId",$this->menuId);
		$stmt->bindParam(":menuName",$this->menuName);
		$stmt->bindParam(":menuIcon",$this->menuIcon);
		$stmt->bindParam(":menuLink",$this->menuLink);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			menuId,
			menuName,
			menuIcon,
			menuLink
		FROM t_ordinarymenu WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	

	public function getData(){

		$query="SELECT  
			id,
			menuId,
			menuName,
			menuIcon,
			menuLink
		FROM t_ordinarymenu ORDER BY menuId";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}


	function delete(){
		$query='DELETE FROM t_ordinarymenu WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_ordinarymenu WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>