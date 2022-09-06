<?php
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
	$cnf=new Config();
	$rootPath=$cnf->path;
	$building=isset($_GET["building"]) ? $_GET["building"] : "";
	$floorNo=isset($_GET["floorNo"]) ? $_GET["floorNo"] : "";
	
	$url=$cnf->restURL."tbooking/getRoomFloor.php?building=".$building."&floorNo=".$floorNo;
	$api=new ClassAPI();
	$data=$api->getAPI($url);
	
	
?>
<thead>
	<tr>
	<th>No.</th>
	<th>หมายเลขห้อง</th>
	<th>สถานะ</th>
	<th>วันที่จอง</th>
	<th>เวลา</th>
	<th>ผู้ใช้งาน</th>
	<th>หมายเหตุ</th>
	</tr>
</thead>

<tbody>
	<tr>
		<?php
			$i=1;
			if($data!=""){
				foreach ($data as $row) {
				

					echo "<tr>\n";
					echo '<td>'.($i++).'</td>'."\n";
					if($row["Flag"]==0){
						echo '<td><a href="#" onclick="linkReserve(\''.$row["RoomNo"].'\')">'.$row["RoomNo"].'</a></td>'."\n";}
					else{
						echo '<td>'.$row["RoomNo"].'</td>'."\n";
					}
					echo '<td>'.$row["Status"].'</td>'."\n";
					echo '<td>'.$row["BookingDate"].'</td>'."\n";
					echo '<td>'.$row["BookingTime"].'</td>'."\n";
					echo '<td>'.$row["BookingName"].'</td>'."\n";
					echo '<td>'.$row["Activity"].'</td>'."\n";
					echo "</tr>\n";
				}
			}
		?>
	</tr>
</tbody>

<script>
	function linkReserve(roomNo){
		 var link="<?=$rootPath?>/tbooking/calendar.php?roomNo="+roomNo;
		 $("#dvMain").load(link);

	}
</script>