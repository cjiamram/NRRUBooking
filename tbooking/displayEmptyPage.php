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
	$bookingDate=isset($_GET["bookingDate"]) ? $_GET["bookingDate"] : "";
	$sTime=isset($_GET["sTime"]) ? $_GET["sTime"] : "";
	$sTime=str_replace(" ","",$sTime);
	$fTime=isset($_GET["fTime"]) ? $_GET["fTime"] : "";
	$fTime=str_replace(" ","",$fTime);
	$url=$cnf->restURL."tbooking/getRoomEmpty.php?building=".$_GET["building"]."&bookingDate=".$bookingDate."&sTime=".$sTime."&fTime=".$fTime;
	$api=new ClassAPI();
	$data=$api->getAPI($url);
	//print_r($sTime);

?>

<thead>
	<th>No.</th>
	<th>ห้อง</th>
	<th>ชั้น</th>
	<th>อาคาร</th>
	<th>หมายเหตุ</th>
	<th>คอมพิวเตอร์</th>
</thead>
<tbody>
		<?php
			$i=1;
			if(!isset($data["message"])){
				foreach ($data as $row) {
					echo "<tr>\n";
					echo '<td>'.($i++).'</td>'."\n";
					echo '<td width=\'100px\'><a href="#" onclick="linkReserve(\''.$row["roomNo"].'\')">'.$row["roomNo"].'</a></td>'."\n";
					echo '<td>'.$row["floorNo"].'</td>'."\n";
					echo '<td>'.$row["Building"].'</td>'."\n";
					echo '<td width=\'150px\'><textarea row=\'2\' style=\'width:100%\' class=\'form-control\'>'.$row["Accessory"].'</textarea></td>'."\n";
					echo '<td>'.$row["ComputerNo"].'</td>'."\n";
					echo "</tr>\n";
				}
			}
		?>
</tbody>
<script>
	function linkReserve(roomNo){
		 var  sTime=$("#obj_sHr").val()+":"+$("#obj_sMn").val();
		 var  fTime=$("#obj_fHr").val()+":"+$("#obj_fMn").val();
		 var link="<?=$rootPath?>/tbooking/inputBooking.php?roomNo="+roomNo+"&bookingDate="+$("#obj_bookingDate").val()+"&sTime="+sTime+"&fTime="+fTime+"&flagCheck=true";
		 console.log(link);
		 $("#dvMain").load(link);

	}
</script>
