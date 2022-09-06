<?php
	header("content-type:text/html;charset=UTF-8");
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	include_once "../objects/classLabel.php";
	include_once "../objects/ttemplate.php";
	include_once "../config/database.php";
	include_once "../objects/toptional.php";


	$database=new Database();
	$db=$database->getConnection();
	$cnf=new Config();
	$api=new ClassAPI();
	$url=$cnf->restURL;
	$userCode=isset($_GET["userCode"])?$_GET["userCode"]:"";
	$objLbl=new ClassLabel($db);
	$objT=new ttemplate($db);
	$objO=new toptional($db);

	function getTable($objT,$objO,$bookingId){
		$stmt=$objT->getData();
		if($stmt->rowCount()>0){
			$strT="<table with='100%'>\n";
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				if(getOptional($objO,$bookingId,$code))
					$strT.="<tr><td><input type='checkbox' checked>&nbsp;".$templateOption."</td></tr>\n";
				else
					$strT.="<tr><td><input type='checkbox'>&nbsp;".$templateOption."</td></tr>\n";

			}
			$strT.="</table>\n";
		}
		return $strT;
	}


	function getOptional($objO,$bookingId,$templateCode){
			return $objO->isExist($bookingId,$templateCode);
	}


	function getExistOptional($objO,$bookingId){
				$stmt=$objO->getData($bookingId);
				$strT="<table  border='1'>\n";
				$strT.="<tr><td><b>อุปกรณ์เสริม</b></td></tr>";
				if($stmt->rowCount()>0){

				
				while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					$strT.="<tr><td>".$template."</td></tr>\n";
				   }
				}
				$strT.="</table>\n";
				return $strT;
	}


	$url=$url. "tbooking/getSelfBookingRoom.php?userCode=".$userCode;

	//print_r($url);

	$data=$api->getAPI($url);

	echo "<thead>";
		echo "<tr>";
			echo "<th width='50px'>No.</th>";
			echo "<th width='150px'>".$objLbl->getLabel("t_booking","BookingRoom","th")."</th>";
			echo "<th width='200px'>".$objLbl->getLabel("t_booking","bookingDate","th")."</th>";
			echo "<th>".$objLbl->getLabel("t_booking","activity","th")."</th>";
			echo "<th width='100px'>จัดการ</th>";
		echo "</tr>";
	echo "</thead>";

	if(!isset($data["message"])){

		echo "<tbody>\n";
		$i=1;

		foreach ($data as $row) {


			echo "<tr>\n";
			echo "<td>".$i++."</td>\n";
			echo "<td>".$row["bookingRoom"]."</td>\n";
			echo "<td align='center'>".$row["bookingDate"]."</td>\n";
			echo "<td>".$row['activity']."<br>".getExistOptional($objO,$row['id'])."</td>\n";
			
			

			echo "<td>
			<button type='button' class='btn btn-info'
				data-toggle='modal' data-target='#modal-input'
				onclick='readOne(".$row['id'].")'>
				<span class='fa fa-edit'></span>
			</button>
			
		
			<button type='button'
				class='btn btn-danger'
				onclick='confirmDelete(".$row['id'].")'>
				<span class='fa fa-trash'></span>
			</button>

			</td>\n";

			echo "</tr>\n";
		}

		echo "</tbody>\n";

	}


?>

<script>
	setTablePage("#tblSelfBooking",10);
</script>