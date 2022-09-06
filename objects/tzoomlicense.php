<?php
include_once "keyWord.php";
include_once "manage.php";
class  tzoomlicense{
	private $conn;
	private $table_name="t_zoomlicense";
	public function __construct($db){
            $this->conn = $db;
        	}
	public $zoomCode;
	public $zoomDetail;
	public $status;
	public $clientId;
	public $secretId;
	public $redirectURI;
	public $color;

	public function getCountLicense($licenseType){
		$query="SELECT COUNT(id) AS licenseNo FROM 
		t_zoomlicense 
		WHERE status=:licenseType";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":licenseType",$licenseType);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		return $licenseNo;
	}

	public function getColor($licenseId){
		$query="SELECT color 
		FROM t_zoomlicense 
		WHERE zoomCode=:licenseId ";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":licenseId",$licenseId);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
		return $color;
	}

	public function randomColorLicense(){
		$objArr=array();
		for($i=0;$i<30;$i++){

			$objItem=array("color"=>Format::randColor());
			array_push($objArr, $objItem);	
		}
		return $objArr;
	}


	public function create(){
		$query="INSERT INTO t_zoomlicense  
        	SET 
			zoomCode=:zoomCode,
			zoomDetail=:zoomDetail,
			status=:status,
			clientId=:clientId,
			secretId=:secretId,
			redirectURI=:redirectURI
	";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":zoomCode",$this->zoomCode);
		$stmt->bindParam(":zoomDetail",$this->zoomDetail);
		$stmt->bindParam(":status",$this->status);
		$stmt->bindParam(":clientId",$this->clientId);
		$stmt->bindParam(":secretId",$this->secretId);
		$stmt->bindParam(":redirectURI",$this->redirectURI);
		$flag=$stmt->execute();
		return $flag;
	}
	public function update(){
		$query='UPDATE t_zoomlicense 
        	SET 
			zoomCode=:zoomCode,
			zoomDetail=:zoomDetail,
			status=:status,
			clientId=:clientId,
			secretId=:secretId,
			redirectURI=:redirectURI
		 WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":zoomCode",$this->zoomCode);
		$stmt->bindParam(":zoomDetail",$this->zoomDetail);
		$stmt->bindParam(":status",$this->status);
		$stmt->bindParam(":clientId",$this->clientId);
		$stmt->bindParam(":secretId",$this->secretId);
		$stmt->bindParam(":redirectURI",$this->redirectURI);
		$stmt->bindParam(":id",$this->id);
		$flag=$stmt->execute();
		return $flag;
	}

	public function getZoomConfig($licenseId){
		$query="SELECT 
			clientId,
			secretId,
			redirectURI
		FROM t_zoomlicense 
		WHERE zoomCode=:licenseId
		";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(":licenseId",$licenseId);
		$stmt->execute();
		return $stmt;
	}


	public function readOne(){
		$query='SELECT  id,
			zoomCode,
			zoomDetail,
			status,
			clientId,
			secretId
		FROM t_zoomlicense WHERE id=:id';
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id',$this->id);
		$stmt->execute();
		return $stmt;
	}

	public function getActiveLicense(){
		$query="SELECT  id,
			zoomCode,
			zoomDetail
		FROM t_zoomlicense 
		WHERE status=1
		
		";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		return $stmt;
	}

	public function listLicenseAdmin($userCode){
		$query="SELECT  id,
			zoomCode,
			zoomDetail,
			status,
			clientId,
			secretId
		FROM t_zoomlicense 
		WHERE status=3
		AND zoomCode IN (SELECT zoomCode 
		FROM t_zoomprivillege WHERE userCode=:userCode)
		";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":userCode",$userCode);
		$stmt->execute();
		return $stmt;
	}


	public function getData(){
		
		$query='SELECT  id,
			zoomCode,
			zoomDetail,
			status,
			clientId,
			secretId
		FROM t_zoomlicense WHERE status=1';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function getDataAll($keyWord){
		
		$query="SELECT  id,
			zoomCode,
			zoomDetail,
			status,
			clientId,
			secretId,
			redirectURI
		FROM t_zoomlicense 
		WHERE CONCAT(zoomCode,' ',zoomDetail) LIKE :keyWord
		";
		$stmt = $this->conn->prepare($query);
		$keyWord="%{$keyWord}%";
		$stmt->bindParam(":keyWord",$keyWord);
		$stmt->execute();
		return $stmt;
	}


	public function listData(){
		
		$query='SELECT  
			id,
			zoomCode,
			zoomDetail,
			status,
			clientId,
			secretId
		FROM t_zoomlicense WHERE status=0';
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}




	function delete(){
		$query='DELETE FROM t_zoomlicense WHERE id=:id';
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
		$query ="SELECT MAX(CODE) AS MXCode FROM t_zoomlicense WHERE CODE LIKE ?";
		$stmt = $this->conn->prepare($query);
		$prefix="{$prefix}%";
		$stmt->bindParam(1, $prefix);
		$stmt->execute();
		return $stmt;
	}
}

?>