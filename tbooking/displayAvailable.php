<?php
	include_once "../config/config.php";
	include_once "../lib/classAPI.php";
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: text/html; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");
	$cnf=new Config();
	$rootPath=$cnf->path;
	$building=isset($_GET["building"]) ? $_GET["building"] : "";
	$bookingDate=isset($_GET["bookingDate"]) ? $_GET["bookingDate"] : "";
	$sTime=isset($_GET["sTime"]) ? $_GET["sTime"] : "";
	$sTime=str_replace(" ","",$sTime);
	$fTime=isset($_GET["fTime"]) ? $_GET["fTime"] : "";
	$fTime=str_replace(" ","",$fTime);
	$url=$cnf->restURL."tbooking/getRoomEmpty.php?building=".$_GET["building"]."&bookingDate=".$bookingDate."&sTime=".$sTime."&fTime=".$fTime;
	$api=new ClassAPI();
	$data=$api->getAPI($url);

?>
 <table id="tblAvailable" class="table table-bordered table-hover">

<thead>
	<tr>
		<th>No.</th>
		<th>หมายเลขห้อง</th>
		<th>ชั้น</th>
		<th>อาคาร</th>
		<th>อุปกรณ์</th>
		<th>จำนวนคอมพิวเตอร์</th>
	</tr>
</thead>
<tbody>

		<?php
			$i=1;
			if(!isset($data["message"])){
				foreach ($data as $row) {
					echo "<tr>\n";
					echo '<td>'.($i++).'</td>'."\n";
					echo '<td><a href="#" onclick="linkReserve(\''.$row["roomNo"].'\')">'.$row["roomNo"].'</a></td>'."\n";
					echo '<td>'.$row["floorNo"].'</td>'."\n";
					echo '<td>'.$row["Building"].'</td>'."\n";
					echo '<td>'.$row["Accessory"].'</td>'."\n";
					echo '<td>'.$row["ComputerNo"].'</td>'."\n";
					echo "</tr>\n";
				}
			}
		?>

</tbody>
</table>
<script>
	function linkReserve(roomNo){
		 $("#modal-available").modal("hide");
		 $("#obj_bookingRoom").val(roomNo);
		
	}
</script>
