<?php
include_once "keyWord.php";
class  tusermenu{
	private $conn;
	private $table_name="t_usermenu";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $menuId;
	public $menuName;
	public $link;
	public $icon;
	public function create(){
		$query='INSERT INTO t_usermenu  
        	SET 
			menuId=:menuId,
			menuName=:menuName,
			link=:link,
			icon=:icon
	';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":menuId",$this->menuId);
		$stmt->bindParam(":menuName",$this->menuName);
		$stmt->bindParam(":link",$this->link);
		$stmt->bindParam(":icon",$this->icon);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_usermenu 
        	SET 
			menuId=:menuId,
			menuName=:menuName,
			link=:link,
			icon=:icon
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":menuId",$this->menuId);
		$stmt->bindParam(":menuName",$this->menuName);
		$stmt->bindParam(":link",$this->link);
		$stmt->bindParam(":icon",$this->icon);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}
	public function readOne(){
		$query='SELECT  id,
			menuId,
			menuName,
			link,
			icon
		FROM t_usermenu WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}
	public function getData(){
	
		$query='SELECT  id,
			menuId,
			menuName,
			link,
			icon
		FROM t_usermenu';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	function delete(){
		$query='DELETE FROM t_usermenu WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_usermenu WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>