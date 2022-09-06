<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");

	
	function strToHex($string){
		$hex='';
		for ($i=0; $i < strlen($string); $i++){
		$hex .= dechex(ord($string[$i]));
		}
		return $hex;
	}

	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	$cnf=new Config();
	$building=isset($_GET["building"]) ? $_GET["building"] : "";
	$bookingDate=isset($_GET["bookingDate"]) ? $_GET["bookingDate"] : "";
	$sTime=isset($_GET["sTime"]) ? $_GET["sTime"] : "";
	$fTime=isset($_GET["fTime"]) ? $_GET["fTime"] : "";

	$url=$cnf->restURL."tbooking/getRoomUsage.php?building=".$_GET["building"]."&bookingDate=".$bookingDate."&sTime=".$sTime."&fTime=".$fTime;
	$api=new ClassAPI();
	$data=$api->getAPI($url);
	
?>

<thead>
	<tr>
	<th>No.</th>
	<th>หมายเลขห้อง</th>
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
			if(!isset($data["message"])){
				foreach ($data as $row) {
				$d = date_parse_from_format("Y-m-d", $row["bookingDate"]);
				$bookingDate= sprintf('%02s',$d["day"])."-".sprintf('%02s',$d["month"])."-".$d["year"];
					echo "<tr>\n";
					echo '<td>'.($i++).'</td>'."\n";
					echo '<td>'.$row["bookingRoom"].'</td>'."\n";
					echo '<td>'.$bookingDate.'</td>'."\n";
					echo '<td>'.$row["bookingTime"].'</td>'."\n";
					echo '<td>'.$row["bookingName"].'</td>'."\n";
					echo '<td>'.$row["Activity"].'</td>'."\n";
					echo "</tr>\n";
				}
			}
		?>
	</tr>
</tbody>