<?php
header("Content-Type:text/html;charset=UTF-8");
include_once "../config/config.php";
include_once "../lib/classAPI.php";
include_once "../objects/classLabel.php";
include_once "../config/database.php";
include_once "../objects/toptional.php";
include_once "../objects/ttemplate.php";



$database=new Database();
$db=$database->getConnection();

$objT=new ttemplate($db);
$objO=new toptional($db);


$cnf=new Config();	
$sDate=isset($_GET["sDate"])?$_GET["sDate"]:date("Y-m-d") ;
$fDate=isset($_GET["fDate"])?$_GET["fDate"]:date("Y-m-d") ;
$bookingRoom=isset($_GET["bookingRoom"])?$_GET["bookingRoom"]:"" ;
$bookingName=isset($_GET["bookingName"])?$_GET["bookingName"]:"" ;
$url=$cnf->restURL."tbooking/roomUsageReport.php?sDate=".$sDate."&fDate=".$fDate."&bookingName=".$bookingName."&bookingRoom=".$bookingRoom;
$api=new ClassAPI();
$data=$api->getAPI($url);
$objLbl=new ClassLabel($db);


function getOptional($objO,$bookingId,$templateCode){
			return $objO->isExist($bookingId,$templateCode);
	}


	function getExistOptional($objO,$bookingId){
				$stmt=$objO->getData($bookingId);
				$strT="<table with='100%' border='1'>\n";
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


echo "<thead>";
		echo "<tr>";
			echo "<th>No.</th>";
			echo "<th>".$objLbl->getLabel("t_booking","BookingRoom","th")."</th>";
			echo "<th>".$objLbl->getLabel("t_booking","bookingName","th")."</th>";
			echo "<th>".$objLbl->getLabel("t_booking","activity","th")."</th>";
			echo "<th width='120px'>".$objLbl->getLabel("t_booking","BookingDate","th")."</th>";
			echo "<th>".$objLbl->getLabel("t_booking","timeInterval","th")."</th>";
			echo "<th width='150px'>".$objLbl->getLabel("t_booking","HourDiff","th")."</th>";
			echo "<th>จัดการ</th>";
		echo "</tr>";
echo "</thead>";

if(!isset($data["message"])){
	echo "<tbody>\n";
	$i=1;
		foreach ($data as $row) {
			echo '<tr>'."\n";
			echo '<td>'.$i++.'</td>\n';
			echo '<td>'.$row["BookingRoom"].'</td>'."\n";
			echo '<td>'.$row["bookingName"].'</td>'."\n";
			echo '<td>'.$row['activity']."<br>".getExistOptional($objO,$row['id']).'</td>'."\n";
			echo '<td align="center">'.$row["BookingDate"].'</td>'."\n";
			echo '<td>'.$row["startTime"]."-".$row["finishTime"].'</td>'."\n";
			echo '<td>'.$row["HourDiff"].'</td>'."\n";
			echo "<td>
	
			<button type='button'
				class='btn btn-danger'
				onclick='confirmDelete(".$row['id'].")'>
				<span class='fa fa-trash'></span>
			</button></td>";
			echo '</tr>'."\n";
		}

	echo "</tbody>\n";

}

?>

<script>
  

  setTablePage("#tblReport",30);


</script>